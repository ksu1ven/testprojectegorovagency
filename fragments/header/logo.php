<?php
$logo_header_id = get_field( 'logo', 'option' );

if ( empty( $logo_header_id ) ) {
	return;
}
?>

<div class="header-top__logo">
	<a class="header-top__logo-link" href="<?= esc_url( home_url() ) ?>" aria-label="<?= esc_attr__( 'Link to home page', THEME_TEXTDOMAIN ) ?>">
		<span class="header-top__logo-inner">
			<?php if ( hm_is_svg_image( $logo_header_id ) ) : ?>
				<?= hm_get_svg_inline( wp_get_attachment_url( $logo_header_id ) ); ?>
			<?php else : ?>
				<img src="<?= esc_url( wp_get_attachment_image_url( $logo_header_id, 'full' ) ) ?>" alt="<?= esc_attr__( 'Logo', THEME_TEXTDOMAIN ) ?>">
			<?php endif ?>
		</span>
	</a>
</div>
