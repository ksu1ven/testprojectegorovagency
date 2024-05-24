<?php
/**
 * Bennet Component Link
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
$links = get_field( 'links' );
?>

<?php if ( !empty( $links ) ) : ?>
	<div class="links">
		<?php foreach ( $links as $link ) : ?>
			<?php
				$link = $link['link'];
				$title = !empty( $link['title'] ) ? $link['title'] : '';
				$url = !empty( $link['url'] ) ? $link['url'] : '';
				$target_value = !empty( $link['target'] ) ? $link['target'] : '';
				$target = $target_value !== '' ? "target=\"{$target_value}\"" : '';
			?>
			<a href="<?= esc_html( $url ) ?>" class="link-arrow" <?= esc_attr( $target ) ?>>
				<span class="label">
					<?= esc_html( $title ) ?>
				</span>

				<span class="icon" aria-hidden="true">
					<?= hm_get_svg_inline( THEME_ASSETS_URL . '/images/icons/icon-arrow-right.svg' ); ?>
				</span>
			</a>

		<?php endforeach; ?>
	</div>

<?php else : ?>
	<?= esc_html__( 'Setup Your Links', THEME_TEXTDOMAIN ) ?>

<?php endif; ?>
