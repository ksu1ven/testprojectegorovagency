<?php

function hm_get_template_part_with_params($path, array $params = array()) {
	extract( $params );

	require( locate_template( $path . '.php' ) );
}

function hm_get_page_by_template( $template ) {
	$page  = false;
	$pages = get_posts(
		array(
			'post_type'   => 'any',
			'numberposts' => 1,
			'meta_key'    => '_wp_page_template',
			'meta_value'  => $template
		)
	);

	if ( ! empty( $pages ) ) {
		$page = reset( $pages );
	}

	return $page;
}

function hm_get_page_link_by_template( $template ) {
	$page = hm_get_page_by_template( $template );

	if ( $page ) {
		return get_permalink( $page->ID );
	}
}

function hm_get_page_link_by_slug( $slug ) {
	$page = get_page_by_path( $slug );

	if ( $page ) {
		return get_permalink( $page->ID );
	}
}

function hm_get_next_posts_link( $label = null, $max_page = 0 ) {
	global $paged, $wp_query;

	if ( ! $max_page ) {
		$max_page = $wp_query->max_num_pages;
	}

	if ( ! $paged ) {
		$paged = 1;
	}

	$nextpage = (int) $paged + 1;

	if ( null === $label ) {
		$label = __( 'Next Page &raquo;' );
	}

	if ( ! is_single() && ( $nextpage <= $max_page ) ) {
		/**
		 * Filters the anchor tag attributes for the next posts page link.
		 *
		 * @since 2.7.0
		 *
		 * @param string $attributes Attributes for the anchor tag.
		 */
		$attr = apply_filters( 'next_posts_link_attributes', '' );

		return '<a href="' . next_posts( $max_page, false ) . "\" $attr><span>" . preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label ) . '</span></a>';
	}
}

function hm_get_page_templates() {
	return array(
		// 'wp-custom-template-contact-us',
		// 'wp-custom-template-about-us',
		// 'wp-custom-template-faq-page',
		// 'wp-custom-template-services-overview',
		// 'wp-custom-template-careers',
	);
}

add_action( 'admin_init', 'hm_hide_wysiwyg_page_editor' );
function hm_hide_wysiwyg_page_editor() {
	if ( ! is_admin() || ! isset( $_GET['post'] ) || empty( $_GET['post'] ) ) {
		return;
	}

	$templates = hm_get_page_templates();
	$post_id   = absint( $_GET['post'] );

	if ( ! isset( $post_id ) ) {
		return;
	}

	$page_template = get_page_template_slug( $post_id );

	if ( in_array( $page_template, $templates ) || $post_id == get_option( 'page_for_posts' ) || $post_id == get_option( 'page_on_front' ) ) {
		remove_post_type_support( 'page', 'editor' );
	}

	return;
}

/**
 * @param int|string $id Image ID
 *
 * @return string
 */
function hm_get_attachment_image_alt( $id ): string {
	return esc_html( (string)get_post_meta( $id, '_wp_attachment_image_alt', true ) );
}

/**
 * @param $text
 * @param int $length
 * @param array $options
 *
 * @return mixed|string
 */
function hm_truncate( $text, $length = 100, $options = array() ) {
	$default = array(
		'ending' => '...', 'exact' => true, 'html' => false
	);
	$options = array_merge( $default, $options );
	extract( $options );

	if ( $html ) {
		if ( mb_strlen( preg_replace( '/<.*?>/', '', $text ) ) <= $length ) {
			return $text;
		}
		$totalLength = mb_strlen( strip_tags( $ending ) );
		$openTags = array();
		$truncate = '';

		preg_match_all( '/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER );
		foreach ( $tags as $tag ) {
			if ( !preg_match( '/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2] ) ) {
				if ( preg_match( '/<[\w]+[^>]*>/s', $tag[0] ) ) {
					array_unshift( $openTags, $tag[2] );
				} else if ( preg_match( '/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag ) ) {
					$pos = array_search( $closeTag[1], $openTags );
					if ( $pos !== false ) {
						array_splice( $openTags, $pos, 1 );
					}
				}
			}
			$truncate .= $tag[1];

			$contentLength = mb_strlen( preg_replace( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3] ) );
			if ( $contentLength + $totalLength > $length ) {
				$left = $length - $totalLength;
				$entitiesLength = 0;
				if ( preg_match_all( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE ) ) {
					foreach ( $entities[0] as $entity ) {
						if ( $entity[1] + 1 - $entitiesLength <= $left ) {
							$left--;
							$entitiesLength += mb_strlen( $entity[0] );
						} else {
							break;
						}
					}
				}

				$truncate .= mb_substr( $tag[3], 0, $left + $entitiesLength );
				break;
			} else {
				$truncate .= $tag[3];
				$totalLength += $contentLength;
			}
			if ( $totalLength >= $length ) {
				break;
			}
		}
	} else {
		if ( mb_strlen( $text ) <= $length ) {
			return $text;
		} else {
			$truncate = mb_substr( $text, 0, $length - mb_strlen( $ending ) );
		}
	}
	if ( !$exact ) {
		$spacepos = mb_strrpos( $truncate, ' ' );
		if ( isset( $spacepos ) ) {
			if ( $html ) {
				$bits = mb_substr( $truncate, $spacepos );
				preg_match_all( '/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER );
				if ( !empty( $droppedTags ) ) {
					foreach ( $droppedTags as $closingTag ) {
						if ( !in_array( $closingTag[1], $openTags ) ) {
							array_unshift( $openTags, $closingTag[1] );
						}
					}
				}
			}
			$truncate = mb_substr( $truncate, 0, $spacepos );
		}
	}
	$truncate .= $ending;

	if ( $html ) {
		foreach ( $openTags as $tag ) {
			$truncate .= '</' . $tag . '>';
		}
	}

	return $truncate;
}

/**
 * Echo section gap type.
 *
 * @return string
 */
function hm_get_top_gap() : string {
	$gap_type = get_field( 'gap_top' );
	$gap = !empty( $gap_type ) ? "section-gap--{$gap_type}" : 'section-gap--default';

	if ( 'section-gap--none' !== $gap ) {
		return '<div class="section-gap ' . $gap . '"></div>';
	}

	return '';
}

function hm_get_bottom_gap() : string {
	$gap_type = get_field( 'gap_bottom' );
	$gap = !empty( $gap_type ) ? "section-gap--{$gap_type}" : 'section-gap--default';

	if ( 'section-gap--none' !== $gap ) {
		return '<div class="section-gap ' . $gap . '"></div>';
	}

	return '';
}

function hm_check_external_url( $url ) : bool {
	$components = parse_url( $url );
	return !empty( $components['host'] ) && strcasecmp( $components['host'], $_SERVER['SERVER_NAME'] ); // empty host will indicate url like '/relative.php'
}

/**
 * Return User Posts list
 *
 * @param
 *
 * @return WP_Post[] Posts list
 */
function hm_get_user_post_list( $user_id, $post = null, $posts_per_page = -1 ): array {
	return get_posts( array(
		'author' => $user_id,
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => $posts_per_page,
		'exclude' => !empty( $post ) ? $post->ID : ''
	) );
}

/**
 * Return first paragraph
 *
 * @param
 *
 * @return string|NULL Post first paragraph
 */
function hm_get_first_paragraph( $description ): ?string {
	$paragraph = NULL;

	if ( !empty( $description ) ) {
		$blocks = parse_blocks( $description );

		foreach ( $blocks as $block ) {
			if ( $block['blockName'] === 'core/paragraph' ) {
				$paragraph = $block['innerHTML'];
				break;
			}
		}
	}

	return $paragraph;
}

// remove first tag <p> from content without removing it from excerpt
function hm_remove_first_paragraph( $content ) {
	$content = preg_replace( '/<p[^>]*>(.*)<\/p[^>]*>/iU', '$1', $content, 1 );
	return $content;
}

