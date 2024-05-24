<!-- Modal Video -->
<div
	id="modal-video"
	class="modal fade modal-video"
	tabindex="-1"
	role="dialog" aria-hidden="true"
>
	<div class="modal-dialog modal-dialog-centered modal-dialog-video">
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
				<div class="modal-video__body-wrap">
					<div class="modal-video__video self-hosted-video">
						<video
							disablePictureInPicture
							controls playsinline
							poster=""
							loop="loop"
						>
							<source src="" type="video/mp4">
						</video>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Video -->

<!-- Modal YouTube Video -->
<div
	id="modal-youtube-video"
	class="modal fade modal-video"
	tabindex="-1"
	role="dialog" aria-hidden="true"
>
	<div class="modal-dialog modal-dialog-centered modal-dialog-video">
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
				<div class="modal-video__body-wrap">
					<div class="modal-video__video video-responsive">
						<div class="modal-video__player js-modal-video-player"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Modal YouTube Video -->