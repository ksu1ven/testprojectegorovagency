<?php
$location_map = get_field( 'location_map', 'option' );

if ( empty( $location_map ) ) {
	return;
}
?>

<div class="footer__map">
	<div id="footer-map" class="footer__map-inner" data-marker-lat="<?php echo esc_attr( $location_map['lat'] ); ?>" data-marker-lng="<?php echo esc_attr( $location_map['lng'] ); ?>"></div>
</div>
