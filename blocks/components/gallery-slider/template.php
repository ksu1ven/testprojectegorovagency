<?php
/**
 * Bennet Component Gallery Slider
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
$slider = get_field( 'slider' );

if ( empty( $slider ) ) {
	esc_html__( 'Select Your Images', THEME_TEXTDOMAIN );
	return;
}
?>

<div class="block-gallery">
	<div class="block-gallery__main swiper js-content-slider">
		<div class="swiper-wrapper">
			<?php foreach ( $slider as $slide ) : ?>
				<div class="swiper-slide block-gallery__slide">
					<div class="block-gallery__slide-inner">
						<picture>
							<source srcset="<?= esc_url( wp_get_attachment_image_url( $slide, 'medium-large' ) ) ?>" media="(min-width: 767px)">
							<source srcset="<?= esc_url( wp_get_attachment_image_url( $slide, 'large' ) ) ?>" media="(min-width: 1024px)">
							<img src="<?= esc_url( wp_get_attachment_image_url( $slide, 'large' ) ) ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $slide ) ) ?>" class="block-video__poster">
						</picture>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="block-gallery__nav">
		<div class="slider-arrow slider-arrow--blue slider-arrow--prev block-gallery__arrow">
			<div class="slider-arrow__icon">
				<?= hm_get_svg_inline( THEME_ASSETS_URL . '/images/icons/icon-slider-arrow-right.svg' ); ?>
			</div>
		</div>

		<div class="block-gallery__pagination"></div>

		<div class="slider-arrow slider-arrow--blue slider-arrow--next block-gallery__arrow">
			<div class="slider-arrow__icon">
				<?= hm_get_svg_inline( THEME_ASSETS_URL . '/images/icons/icon-slider-arrow-right.svg' ); ?>
			</div>
		</div>
	</div>
</div>
