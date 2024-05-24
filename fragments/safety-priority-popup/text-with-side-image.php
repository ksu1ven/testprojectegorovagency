<?php
/**
 * @var array $args;
 */

extract( $args );
?>

<?php if ( !empty($content) ) :
	$description = apply_filters( 'the_content', $content['text'] );
	$image_url = !empty( $content['side_image'] ) ? esc_url( wp_get_attachment_image_url( $content['side_image'], 'full-hd' ) ) : '';
	$image_alt = esc_attr( hm_get_attachment_image_alt( $content['side_image'] ) );
?>
	<div class="modal-safety-priority__content-with-side-image">
		<div class="modal-safety-priority__content-with-side-image-inner">
			<div class="content-block text-content">
				<?= $description ?>
			</div>

			<div class="image-container">
				<img src="<?= $image_url ?>" alt="<?= $image_alt ?>">
			</div>
		</div>
	</div>
<?php endif ?>
