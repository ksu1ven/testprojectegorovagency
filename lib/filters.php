<?php

//add_filter('wpseo_breadcrumb_single_link', 'hm_add_class_to_breadcrumb_links');
function hm_add_class_to_breadcrumb_links($link_output) {
	$link_output = preg_replace('/(<a.*?>)/', '$1<span class="my-link-class">', $link_output);
	$link_output = preg_replace('/(<\/a>)/', '</span>$1', $link_output);
	return $link_output;
}

add_filter( 'ninja_forms_render_default_value', 'hm_map_field_value', 10, 3 );
function hm_map_field_value( $default_value, $field_type, $field_settings ) {
	$map_markers = get_field( 'popup_map_markers', 'option' );

	if ( 'html' == $field_type && 'field-map' == $field_settings['element_class'] && ! empty( $map_markers ) ) {
		ob_start();

		$markers = array();

		foreach ($map_markers as $marker) {
			$markers[] = array(
				'lat' => $marker['marker_location']['lat'],
				'lng' => $marker['marker_location']['lng'],
			);
		}
		?>

		<div class="form-map">
			<?php echo $default_value; ?>

			<div class="form-map__inner">
				<div class="map" data-markers='<?php echo json_encode($markers); ?>'></div><!-- /.map -->
			</div><!-- /.form-map__inner -->
		</div><!-- /.form-map -->

		<?php
		$default_value = ob_get_clean();
	}

	return $default_value;
}
