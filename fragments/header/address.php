<?php
$address      = get_field( 'address', 'option' );
$address_link = get_field( 'address_link', 'option' );

if ( empty( $address ) || empty( $address_link ) ) {
	return;
}
?>

<div class="menu-column address">
	<span class="menu-column__title">
		<?= esc_html__( 'Corporate HQ:', THEME_TEXTDOMAIN ); ?>
	</span>

	<div class="menu-column__content address__content">
		<a href="<?= esc_url( $address_link ); ?>" class="address__link" aria-label="Link to Corporate HQ Address on Google Maps" target="_blank">
			<?= esc_html( $address ); ?>
		</a>
	</div>
</div>
