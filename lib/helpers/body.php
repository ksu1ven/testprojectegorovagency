<?php

add_action( 'wp_body_open', 'hm_custom_body_content' );
function hm_custom_body_content() {
	?>

	<div class="preloader" aria-hidden="true">
		<div class="loader-lottie">
			<lottie-player src="<?php bloginfo('template_directory'); ?>/resources/lottie/preloader.json" class="lottie-player" background="transparent" speed="1" loop autoplay></lottie-player>
		</div><!-- /.loader-lottie -->
	</div>

	<?php
}
