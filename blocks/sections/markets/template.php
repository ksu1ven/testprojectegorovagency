<?php
/**
 * Block Markets.
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
$section_title = get_field( 'markets_section_title' );
$section_description = get_field( 'markets_section_description' );
$section_markets = get_field( 'markets_section_props' );

?>

<section class="section section-markets">
	<?= hm_get_top_gap() ?>

	<div class="container">
		<div class="section__content decor-line decor-line--section">
			<div class="section__left">
				<?php if ( !empty( $section_title ) ) : ?>
					<div class="section-title section-title--style2 section__title">
						<h2>
							<?= esc_html( $section_title ) ?>
						</h2>
					</div>
				<?php endif; ?>

				<div class="section__description text-content">
					<?php if ( !empty( $section_description ) ) : ?>
						<?= apply_filters( 'the_content', $section_description ) ?>
					<?php endif; ?>
				</div>

				<?php if ( !empty( $section_markets ) ) : ?>
					<div class="markets-accordion js-markets-accordion scrollbar-outer">
						<?php foreach ( $section_markets as $key => $item ) : ?>
							<?php
								$img_id = $item['img'];
								$name = $item['name'];
								$content = $item['description'];
								$link = $item['link'];
							?>
							<div class="accordion-item js-accordion-item <?= $key === 0 ? 'active' : '' ?>">
								<div class="accordion-item__wrapper">
									<div class="accordion-item__spine accordion-spine js-accordion-spine" role="tab">
										<?php if ( !empty( $img_id ) ) : ?>
											<div class="accordion-spine__bg">
												<div class="background-img">
													<picture>
														<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'bg-image-4k' ) ) ?>" media="(min-width: 1280px)">
														<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'bg-image-desktop' ) ) ?>" media="(max-width: 1279px)">
														<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'bg-image-tablet' ) ) ?>" media="(max-width: 1024px)">
														<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'bg-image-mobile' ) ) ?>" media="(max-width: 575px)">
														<img src="<?= esc_url( wp_get_attachment_image_url( $img_id ) ) ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $img_id ) ) ?>">
													</picture>
												</div>
											</div>
										<?php endif; ?>

										<?php if ( !empty( $name ) ) : ?>
											<div class="accordion-spine__title">
												<span>
													<?= esc_html( $name ) ?>
												</span>
											</div>
										<?php endif; ?>
									</div>

									<div class="accordion-item__info accordion-info js-accordion-info">
										<div class="accordion-info__wrapper js-accordion-info__wrapper">
											<?php if ( !empty( $img_id ) ) : ?>
												<div class="accordion-info__bg">
													<div class="background-img">
														<picture>
															<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'bg-image-4k' ) ) ?>" media="(min-width: 1280px)">
															<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'bg-image-desktop' ) ) ?>" media="(max-width: 1279px)">
															<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'bg-image-tablet' ) ) ?>" media="(max-width: 1024px)">
															<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'bg-image-mobile' ) ) ?>" media="(max-width: 575px)">
															<img src="<?= esc_url( wp_get_attachment_image_url( $img_id ) ) ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $img_id ) ) ?>">
														</picture>
													</div>
												</div>
											<?php endif; ?>

											<div class="accordion-info__content">
												<div class="accordion-info__content-wrapper">
													<?php if ( !empty( $name ) ) : ?>
														<div class="accordion-info__title">
															<h3>
																<?= esc_html( $name ) ?>
															</h3>
														</div>
													<?php endif; ?>

													<?php if ( !empty( $content ) ) : ?>
														<div class="accordion-info__excerpt-wrap">
															<div class="scrollbar-outer">
																<div class="accordion-info__excerpt text-content text-content--white">
																	<?= hm_truncate( apply_filters( 'the_content' ,$content ), 370, ['html' => true, 'ending' => '...'] ) ?>
																</div>
															</div>
														</div>
													<?php endif; ?>

													<?php if ( !empty( $link ) ) : ?>
														<?php
															$title = !empty( $link['title'] ) ? $link['title'] : '';
															$url = !empty( $link['url'] ) ? $link['url'] : '';
															$target_value = !empty( $link['target'] ) ? $link['target'] : '';
															$target = $target_value !== '' ? "target=\"{$target_value}\"" : '';
														?>
														<a class="button button--fill accordion-info__link" href="<?= esc_url( $url ) ?>" <?= $target ?> aria-label="<?= esc_attr( sprintf( __( 'Open %s service page', THEME_TEXTDOMAIN ), $name ) ) ?>">
															<?= esc_html( $title ) ?>
														</a>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="section__bg" aria-hidden="true">
				<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/backgrounds/bg-decor-logo-3.svg' ) ); ?>
			</div>
		</div>
	</div>

	<?= hm_get_bottom_gap() ?>
</section>
