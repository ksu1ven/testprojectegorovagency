<?php
$address      = get_field( 'address', 'option' );
$address_link = get_field( 'address_link', 'option' );

if ( empty( $address ) || empty( $address_link ) ) {
	return;
}
?>

<div class="footer-contact-item">
	<h4 class="card-title footer-contact-item__title">
		<?php _e( 'Corporate HQ:', THEME_TEXTDOMAIN ) ?>
	</h4>

	<address class="footer-contact-item__main">
		<a href="<?php echo esc_url( $address_link ); ?>" target="_blank" class="footer-contact-item__link">
			<?php echo esc_html( $address ); ?>
		</a>
	</address>
</div><!-- .footer-contact-item -->
