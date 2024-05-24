<?php

/**
 * Adds one or more classes to the body tag in the dashboard.
 *
 * @link https://wordpress.stackexchange.com/a/154951/17187
 * @param  String $classes Current body classes.
 * @return String          Altered body classes.
 */

add_filter( 'wp_mail_from', 'hm_wp_mail_from' );
function hm_wp_mail_from( $email_address ) {
	$email_address = get_field( 'wp_mail_email_from', 'option' );
	return $email_address;
}

add_filter( 'wp_mail_from_name', 'hm_wp_mail_from_name' );
function hm_wp_mail_from_name( $email_from ) {
	$email_from = get_field( 'wp_mail_name_from', 'option' );
	return $email_from;
}
