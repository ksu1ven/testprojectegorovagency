/**
 * Internal Dependencies
 */
import select2 from "select2";


const tabsWithFilteringData = [
	{
		tabSelector: '.posts-tab',
		cardsSelector: '.post__card',
		cardsWrapper: '.posts-tab__cards-container'
	},
	{
		tabSelector: '.video-library-tab',
		cardsSelector: '.video-library-tab__card',
		cardsWrapper: '.video-library-tab__wrapper'
	},
];


class MediaResources {
	query = {
		search: '',
		tag: '',
	}
	ajax_more_posts = undefined;

	constructor($section) {
		this.section = $section,
		this.init()
	}

	init () {
		this.initTabs();
		this.initFilterByTag ()
		this.initSearchForm ()
		this.initResetButton()

		this.customAjax();
	}

	initTabs() {
		const $naviagtionItemsAll = this.section.find('.tabs-navigation-line__item'),
			$tabsContainer = this.section.find('.section-media-resources__tabs');

		let $activeTab = $tabsContainer.find('.section-media-resources__tab:first-child'),
			activeTabId = $activeTab.attr('data-hm-tab'),
			$activeNavigationItem = this.section.find('.tabs-navigation-line__item.active');

		if(!$activeTab.length) return;

		$activeTab.addClass('active')

		this.switchSidebarVisibility($activeTab)

		$naviagtionItemsAll.each((i, item) => {
			let $navigationItem = $(item);

			$navigationItem.off('click');

			$navigationItem.on('click', e => {
				let $navigationItemClicked = $(e.currentTarget),
					targetTabId = $navigationItemClicked.attr('data-hm-target'),
					$targetTab = $tabsContainer.find(`[data-hm-tab=${targetTabId}]`);

				if ( $targetTab.length && activeTabId !== targetTabId ) {
					this.switchTabs( $activeTab, $targetTab, $activeNavigationItem, $navigationItemClicked )
					this.switchSidebarVisibility($targetTab)
					$activeNavigationItem = $navigationItemClicked;
					$activeTab = $targetTab;
					activeTabId = targetTabId;
				}
			})
		})
	}

	switchTabs (currentTab, targetTab, activeNavigationItem, navigationItemTarget) {
		activeNavigationItem.removeClass('active')
		navigationItemTarget.addClass('active')
		currentTab.removeClass('active')
		targetTab.addClass('active')

		currentTab.fadeOut(200, function () {
			targetTab.fadeIn(200)
		})
	}

	switchSidebarVisibility (nextTab) {
		if(!nextTab.length) return;

		let $sidebar = this.section.find('.section-media-resources__sidebar-container'),
			arrayOfTabClasses = nextTab.attr("class").split(/\s+/),
			isSidebarVisible = false;

		tabsWithFilteringData.forEach(tabData => {
			if(arrayOfTabClasses.includes(tabData.tabSelector.replace(/^[.]+/,""))) {
				isSidebarVisible = true
				return
			}
		})

		if(isSidebarVisible) {
			$sidebar.fadeIn(400)
		} else {
			$sidebar.fadeOut(200)
		}
	}

	filterCardsInTabWithSidebar () {
		tabsWithFilteringData.forEach(tabData => {
			const $tabs = this.section.find(tabData.tabSelector);

			$tabs.each((i, item) => {
				const $tab = $(item);
				const $cards = $tab.find(tabData.cardsSelector);

				$tab.fadeOut(200, () => {
					let isFirst = false;

					$cards.each((index, card) => {
						let $card = $(card);

						$card.removeClass('post__card--full');


						if( this.isCardTagValid( $card, this.query.tag) && this.isCardBySearchValid( $card, this.query.search ) ) {
							$card.show(0);
							$card.attr('data-hm-filtered', 'true')
							return;
						}

						$card.hide(0);
						$card.removeAttr('data-hm-filtered')
					})

					$cards.each((i, item) => {
						let $card = $(item);

						if($card.attr('data-hm-filtered') && !isFirst) {
							$card.addClass('post__card--full');
							isFirst = true;
						}
					})
				});

				if($tab.hasClass('active')) {
					$tab.fadeIn(200);
				}
			})
		})
	}

	isCardTagValid ( $card, tag ) {
		let isCardIncludesTag = $card.attr('data-hm-tag').includes(tag);

		return isCardIncludesTag;
	}

	isCardBySearchValid ( $card, searchText ) {
		const $elementsUsedInSearch = $card.find('.js-used-in-search');
		let isSearchSuccess = false;

		$elementsUsedInSearch.each(function () {
			let $element = $(this);
			let elementText = $element.text().trim().toLowerCase();
			let searchTextValid = searchText.trim().toLowerCase();

			if(elementText.includes(searchTextValid)) {
				isSearchSuccess = true;
				return;
			}
		})

		return isSearchSuccess;
	}

	initFilterByTag () {
		const $filters = this.section.find('.sidebar-filter__list-item');
		const $mobileSelect = this.section.find('.sidebar-mobile-filter__select');

		if(!$filters.length) return;

		let $activeFilter;

		$mobileSelect.select2({
			placeholder: 'Popular Topics'
		});
		$mobileSelect.on('select2:select', (e) => {
			const tag = $(e.currentTarget).val();

			if (tag) {
				this.query.tag = tag;
				this.filterCardsInTabWithSidebar()
			}

			$filters.each((i, item) => {
				const $filter = $(item);

				if(tag === $filter.attr('data-hm-tag')) {
					$activeFilter?.removeClass('active')
					$filter.addClass('active')
				}
			})
		  });

		$filters.off('click');

		$filters.on('click', e => {
			const $filter = $(e.currentTarget),
				tag = $filter.attr('data-hm-tag');

			$activeFilter?.removeClass('active')
			$filter.addClass('active')
			$activeFilter = $filter;

			if (tag) {
				this.query.tag = tag;
				$mobileSelect.val(tag);
				$mobileSelect.trigger('change');
				this.filterCardsInTabWithSidebar()
			}

		})
	}

	initSearchForm () {
		const $searchForm = this.section.find('.search-input-for-sections__form');

		if(!$searchForm.length) return;

		$searchForm.submit(e => {
			e.preventDefault();

			const $searchInput = $searchForm.find('.search-input-for-sections__input');

			this.query.search = $searchInput.val();
			this.filterCardsInTabWithSidebar();
		})
	}

	resetAll () {
		this.query = {
			search: '',
			tag: '',
		}

		const $filters = this.section.find('.sidebar-filter__list-item');
		const $searchInput = this.section.find('.search-input-for-sections__input');

		$filters.each(function () {
			$(this).removeClass('active')
		})

		$searchInput.val('')

		this.filterCardsInTabWithSidebar();
	}

	initResetButton() {
		let $resetButton = this.section.find('.js-media-resource-reset');

		if(!$resetButton.length) return;

		$resetButton.on('click', () => this.resetAll())
	}

	ajaxCardsFilter ( $container, cardSelector ) {
		const $cards = $container.find(cardSelector);

		$cards.each((index, card) => {
			let $card = $(card);

			$card.removeClass('post__card--full');


			if( this.isCardTagValid( $card, this.query.tag) && this.isCardBySearchValid( $card, this.query.search ) ) {
				$card.show(0);
				$card.attr('data-hm-filtered', 'true')
				return;
			}

			$card.hide(0);
			$card.removeAttr('data-hm-filtered')
		})

		return $cards
	}

	customAjax() {
		tabsWithFilteringData.forEach(tabData => {
			const $tabs = this.section.find(tabData.tabSelector);

			$tabs.each((i, item) => {
				const $tab = $(item);
				const $button = $tab.find('.js-load-more');
				const buttonText = $button.text();
				const tabType = $button.data( 'hmTabType' );
				const category = $button.data( 'hmCategory' );
				const max_pages = $button.attr('data-hm-max-page');

				let nextPage = 2;

				$button.on( 'click', () => {
					const data = {
						tab_type: tabType,
						page: nextPage,
						category_name: category
					}

					this.ajax_more_posts = $.ajax({
						url: hm_global.ajaxurl + 'load_resources/',
						data: data,
						type: 'POST',
						dataType: 'text',
						beforeSend: ( xhr ) => {
							$button.text('Loading...');
						},
						success: ( data ) => {
							this.ajax_more_posts = undefined;
							$button.text(buttonText);

							if (data) {
								let $cardsConatiner = $tab.find(tabData.cardsWrapper)
								let wrapper = document.createElement('div')
								wrapper.insertAdjacentHTML('afterbegin', data)
								let $wrapper = $(wrapper);
								$cardsConatiner.append(this.ajaxCardsFilter($wrapper, tabData.cardsSelector))

								if (nextPage == max_pages)
									$button.remove(); // if last page, remove the button

								nextPage++;

							} else {
								$button.remove(); // if no data, remove the button as well
							}
						},
						error: ( jqXHR, textStatus, errorThrown ) => {
							this.ajax_more_posts = undefined;
							$button.text(buttonText);
							console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
						}
					});
				} )
			})
		})
	}
}

export default MediaResources
