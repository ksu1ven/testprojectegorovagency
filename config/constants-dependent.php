<?php

# Edit these variables' values, they're used for the WP admin panel, login page branding and for the email templates.
if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
	$theme_logo          = hm_get_media_url( get_field( 'logo',      'option' ) );
	$theme_logo_icon_url = hm_get_media_url( get_field( 'logo_icon', 'option' ) );
}

if ( $theme_logo ) {
	define( 'THEME_LOGO_URL', $theme_logo );
} else {
	define( 'THEME_LOGO_URL', get_bloginfo('stylesheet_directory') . '/resources/branding/images/default-logo-white.png' );
}

if ( $theme_logo_icon_url ) {
	define( 'THEME_LOGO_ICON_URL', $theme_logo_icon_url );
} else {
	define( 'THEME_LOGO_ICON_URL', get_bloginfo('stylesheet_directory') . '/resources/branding/images/default-logo-icon.png' );
}

define( 'HARBINGER_MARKETING_LOGO_PATH', THEME_ASSETS_PATH . '/branding/images/harbinger-marketing-logo.svg' );
define( 'HARBINGER_MARKETING_WEBSITE_URL', 'https://harbingermarketing.com/' );
