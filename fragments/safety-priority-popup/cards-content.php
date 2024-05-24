<?php
/**
 * @var array $args;
 */

extract( $args );
?>
<?php if ( !empty($cards) ) : ?>
	<div class="modal-safety-priority__cards">
		<div class="modal-safety-priority__cards-inner">
			<?php foreach ( $cards as $card ) :
				$title = esc_html( $card['title'] );
				$description = apply_filters( 'the_content', $card['description'] );
				$image_url = !empty( $card['image'] ) ? esc_url( wp_get_attachment_image_url( $card['image'], 'full-hd' ) ) : '';
				$image_alt = esc_attr( hm_get_attachment_image_alt( $card['image'] ) );
			?>
				<div class="modal-safety-priority__card-item card-item">
					<div class="card-item__image">
						<img src="<?= $image_url ?>" alt="<?= $image_alt ?>">
					</div>

					<div class="card-item__title card-title decor-line">
						<?= $title ?>
					</div>

					<div class="card-item__content text-content">
						<?= $description ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif ?>

