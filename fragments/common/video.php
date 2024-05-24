<?php
/**
 * @var $args
 * @param array $video
 * @param int $preview_id
 */

extract( $args );

if ( empty( $video ) || empty( $preview_id ) )
	return;
?>

<div class="block-video">
	<div class="block-video__inner">
		<?php if ( !empty( $video['video_type'] ) ) : ?>
			<?php if ( 'self_hosted' === $video['video_type'] ) : ?>
				<?php
					$video_file_url = wp_get_attachment_url( $video['video_file'] );
					$image_poster_url = wp_get_attachment_image_url( $video['image_poster'] );
				?>
				<!-- button for self hosted video -->
				<a
					href="javascript:void(0)"
					class="block-video__play-button js-bt-modal-video"
					data-toggle="modal"
					data-poster-url="<?= esc_attr( $image_poster_url ) ?>"
					data-video-url="<?= esc_attr( $video_file_url ) ?>"
					aria-label="<?= esc_attr__( 'Open video', THEME_TEXTDOMAIN ) ?>"
				>
					<span class="icon" aria-hidden="true">
						<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-play.svg' ) ) ?>
					</span>
				</a>

			<?php elseif ( 'youtube' === $video['video_type'] ) : ?>
				<?php
					$youtube_id = hm_get_youtube_video_id_from_url( $video['youtube_link'] );
				?>
				<!-- button for youtube video -->
				<a
					href="javascript:void(0)"
					class="block-video__play-button js-bt-modal-youtube-video"
					data-toggle="modal"
					data-video-id="<?= esc_attr( $youtube_id ) ?>"
					aria-label="<?= esc_attr__('Open video', THEME_TEXTDOMAIN) ?>"
				>
					<span class="icon" aria-hidden="true">
						<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-play.svg' ) ) ?>
					</span>
				</a>

			<?php endif; ?>
		<?php endif; ?>

		<div class="block-video__poster">
			<picture>
				<source srcset="<?= esc_url( wp_get_attachment_image_url( $preview_id, 'full-hd' ) ) ?>" media="(min-width: 1280px)">
				<source srcset="<?= esc_url( wp_get_attachment_image_url( $preview_id, 'bg-image-tablet' ) ) ?>" media="(max-width: 1279px)">
				<source srcset="<?= esc_url( wp_get_attachment_image_url( $preview_id, 'bg-image-mobile' ) ) ?>" media="(max-width: 767px)">
				<img src="<?= esc_url( wp_get_attachment_image_url( $preview_id, 'full-hd' ) ) ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $preview_id ) ) ?>">
			</picture>
		</div>
	</div>
</div>
