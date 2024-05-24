<?php
/**
 * @var $args;
 */

extract( $args );

if ( !isset( $post_id ) || !isset( $active_category ) )
	return;

$video = get_field( 'video', $post_id );
$img_id = get_post_thumbnail_id( $post_id );

$categories = get_the_category( $post_id );
$tags = get_the_tags( $post_id );
$show_category = '';
$data_tags = '';

if ( !empty( $categories ) ) {
	foreach ( $categories as $category ) {
		if ( $category->slug !== $active_category->slug )
			$show_category = $category->name;
	}
}

if ( !empty( $tags ) ) {
	foreach ( $tags as $tag )
		$data_tags .= $tag->slug . ',';
}

?>

<div class="video-library-tab__card" data-hm-tag="<?= esc_attr( $data_tags ) ?>">
	<div class="video-library-tab__card-image">
		<?php if ( !empty( $img_id ) ) : ?>
			<div class="background-img">
				<picture>
					<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'full-hd' ) ) ?>" media="(max-width: 1280px)">
					<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'thumbs-desktop' ) ) ?>" media="(max-width: 767px)">
					<img src="<?= esc_url( wp_get_attachment_image_url( $img_id, 'full-hd' ) ) ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $img_id ) ) ?>">
				</picture>
			</div>
		<?php endif; ?>

		<?php if ( !empty( $video ) ) : ?>
			<?php if ( 'self_hosted' === $video['video_type'] ) : ?>
				<?php
					$video_file_url = wp_get_attachment_url( $video['video_file'] );
					$image_poster_url = wp_get_attachment_image_url( $video['image_poster'] );
				?>
				<!-- button for self hosted video -->
				<button
					class="button button--play-circle js-bt-modal-video"
					data-toggle="modal"
					data-poster-url="<?= esc_attr( $image_poster_url ) ?>"
					data-video-url="<?= esc_attr( $video_file_url ) ?>"
					aria-label="<?= esc_attr__( 'Open video', THEME_TEXTDOMAIN ) ?>"
				>
					<span class="icon icon-wrap">
						<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-play.svg' ) ) ?>
					</span>
				</button>

			<?php elseif ( 'youtube' === $video['video_type'] ) : ?>
				<?php
					$youtube_id = hm_get_youtube_video_id_from_url( $video['youtube_link'] );
				?>
				<!-- button for youtube video -->
				<button
					class="button button--play-circle js-bt-modal-youtube-video"
					data-toggle="modal"
					data-video-id="<?= esc_attr( $youtube_id ) ?>"
					aria-label="<?= esc_attr__('Open video', THEME_TEXTDOMAIN) ?>"
				>
					<span class="icon icon-wrap">
						<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-play.svg' ) ) ?>
					</span>
				</button>

			<?php endif; ?>
		<?php endif; ?>
	</div>

	<div class="card-title video-library-tab__card-title decor-line js-used-in-search">
		<h3>
			<?= esc_html( get_the_title() ) ?>
		</h3>
	</div>

	<?php if ( !empty( $show_category ) ) : ?>
		<div class="video-library-tab__card-category js-used-in-search">
			<span>
				<?= esc_attr__('Category: ', THEME_TEXTDOMAIN) ?>
			</span>

			<span class="video-library-tab__card-category--name">
				<?= esc_html( $show_category ) ?>
			</span>
		</div>
	<?php endif; ?>
</div>
