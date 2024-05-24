<?php
/**
 * Bennet Component Show More
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
?>

<div class="show-more js-show-more">
	<div class="show-more--hidden js-show-more-hidden">
		<?php
			$allowed_blocks = array(
				'core/paragraph',
				'core/heading',
				'core/list',
				'core/quote',
				'core/columns',
				'bennet-component/button-group',
				'bennet-component/link-list',
				'bennet-component/table'
			);
		?>
		<InnerBlocks allowedBlocks="<?= esc_attr( wp_json_encode( $allowed_blocks ) ) ?>" />
	</div>

	<div class="buttons-wrap">
		<button class="button button--fill js-show-more-button">
			<?= esc_html__( 'Hide', THEME_TEXTDOMAIN ) ?>
		</button>
	</div>
</div>
