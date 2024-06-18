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

$title = get_field( 'testimonials_title' );
$video_list = get_field( 'testimonials_video_list' );


?>

<section class="testimonials js-section-testimonials">
	<div class="container">
		<?php if ( !empty( $title )) : ?>
		<h2 class="h2 testimonials__h2"><?= esc_html( $title) ?></h2>
		<?php endif ?>
		<?php if (have_rows('testimonials_video_list')) : ?>	
		<div class="testimonials__videos">
			<?php 
					foreach ($video_list as $index=>$video) {
						$img_id = $video['image_preview'];
						$img = wp_get_attachment_image_url($img_id, 'full');
						$origin = $video['video_origin'];
						
						
		
						?>
							<a
							href="#open-video"
							class="testimonials__video background-img js-testimonials__video"
							data-toggle="modal"
							data-target="#open-video"
							data-origin="<?php echo esc_html(  $origin) ?>"
							<?php if ( 'self-hosted'===$origin) : ?>
								<?php
								$href = wp_get_attachment_url( $video['self_hosted_origin'] ); 
								?>
								data-href="<?= esc_url( $href ); ?>"
							
							<?php endif ?>
							<?php if ( 'youtube'===$origin ) : ?>
								<?php
								$id =  $video['youtube_id'] ; 
								?>
								data-youtube-id="<?php echo esc_html( $id)  ?>"
							<?php endif ?>
							
							aria-label="Open video modal"
					>
						<button
							class="button testimonials__open-button js-video-open-button"
							type="button"
						>
							<svg
								class="testimonials__svg"
								role="img"
								aria-hidden="true"
								width="40"
								height="42"
							>
								<use xlink:href="#video-play-icon"></use>
							</svg>
						</button>

						<img
							class="background-img"
							src="<?= esc_url( $img) ?>"
							alt="video-<?php echo esc_html(  $index)  ?>"
						/>
						</a>
						
						<?php 
					}		
					?>
		</div>
		<?php endif ?>
	</div>

	<div
		class="modal modal-video js-modal-video fade"
		id="open-video"
		tabindex="-1"
		role="dialog"
		aria-labelledby="Training video"
		aria-hidden="true"
	>
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<button
					type="button"
					class="close popup__close js-modal-video-close"
					data-dismiss="modal"
					aria-label="Close"
				>
					<span aria-hidden="true"
						><svg role="img" aria-hidden="true" width="24" height="24">
							<use xlink:href="#menu-icon-cross"></use></svg
					></span>
				</button>
				<div
					class="modal-video__content background-video js-modal-video__content"
				>
					<div id="youtube-player" class="background-video"></div>
					<video
						id="self-hosted-player"
						class="self-hosted-video"
						src=""
						controls
						autoplay
						webkit-playsinline
						playisinline
					></video>
				</div>
			</div>
		</div>
	</div>
</section>
