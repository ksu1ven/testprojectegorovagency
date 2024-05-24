<?php
/**
 * @var array $args;
 */

extract( $args );
?>

<?php if ( !empty($slider) ) : ?>
	<div class="modal-safety-priority__slider-container">
		<div class="swiper safety-priority-slider js-safety-priority-slider">
			<div class="swiper-wrapper">
				<?php foreach ( $slider as $slide ) :
					$image_url = !empty( $slide ) ? esc_url( wp_get_attachment_image_url( $slide, 'full-hd' ) ) : '';
				?>
					<div class="swiper-slide">
						<div class="slide-image-container">
							<div class="slide-image">
								<div class="background-img">
									<img src="<?= $image_url ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $slide ) ) ?>">
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<?php if ( count($slider) > 1 ) : ?>
			<div class="safety-priority-slider__nav">
				<div class="slider-arrow slider-arrow--prev slider-arrow--blue safety-priority-slider__arrow">
					<div class="slider-arrow__icon">
						<?php echo hm_svg_inline( THEME_ASSETS_URL . '/images/icons/icon-slider-arrow-right.svg' ); ?>
					</div>
				</div>

				<div class="safety-priority-slider__pagination"></div>

				<div class="slider-arrow slider-arrow--next slider-arrow--blue safety-priority-slider__arrow">
					<div class="slider-arrow__icon">
						<?php echo hm_svg_inline( THEME_ASSETS_URL . '/images/icons/icon-slider-arrow-right.svg' ); ?>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
<?php endif ?>
