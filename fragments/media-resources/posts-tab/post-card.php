<?php
/**
 * @var $args;
 */

extract( $args );

if ( !isset( $post_id ) )
	return;

$classes = !empty( $classes ) ? $classes : '';
$first_category_name = get_the_category( $post_id )[0]->name ?? '';

if ( $first_category_name == 'General' ) {
	$first_category_name = '';
}

$short_description = has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : wp_trim_words( hm_get_first_paragraph( get_the_content( $post_id ) ), 50, '' );
$img_id = get_post_thumbnail_id( $post_id );

$categories = get_the_category( $post_id );
$tags = get_the_tags( $post_id );
$data_tags = '';

if ( !empty( $tags ) ) {
	foreach ( $tags as $tag )
		$data_tags .= $tag->slug . ',';
}

?>
<div class="post__card <?= $classes ?>" tabindex="0" data-hm-tag="<?= esc_attr( $data_tags ) ?>">
	<div class="post__card-bg">
		<?php if ( !empty( $img_id ) ) : ?>
			<div class="background-img">
				<picture>
					<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'thumbs-desktop' ) ) ?>" media="(max-width: 767px)">
					<img src="<?= esc_url( wp_get_attachment_image_url( $img_id, 'bg-image-mobile' ) ) ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $img_id ) ) ?>">
				</picture>
			</div>
		<?php endif ?>
	</div>

	<div class="post__card-content decor-line">
		<div class="post__card-body">
			<div class="post__card-date">
				<span>
					<?php
						echo esc_html( get_the_date( 'F j, Y', $post_id ) );

						if ( $first_category_name ) {
							echo esc_html( ' | ' . $first_category_name );
						}
					?>
				</span>
			</div>

			<div class="post__card-title section-title section-title--style6 section-title--white js-used-in-search">
				<h3>
					<?= esc_html( get_the_title( $post_id ) ) ?>
				</h3>
			</div>


			<div class="post__card-author js-used-in-search">
				<span>
					<?= esc_html__( 'Author', THEME_TEXTDOMAIN ) ?>:
				</span>

				<a href="<?= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
					<?= esc_html( get_the_author() ); ?>
				</a>
			</div>
		</div>

		<div class="post__card-body post__card-body--hidden">
			<div class="post__card-description text-content text-content--white js-used-in-search">
				<?= $short_description ?>
			</div>

			<div class="post__card-button-wrapper">
				<a href="<?= esc_url( get_permalink( $post_id ) ) ?>" class="button button--fill post__card-button">
					<?= esc_html__( 'Read More', THEME_TEXTDOMAIN ) ?>
				</a>
			</div>
		</div>
	</div>
</div>

