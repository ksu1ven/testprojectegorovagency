<?php
/**
 * Buttons.
 *
 * @param string $class_name
 * @param array $buttons
 *
 * @var $args
*/

extract( $args );

if ( empty( $buttons['buttons_generator'] ) )
	return;
?>

<div class="buttons-wrap <?= !empty( $class_name ) ? esc_attr( $class_name ) : '' ?>">
	<?php
		foreach ( $buttons['buttons_generator'] as $button )
			get_template_part( 'fragments/common/button', '', ['button' => $button] );
	?>
</div>
