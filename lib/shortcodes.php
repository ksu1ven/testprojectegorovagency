<?php

/**
 * Hide email from Spam Bots using a shortcode.
 *
 * @param array  $atts    Shortcode attributes. Not used.
 * @param string $content The shortcode content. Should be an email address.
 * @return string The obfuscated email address.
 */

add_shortcode( 'email', 'hm_hide_email_shortcode' );
function hm_hide_email_shortcode( $atts , $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}

/**
 * Returns current year
 *
 * @uses [year]
 */
add_shortcode( 'year', 'hm_shortcode_year' );
function hm_shortcode_year() {
	return current_time( 'Y' );
}

add_shortcode( 'blue', 'hm_blue_span_shortcode' );
function hm_blue_span_shortcode( $atts, $content = null ) {
	return '<span class="blue">' . $content . '</span>';
}
