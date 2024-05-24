<?php
extract( $args );

$links = [
	'tc_page_link' => __( 'Terms and Conditions', THEME_TEXTDOMAIN ),
	'pp_page_link' => __( 'Privacy Policy', THEME_TEXTDOMAIN ),
];

if ( $is_desktop ) : ?>
	<?php foreach( $links as $link_field_key => $link_label ) :
		$link_url = get_field( $link_field_key, 'option' );

		if ( empty( $link_url ) ) {
			continue;
		}
		?>

		<div class="footer__bottom-col footer__bottom-col--desktop-only">
			<a href="<?php echo esc_url( $link_url ); ?>" class="footer__bottom-link">
				<?php echo esc_html( $link_label ); ?>
			</a>
		</div>
	<?php endforeach;
else : ?>
	<div class="footer__bottom-col footer__bottom-col--desktop-hidden">
		<div class="footer__bottom-links">
			<?php foreach( $links as $link_field_key => $link_label ) :
				$link_url = get_field( $link_field_key, 'option' );

				if ( empty( $link_url ) ) {
					continue;
				}
				?>

				<a href="<?php echo esc_url( $link_url ); ?>" class="footer__bottom-link">
					<?php echo esc_html( $link_label ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif;
