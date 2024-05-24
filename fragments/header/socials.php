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

<div class="menu-column social">
	<span class="menu-column__title">
		<?= esc_html__( 'Social:', THEME_TEXTDOMAIN ); ?>
	</span>

	<div class="menu-column__content social__content">
		<?php foreach( $socials as $social_key => $social_icon ) : ?>
			<?php
				$social_url = get_field( "social_{$social_key}", 'option' );

				if ( empty( $social_url ) ) {
					continue;
				}
			?>

			<a href="<?= esc_url( $social_url ); ?>" class="social__link" aria-label="<?= ucfirst( $social_key ); ?> Link" target="_blank">
				<span class="icon-wrap">
					<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/' . $social_icon ) ); ?>
				</span>
			</a>
		<?php endforeach; ?>
	</div>
</div>
