<?php
/**
 * Block Hero.
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
	hm_get_template_part_with_params( 'fragments/block-preview-image', ['block' =>
$block] ); return; } /** * Block Variables */ 

$background_id = get_field('reviews_background');
$background_mobile_id = get_field('reviews_background_mobile');
$background = wp_get_attachment_image_url($background_id, 'full');
$background_mobile = wp_get_attachment_image_url($background_mobile_id, 'full');

$title = get_field( 'reviews_title' );
$trainer_name = get_field( 'reviews_trainer_name' );
$trainer_description = get_field( 'reviews_trainer_description' );

$reviews = get_field('reviews_list');

?>

<section class="reviews js-section-reviews">
	<div class="container reviews__main-container">
		<div class="row no-gutters">
			<div class="col col-12 col-xl-6 reviews__left-col js-reviews__left-col">
				<div
					class="container reviews__inner-container reviews__inner-container--left"
				>	
					<picture class="background-img reviews__img">
						<?php if ( !empty( $background_mobile) ) : ?>
							<source
							srcset="<?= esc_url(  $background_mobile)  ?>"
							media="(max-width: 767px)"
							/>
						<?php endif; ?>
						<source
							srcset="<?= esc_url(  $background)  ?>"
							media="(min-width: 768px)"
						/>

						<img
							src="<?= esc_url(  $background)  ?>"
							alt=""
						/>
					</picture>
			
					<div class="reviews__left-content">
						<?php if ( !empty( $trainer_name )) : ?>
							<h2 class="h2 reviews__h2"><?= esc_html( $trainer_name) ?></h2>
						<?php endif ?>
						<?php if ( !empty( $trainer_description )) : ?>
							<div class="p p--small reviews__p js-reviews__p reviews__p--hidden">
							<?= esc_html( $trainer_description) ?>
							</div>
							<button
							class="button button--underline js-button-readmore"
							type="button"
						>
							Read more
						</button>
						<?php endif ?>
						<div class="reviews__buttons">
							<button class="button button--colored">
								Watch Video of The Bio
							</button>
							<button
								class="button button--transparent reviews__button--transparent"
							>
								Learn More
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col col-12 col-xl-6 reviews__right-col">
				<div class="container reviews__inner-container reviews__right-content">
				<?php if ( !empty( $title )) : ?>
					<h2 class="h2 rewiews__h2--right"><?= esc_html( $title) ?></h2>
				<?php endif ?>
					
						<?php 
						if (have_rows('reviews_list')) {
							?>
							<div class="swiper reviews-swiper js-reviews-swiper">
							<div class="swiper-wrapper reviews-swiper__wrapper">
							<?php 
							
							foreach ($reviews as $review) {
								$author = $review['author'];
								$stars = $review['stars'];
								$content = $review['review'];
								?>
								<div class="swiper-slide">
									<div class="review">
										<div class="review__author"><?php echo esc_html($author); ?></div> 
										<div class="stars">
											<?php
											$i = 0;
											while ($i < $stars) {
												?>
												<svg role="img" aria-hidden="true" width="16" height="16">
													<use xlink:href="#star-icon"></use>
												</svg>
												<?php
												$i++;
											}
											?>
										</div>
										<div class="p p--small review__content"><?php echo esc_html($content); ?></div> 
									</div>
								</div>
								<?php
							}
							?>
							</div>
							<div class="reviews-swiper__controls">
							<div
								class="swiper-button-prev controls__prev js-reviews-swiper-button-prev"
							>
								<svg
									class="swiper-button-prev__svg"
									role="img"
									aria-hidden="true"
									width="25"
									height="25"
								>
									<use xlink:href="#arrow-icon"></use>
								</svg>
							</div>
							<div
								class="swiper-pagination controls__rounds js-reviews-swiper-pagination"
							></div>
							<div
								class="swiper-button-next controls__next js-reviews-swiper-button-next"
							>
								<svg
									class="swiper-button-prev__svg"
									role="img"
									aria-hidden="true"
									width="25"
									height="25"
								>
									<use xlink:href="#arrow-icon"></use>
								</svg>
							</div>
						</div>
						</div>
						<?php
						} else {
							echo '<div class="p p--small">No reviews found</div>';
						}
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>


