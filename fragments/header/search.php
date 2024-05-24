<div class="header-search js-header-search">
	<div class="header-search__form">
		<label class="header-search__label" for="header-search">
			<?= esc_html__( 'Search', THEME_TEXTDOMAIN ) ?>
		</label>

		<input class="header-search__input js-header-search__input" id="header-search" name="search" type="text" placeholder="Search"/>

		<button class="header-search__submit" type="submit">
			<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-search.svg' ) ) ?>
		</button>
	</div>

	<button class="header-search__open js-header-search__open">
		<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-search.svg' ) ) ?>
	</button>

	<div class="header-search__result js-header-search__result"></div>
</div>
