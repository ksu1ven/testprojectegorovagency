<?php
$phone_numbers = get_field( 'contact_phones', 'option' );

if ( empty( $phone_numbers ) ) {
	return;
}
?>

<div class="footer-contact-item">
	<h4 class="card-title footer-contact-item__title">
		<?php _e( 'Phone:', THEME_TEXTDOMAIN ) ?>
	</h4>

	<div class="footer-contact-item__main">
		<?php foreach( $phone_numbers as $phone_number ) :
			extract( $phone_number );
			?>

			<a href="tel:<?php echo hm_sanitize_phone_number_for_href( $phone ); ?>" class="footer-contact-item__link" aria-label="<?php echo sprintf( 'Phone Link: %s', $label ); ?>">
				<?php echo esc_html( $label ); ?>
			</a>
		<?php endforeach; ?>
	</div>
</div><!-- .footer-contact-item -->
