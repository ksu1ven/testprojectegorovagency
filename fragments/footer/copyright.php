<?php
$copyright_text = get_field( 'copyright', 'option' );

if ( empty( $copyright_text ) ) {
	return;
}
?>

<div class="footer__bottom-col">
	<p class="footer__copyright">
		&copy;

		<?php echo date( 'Y' ); ?>

		<?php echo nl2br( esc_html( $copyright_text ) ); ?>
	</p>
</div>
