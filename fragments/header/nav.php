<?php
extract( $args );

$location = !empty( $location ) ? $location : '';
$container_class = !empty( $container_class ) ? $container_class : '';

if ( !has_nav_menu( $location ) ) {
	return;
}
?>

<div class="<?= esc_attr( $container_class ); ?>">
	<?php
		wp_nav_menu( array(
			'theme_location' => $location,
			'container'      => false,
			'menu_id'        => $location,
			'walker'         => new HMT_Walker_Nav_Menu()
		) );
	?>
</div>
