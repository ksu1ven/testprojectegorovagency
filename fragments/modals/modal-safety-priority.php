<?php
/**
 * @var array $args;
 */

extract( $args );
?>

<div
	id="modal-safety-priority-<?= $card['popup_id'] ?>"
	class="modal fade modal-safety-priority"
	tabindex="-1"
	role="dialog" aria-hidden="true"
>
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button
					type="button"
					class="modal-close"
					data-bs-dismiss="modal"
					aria-label="<?= esc_attr( __( 'Close popup', THEME_TEXTDOMAIN ) ) ?>"
				>
					<?= hm_svg_inline( THEME_ASSETS_URL . '/images/icons/icon-close.svg' ); ?>
				</button>
			</div>

			<div class="modal-body">
				<div class="modal-safety-priority__body-wrap decor-line decor-line--section">
					<?php foreach ( $card['card_content'] as $content ) : ?>
						<?php if ( $content['content_type'] == 'text' ) : ?>
							<div class="modal-safety-priority__simple-content">
								<div class="text-content">
									<?= apply_filters( 'the_content', $content['text'] ) ?>
								</div>
							</div>

							<?php continue; ?>
						<?php endif ?>

						<?php if ( $content['content_type'] == 'slider' ) : ?>
							<?php get_template_part( 'fragments/safety-priority-popup/slider', null, [
								'slider' => $content['slider'],
							] ); ?>

							<?php continue; ?>
						<?php endif ?>

						<?php if ( $content['content_type'] == 'cards' ) : ?>
							<?php get_template_part( 'fragments/safety-priority-popup/cards-content', null, [
									'cards' => $content['cards'],
							] ); ?>

							<?php continue; ?>
						<?php endif ?>

						<?php if ( $content['content_type'] == 'text_with_side_image' ) : ?>
							<?php get_template_part( 'fragments/safety-priority-popup/text-with-side-image', null, [
								'content' => $content['text_with_side_image'],
							] ); ?>

							<?php continue; ?>
						<?php endif ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
