<?php
/**
 * Block Media Resources.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var $post_id (int|string) The post ID this block is saved to.
 */

/**
 * Block preview image
 */
if ( isset( $block['data']['block_preview_images'] ) ) {
	hm_get_template_part_with_params( 'fragments/block-preview-image', ['block' => $block] );
	return;
}

/**
 * Block Variables
 */
$title = get_field( 'title' );
$tabs = get_field( 'tabs' );
?>

<?php if ( !empty( $tabs ) ) : ?>
	<section class="section section-media-resources">
		<?= hm_get_top_gap() ?>

		<div class="container">
			<div class="section__body">
				<div class="section-media-resources__content decor-line decor-line--section">
					<?php if ( !empty( $title ) ) : ?>
						<div class="section-title section-title--style1 section-media-resources__title">
							<h2>
								<?= esc_html( $title ) ?>
							</h2>
						</div>
					<?php endif; ?>

					<div class="section-media-resources__main">
						<div class="section-media-resources__grid">
							<div class="section-media-resources__nav">
								<?= get_template_part( 'fragments/common/tabs-in-line', '', ['tabs' => $tabs] )?>
							</div>

							<div class="section-media-resources__tabs">
								<?php
									foreach ( $tabs as $index => $tab ) {
										switch ( $tab['type'] ) {
											case 'post':
												get_template_part( 'fragments/media-resources/posts-tab/posts', '', ['tab_name' => $index . $tab['name'], 'category' => $tab['category']] );
												break;
											case 'video':
												get_template_part( 'fragments/media-resources/video-library-tab/video-library', '', ['tab_name' => $index . $tab['name'], 'category' => $tab['category']] );
												break;
											case 'page':
												get_template_part( 'fragments/media-resources/community-outreach-tab/community-outreach', '', ['tab_name' => $index . $tab['name'], 'pages' => $tab['pages']] );
												break;
											case 'card':
												get_template_part( 'fragments/media-resources/corporate-giving-tab/corporate-giving', '', ['tab_name' => $index . $tab['name'], 'cards' => $tab['cards']] );
												break;
											case 'recognition':
												get_template_part( 'fragments/media-resources/recognition', '', ['tab_name' => $index . $tab['name']] );
												break;
										}
									}
								?>
							</div>

							<div class="section-media-resources__sidebar-container">
								<?= get_template_part( 'fragments/media-resources/sidebar' )?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?= hm_get_bottom_gap() ?>
	</section>
<?php endif; ?>
