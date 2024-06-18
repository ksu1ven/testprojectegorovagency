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
$block] ); return; } /** * Block Variables */ $title = get_field( 'galery_title'
); $description = get_field( 'galery_description' ); $galery_list = get_field(
'galery_list' ); $carousel_list = get_field(
	'carousel_list' );?>

<section class="galery js-section-galery">
	<div class="container">
		<?php if ( !empty( $title )) : ?>
		<h2 class="h2 galery__h2"><?= esc_html( $title) ?></h2>

		<?php endif ?>
		<?php if ( !empty( $description )) : ?>
		<p class="p p--big galery__slogan">
			<?= esc_html( $description) ?>
		</p>
		<?php endif ?>

		<?php if (have_rows('galery_list')) : ?>

		<div class="row no-gutters galery__content">
			<div class="col col-12 galery__grid js-galery__grid">
				<?php 
					foreach ($galery_list as $index=>$photo) { $img_id = $photo['image']; $img =
				wp_get_attachment_image_url($img_id, 'full'); $description=
				$photo['description']; $quantity= $photo['quantity_of_photos']; ?>
				<div
					class="galery__item js-galery__item galery__item--grid"
					role="link"
					aria-label="Open popup"
				>
					<img
						class="background-img galery__img"
						src="<?= esc_url( $img) ?>"
						alt="galery-photo-<?php echo esc_html(  $index)  ?>"
					/>
					<div class="galery__text-content">
						<?php if ( !empty( $description )) : ?>
						<h5 class="h5 galery__h5">
							<?php echo esc_html(  $description)  ?>
						</h5>

						<?php endif ?>

						<?php if ( !empty( $quantity )) : ?>
						<div class="galery__description">
							<?php echo esc_html(  $quantity)  ?>
							photos
						</div>

						<?php endif ?>
					</div>
				</div>

				<?php 
					}
					?>
			</div>
		</div>
		<?php endif ?>
		<button
			class="button button--colored galery__button js-load-more"
			type="button"
		>
			Load More
		</button>
	</div>


	<div class="overlay js-overlay"></div>
	<div class="popup carousel js-carousel" role="dialog" tabindex="0">
		<button
			class="popup__close js-carousel-close"
			aria-label="Close photo carousel"
		>
			<svg role="img" aria-hidden="true" width="24" height="24">
				<use xlink:href="#menu-icon-cross"></use>
			</svg>
		</button>

		
		<?php if ( have_rows('carousel_list')) : ?>

			<div class="carousel__wrapper">
			<div class="carousel__pictures js-carousel__pictures">

			<?php 
							
							foreach ($carousel_list as $index=>$photo) {
								$img_id = $photo['image'];
								 $img =wp_get_attachment_image_url($img_id, 'full');
								?>
								
								<picture class="background-img carousel__img js-carousel__img">
									<img
										src="<?= esc_url( $img) ?>"
										alt="carousel-photo-<?php echo esc_html(  $index)  ?>"
									/>
								</picture>
				
							

							<?php 

							}

			?>
			</div>			
			</div>
			

		

		




		
		<div class="controls carousel__controls">
			<button
				class="controls__prev js-prev"
				type="button"
				aria-label="Previous Image"
				disabled
			>
				<svg role="img" aria-hidden="true" width="25" height="25">
					<use xlink:href="#arrow-icon"></use>
				</svg>
			</button>
			<div class="controls__rounds js-controls__rounds">
					
			<?php 
							foreach ($carousel_list as $index=>$photo) {
								
								?>
								<button
							class="controls__round js-controls__round <?php if ($index == '0'){ ?> controls__round--active <?php   } ?> "
							type="button"
							data-number="<?php echo esc_html(  $index + 1)  ?>"
							<?php if ($index + 1 == '1'){ ?> disabled <?php   } ?>
							></button>

							<?php 
							}

			?>

			</div>
			<button
				class="controls__next js-next"
				type="button"
				aria-label="Previous Image"
			>
				<svg role="img" aria-hidden="true" width="25" height="25">
					<use xlink:href="#arrow-icon"></use>
				</svg>
			</button>
		</div>

		<?php else : ?>
			<div class="p p--small" >No photos :(</div>
		<?php endif ?>
	</div>
</section>
