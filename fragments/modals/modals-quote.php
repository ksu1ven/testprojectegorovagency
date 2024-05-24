<!-- Modal Request a Quote -->
<div
	id="modal-quote"
	class="modal fade modal-quote"
	tabindex="-1"
	role="dialog" aria-hidden="true"
>
	<div class="modal-dialog modal-dialog-centered modal-dialog-quote">
		<div class="modal-content">
			<div class="modal-header">
				<button
					type="button"
					class="modal-close"
					data-bs-dismiss="modal"
					aria-label="<?= esc_attr( __( 'Close popup', THEME_TEXTDOMAIN ) ) ?>"
				>
					<?= hm_get_svg_inline( get_theme_file_uri( "dist/images/icons/icon-close.svg" ) ); ?>
				</button>
			</div>

			<div class="modal-body">
				<?php echo do_shortcode( '[ninja_form id=4]' ); ?>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Request a Quote -->
