<?php
/**
 * Buttons.
 *
 * @param string $ID
 * @param string $class_for_js
 * @param string $additional_classes
 *
 * @var $args
*/

extract( $args );
?>
<div class="search-input-for-sections <?= $additional_classes ?>">
	<label class="search-input-for-sections__label" for="<?= $ID ?>">
		<?= esc_html__( 'Search', THEME_TEXTDOMAIN ) ?>
	</label>

	<form class="search-input-for-sections__form">
		<input
			class="search-input-for-sections__input <?= $class_for_js ?>"
			id=""
			name="search"
			type="text"
			placeholder="Search"
		/>

		<button class="search-input-for-sections__submit" type="submit">
			<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-search.svg' ) ) ?>
		</button>
	</form>
</div>