<?php
/**
 * Button.
 *
 * @param array $button
 *
 * @var $args
 */

extract( $args );

if ( empty( $button['button'] ) )
	return;

$button = $button['button'];
$button_text = $button['text'];

if ( empty( $button_text ) )
	return;

$button_style = $button['style'];
$button_options = $button['options'];
$button_style_classes = '';

if ( $button_style === 'bordered' ) {
	$button_style_classes .= 'button--bordered';
} else {
	$button_style_classes .= 'button--fill';
}
?>

<?php if ( $button_options === 'video_popup' && !empty( $button['video_popup'] ) ) : ?>
	<?php
		\Harbinger_Marketing\Modal_Action::add_modal_action_to_render_list( MODAL_VIDEO );
		$video_popup = $button['video_popup'];
		$video_type = $video_popup['video_type'];
		$video_file_url = wp_get_attachment_url( $video_popup['video_file'] );
		$image_poster_url = wp_get_attachment_image_url( $video_popup['image_poster'] );
		$youtube_id = hm_get_youtube_video_id_from_url( $video_popup['youtube_link'] );
	?>
	<?php if ( $video_type === 'self_hosted' ) : ?>
		<button
			class="button <?= $button_style_classes ?> button--with-icon js-bt-modal-video"
			data-toggle="modal"
			data-poster-url="<?= esc_attr( $image_poster_url ) ?>"
			data-video-url="<?= esc_attr( $video_file_url ) ?>"
			aria-label="<?= esc_attr__( 'Open video', THEME_TEXTDOMAIN ) ?>"
		>
			<span class="button__text">
				<?= esc_html( $button_text ) ?>
			</span>

			<span class="icon icon-wrap button__icon">
				<?= hm_get_svg_inline( get_template_directory() . '/dist/images/icons/icon-play.svg' ); ?>
			</span>
		</button>

	<?php else : ?>
		<button
			class="button <?= $button_style_classes ?> button--with-icon js-bt-modal-youtube-video"
			data-video-id="<?= esc_attr( $youtube_id ) ?>"
			aria-label="<?= esc_attr__( 'Open hero video', THEME_TEXTDOMAIN ) ?>"
		>
			<span class="button__text">
				<?= esc_html( $button_text ) ?>
			</span>

			<span class="icon icon-wrap">
				<?= hm_get_svg_inline( get_template_directory() . '/dist/images/icons/icon-play.svg' ); ?>
			</span>
		</button>

	<?php endif ?>
<?php elseif ( $button_options === 'choosen_popup' ) : ?>
	<a href="<?= esc_attr( $button['popup_id'] ) ?>" class="button <?= esc_attr( $button_style_classes ) ?>">
		<span class="button__text">
			<?= esc_html( $button_text ) ?>
		</span>
	</a>

<?php elseif ( $button_options === 'link' && !empty( $button['link'] ) ) : ?>
	<?php
		$link = $button['link'];
		$target = !empty( $link['target'] ) ? 'target="_blank"' : ''
	?>
	<a href="<?= esc_url( $link['url'] ); ?>" <?= esc_attr( $target ) ?> class="button <?= esc_attr( $button_style_classes ) ?>">
		<span class="button__text">
			<?= esc_html( $button_text ) ?>
		</span>
	</a>

<?php endif ?>
