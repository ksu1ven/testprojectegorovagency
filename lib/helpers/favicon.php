<?php

function hm_get_favicons() {
	return array(
		'apple-touch-icon-57x57.png' => array(
			'width'    => 57,
			'height'   => 57,
			'html_tag' => array(
				'type' => 'link',
				'name' => 'apple-touch-icon-precomposed',
			),
		),
		'apple-touch-icon-60x60.png' => array(
			'width'    => 60,
			'height'   => 60,
			'html_tag' => array(
				'type' => 'link',
				'name' => 'apple-touch-icon-precomposed',
			),
		),
		'apple-touch-icon-72x72.png' => array(
			'width'    => 72,
			'height'   => 72,
			'html_tag' => array(
				'type' => 'link',
				'name' => 'apple-touch-icon-precomposed',
			),
		),
		'apple-touch-icon-76x76.png' => array(
			'width'    => 76,
			'height'   => 76,
			'html_tag' => array(
				'type' => 'link',
				'name' => 'apple-touch-icon-precomposed',
			),
		),
		'apple-touch-icon-114x114.png' => array(
			'width'    => 114,
			'height'   => 114,
			'html_tag' => array(
				'type' => 'link',
				'name' => 'apple-touch-icon-precomposed',
			),
		),
		'apple-touch-icon-120x120.png' => array(
			'width'    => 120,
			'height'   => 120,
			'html_tag' => array(
				'type' => 'link',
				'name' => 'apple-touch-icon-precomposed',
			),
		),
		'apple-touch-icon-144x144.png' => array(
			'width'    => 144,
			'height'   => 144,
			'html_tag' => array(
				'type' => 'link',
				'name' => 'apple-touch-icon-precomposed',
			),
		),
		'apple-touch-icon-152x152.png' => array(
			'width'    => 152,
			'height'   => 152,
			'html_tag' => array(
				'type' => 'link',
				'name' => 'apple-touch-icon-precomposed',
			),
		),
		'apple-touch-icon-180x180.png' => array(
			'width'    => 180,
			'height'   => 180,
			'html_tag' => array(
				'type' => 'link',
				'name' => 'apple-touch-icon-precomposed',
			),
		),
		'favicon.ico' => array(
			'width'    => 32,
			'height'   => 32,
			'html_tag' => false,
		),
		'favicon-16x16.png' => array(
			'width'    => 16,
			'height'   => 16,
			'html_tag' => array(
				'type' => 'favicon',
				'name' => 'icon',
			),
		),
		'favicon-32x32.png' => array(
			'width'    => 32,
			'height'   => 32,
			'html_tag' => array(
				'type' => 'favicon',
				'name' => 'icon',
			),
		),
		'favicon-96x96.png' => array(
			'width'    => 96,
			'height'   => 96,
			'html_tag' => array(
				'type' => 'favicon',
				'name' => 'icon',
			),
		),
		'favicon-128.png' => array(
			'width'    => 128,
			'height'   => 128,
			'html_tag' => array(
				'type' => 'favicon',
				'name' => 'icon',
			),
		),
		'favicon-196x196.png' => array(
			'width'    => 196,
			'height'   => 196,
			'html_tag' => array(
				'type' => 'favicon',
				'name' => 'icon',
			),
		),
		'mstile-70x70.png' => array(
			'width'    => 70,
			'height'   => 70,
			'html_tag' => array(
				'type' => 'meta',
				'name' => 'msapplication-square70x70logo',
			),
		),
		'mstile-144x144.png' => array(
			'width'    => 144,
			'height'   => 144,
			'html_tag' => array(
				'type' => 'meta',
				'name' => 'msapplication-TileImage',
			),
		),
		'mstile-150x150.png' => array(
			'width'    => 150,
			'height'   => 150,
			'html_tag' => array(
				'type' => 'meta',
				'name' => 'msapplication-square150x150logo',
			),
		),
		'mstile-310x150.png' => array(
			'width'    => 310,
			'height'   => 150,
			'html_tag' => array(
				'type' => 'meta',
				'name' => 'msapplication-wide310x150logo',
			),
		),
		'mstile-310x310.png' => array(
			'width'    => 310,
			'height'   => 310,
			'html_tag' => array(
				'type' => 'meta',
				'name' => 'msapplication-square310x310logo',
			),
		),
	);
}

add_action( 'acf/save_post', 'hm_generate_favicons', 5 );
function hm_generate_favicons( $post_id ) {
	$fields = get_fields( $post_id );

	if ( isset( $fields['logo_icon'] ) && $post_id === 'options' ) {
		$field_object = get_field_object( 'logo_icon', $post_id );
		$field_key    = $field_object['key'];
		$new_value    = (int) $_POST['acf'][ $field_key ];
		$old_value    = (int) get_field( 'logo_icon', $post_id );

		if ( $new_value && $new_value !== $old_value ) {
			$icon_url = wp_get_attachment_url( $new_value );

			add_filter( 'https_ssl_verify', '__return_false' );

			$response = wp_remote_get( $icon_url );

			remove_filter( 'https_ssl_verify', '__return_false');

			$imagick     = new Imagick();
			$image_sizes = hm_get_favicons();

			if ( ! is_wp_error( $response ) ) {
				$icon = wp_remote_retrieve_body( $response );

				foreach ( $image_sizes as $file_name => $image_dimensions ) {
					$path = dirname( __DIR__, 2 ) . '/resources/images/favicons/' . $file_name;

					$imagick->readImageBlob( $icon );
					$imagick->resizeImage( $image_dimensions['width'], $image_dimensions['height'], \Imagick::FILTER_LANCZOS, 1 );
					$imagick->writeImage( $path );
					$imagick->destroy();
				}
			}
		}
	}
}
