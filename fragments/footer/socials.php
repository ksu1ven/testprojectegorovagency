<?php
$socials = array(
	'facebook'  => 'icon-soc-fb.svg',
	'linkedin'  => 'icon-soc-linkedin.svg',
	'youtube'   => 'icon-soc-youtube.svg',
	'twitter'   => 'icon-soc-twitter.svg',
	'instagram' => 'icon-soc-instagram.svg',
	'tiktok'    => 'icon-soc-tiktok.svg',
);
?>

<div class="footer-contact-item">
	<h4 class="card-title footer-contact-item__title">
		<?php _e( 'Social:', THEME_TEXTDOMAIN ) ?>
	</h4>

	<div class="footer-contact-item__main footer-social-links">
		<?php foreach( $socials as $social_key => $social_icon ) :
			$social_url = get_field( "social_{$social_key}", 'option' );

			if ( empty( $social_url ) ) {
				continue;
			}
			?>

			<a href="<?php echo esc_url( $social_url ); ?>" class="icon-wrap footer-social-link" aria-label="<?php echo ucfirst( $social_key ); ?> Link" target="_blank">
				<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/' . $social_icon ) ); ?>
			</a>
		<?php endforeach; ?>
	</div>
</div><!-- .footer-contact-item -->
