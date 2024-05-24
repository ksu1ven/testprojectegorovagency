<?php
$bottom_links = get_field( 'bottom_links', 'option' );

if ( empty( $bottom_links ) ) {
	return;
}
?>

<div class="footer__bottom-col footer__bottom-col--desktop-only">
	<div class="footer__bottom-links">
		<?php
		$total_links = count( $bottom_links );

		foreach( $bottom_links as $index => $bottom_link ) {
			echo hm_render_button( $bottom_link['link'], 'footer__bottom-link' );

			if ( $total_links > $index + 1 ) {
				echo '|';
			}
		}
		?>
	</div><!-- /.footer__bottom-links -->
</div><!-- /.footer__bottom-col -->
