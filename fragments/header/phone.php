<?php
$phone_number = get_field( 'contact_phone', 'option' );

if ( empty( $phone_number ) ) {
	return;
}
?>

<div class="header-top__phone">
	<div class="header-phone">
		<span class="header-phone__text">
			<?= esc_html__( 'Call: ', THEME_TEXTDOMAIN ) ?>
		</span>

		<a href="tel:<?= esc_attr( hm_sanitize_phone_number_for_href( $phone_number ) ) ?>" aria-label="<?= esc_attr__( 'Call', THEME_TEXTDOMAIN ) ?> <?= esc_attr( hm_sanitize_phone_number_for_href( $phone_number ) ) ?>">
			<span class="text-wrap">
				<?= esc_html( $phone_number ); ?>
			</span>

			<span class="icon-wrap">
				<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-phone.svg' ) ) ?>
			</span>
		</a>
	</div>
</div>
