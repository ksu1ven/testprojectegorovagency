<?php
$phone_numbers = get_field( 'contact_phones', 'option' );

if ( empty( $phone_numbers ) ) {
	return;
}
?>

<div class="menu-column phone">
	<span class="menu-column__title">
		<?= esc_html__( 'Phone:', THEME_TEXTDOMAIN ); ?>
	</span>

	<div class="menu-column__content phone__content">
		<?php foreach( $phone_numbers as $phone_number ) : ?>
			<?php
				extract( $phone_number );

				if ( empty( $phone ) || empty( $label ) ) {
					return;
				}
			?>

			<a href="tel:<?= hm_sanitize_phone_number_for_href( $phone ); ?>" class="phone__link" aria-label="<?= esc_attr( sprintf( __( 'Phone Link: %s', THEME_TEXTDOMAIN ), $label ) ) ?>">
				<?= esc_html( $label ); ?>
			</a>
		<?php endforeach; ?>
	</div>
</div>
