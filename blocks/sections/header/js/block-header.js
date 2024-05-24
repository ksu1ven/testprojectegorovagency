/**
 * Internal Dependencies
 */
import { initScript } from '../../../../resources/js/utils/init-script'
import { breakpointResizer } from '../../../../resources/js/utils/globals'
import { debounce } from '../../../../resources/js/utils/index'


const fullscreenMenuModule = $header => {
	const $body = $( 'body' )
	const $fullscreenMenu = $header.find( '.js-fullscreen-menu' )
	const $openBtn = $header.find( '.js-open-fullscreen-menu' )
	const $fullscreenMenuCenter = $header.find( '.js-fullscreen-menu__center' )
	const resizer = breakpointResizer()

	/* First Level Menu */
	const $firstLevelSubMenu = $fullscreenMenuCenter.find( '#main-menu' )
	const $firstLevelSubMenuLi = $firstLevelSubMenu.children()
	const $firstLevelSubMenuArrows = $firstLevelSubMenuLi.children( 'a' ).find( '.parent-menu-item-arrow' )
	const tabletSubMenu = {
		id: 'tablet-sub-menu',
		class: 'tablet-sub-menu'
	};

	/*
	* Transfer sub menus to .tablet-sub-menu
	* */
	(() => {
		const container = document.createElement( 'div' )

		$firstLevelSubMenuLi.each( function() {
			const $li = $( this )
			const $submenu = $li.children( '.sub-menu' )
			const idClass = $li.attr( 'class' ).match( /menu-item-[\d]+/ )[0]

			$submenu.clone().css( 'display', 'none' ).addClass( idClass ).appendTo( container )
		} )

		container.setAttribute( 'id', tabletSubMenu.id )
		container.setAttribute( 'class', tabletSubMenu.class )

		$fullscreenMenuCenter.append( container )
	})()

	/* Other Level Menu */
	const $otherLevelSubMenu = $firstLevelSubMenuLi.children( '.sub-menu' )
	const $otherLevelSubMenuLi = $otherLevelSubMenu.children()
	const $otherLevelSubMenuArrows = $otherLevelSubMenuLi.children( 'a' ).find( '.parent-menu-item-arrow' )

	/* Tablet Menu */
	const $tabletSubMenu = $fullscreenMenuCenter.find( `.${ tabletSubMenu.class }` )
	const $tabletSubMenuLi = $tabletSubMenu.children().children()
	const $tabletSubMenuArrows = $tabletSubMenuLi.children( 'a' ).find( '.parent-menu-item-arrow' )

	const openMenu = function( event ) {
		event.preventDefault()

		const $btn = $( this )
		const $btnTextSpan = $btn.find( '.js-header-btn__text' )
		const textState = { default: 'Menu', active: 'Close' }

		$body.toggleClass( 'scroll-off' )
		$header.toggleClass( 'fullscreen-active' )

		if ( $header.hasClass( 'fullscreen-active' ) )
			$btnTextSpan.html( textState.active )
		else
			$btnTextSpan.html( textState.default )
	}

	const otherLevelBlur = ( $current = null ) => {
		if ( $current ) {
			$tabletSubMenuLi.each( function() {
				if ( $current.attr( 'class' ) !== $( this ).attr( 'class' ) )
					$( this ).removeClass( 'active' )
			} )

			$otherLevelSubMenuLi.each( function() {
				if ( $current.attr( 'class' ) !== $( this ).attr( 'class' ) )
					$( this ).removeClass( 'active' )
			} )
		} else {
			$tabletSubMenuLi.removeClass( 'active' )
			$otherLevelSubMenuLi.removeClass( 'active' )
		}
	}

	const otherLevelEvent = function( event ) {
		event.preventDefault()

		const $arrow = $( this )
		const $li = $arrow.parent().parent()

		resizer.breakpointDown( 'small-desktop', () => {
			otherLevelBlur( $li )
			$li.toggleClass( 'active' )
		} )
	}

	const closeTabletSubMenus = () => {
		$tabletSubMenu.children().each( function() {
			const $ul = $( this )

			if ( $ul.hasClass( 'active' ) ) {
				otherLevelBlur()
				$ul.removeClass( 'active' )
				setTimeout( () => $ul.css( 'display', 'none' ), 350 )
			}
		} )
	}

	const openTabletSubMenus = ( idClass = '' ) => {
		const $subMenu = $tabletSubMenu.find( `.${ idClass }` )

		closeTabletSubMenus()

		setTimeout( () => {
			$subMenu.css( 'display', 'block' )

			setTimeout( () => $subMenu.addClass( 'active' ), 100 )
		}, 350 )
	}

	const firstLevelEvent = function( event ) {
		event.preventDefault()

		const $arrow = $( this )
		const $li = $arrow.parent().parent()
		const targetIdClass = $li.attr( 'class' ).match( /menu-item-[\d]+/ )[0]
		const isActive = $li.hasClass( 'active' )

		resizer.breakpointBetween( ['small-desktop', 'tablet'], () => {
			openTabletSubMenus( targetIdClass )
			$firstLevelSubMenuLi.removeClass( 'active' )
			$li.addClass( 'active' )
		} )

		resizer.breakpointDown( 'mobile', () => {
			if ( !isActive )
				$firstLevelSubMenuLi.removeClass( 'active' )

			$li.toggleClass( 'active' )
		} )
	}

	const reset = () => {
		resizer.breakpointBetween( ['small-desktop', 'tablet'], () => {
			closeTabletSubMenus()
			$firstLevelSubMenuLi.removeClass( 'active' )
		} )

		resizer.breakpointDown( 'mobile', () => {
			$firstLevelSubMenuLi.removeClass( 'active' )
		} )
	}

	$openBtn.on( 'click', openMenu )
	$firstLevelSubMenuArrows.on( 'click', firstLevelEvent )
	$tabletSubMenuArrows.on( 'click', otherLevelEvent )
	$otherLevelSubMenuArrows.on( 'click', otherLevelEvent )

	/* Blur event */
	$fullscreenMenu.on( 'click', function( event ) {
		if ( event.target.tagName !== 'DIV' )
			return

		reset()
	} )
	resizer.resize( reset )
}

const searchModule = $header => {
	const $search = $header.find( '.js-header-search' )
	const $searchInput = $search.find( '.js-header-search__input' )
	const $openSearch = $search.find( '.js-header-search__open' )
	const $searchResults = $header.find( '.js-header-search__result' );
	let inputValue = $searchInput.val() ?? '';

	const focus = function() {
		$search.addClass( 'active' )

		if ( inputValue.length !== 0 )
			$search.addClass( 'show-result' )
	}

	const typing = function() {
		const searchQuery = $( this ).val()

		$search.addClass( 'show-result' )

		inputValue = searchQuery

		const renderMessage = message => ( `
			<ul>
				<li>
					<span>
						${ message }
					</span>
				</li>
			</ul>
		` )

		if ( !inputValue.length ) {
			$search.removeClass( 'show-result' )
			$searchResults.html( '' )
		} else {
			$.ajax( {
				url: hm_global.ajaxurl + 'header_search/',
				method: 'GET',
				data: {
					search_query: searchQuery
				},
				dataType: 'text',
				beforeSend() {
					$searchResults.html( renderMessage( 'Loading... (づ ◕‿◕ )づ' ) );
				},
				success( response ) {
					if ( response.success ) {
						$searchResults.html( response.data )
					} else {
						$searchResults.html( renderMessage( 'No search result found! ¯\\_(ツ)_/¯' ) )
					}
				},
				complete() {
					$search.addClass( 'show-result' )
				}
			} )
		}
	}

	const blur = function() {
		$search
			.removeClass( 'active' )
			.removeClass( 'show-result' )
			.removeClass( 'open-search' )
	}

	const openSearch = function() {
		$search.addClass( 'open-search' )
		setTimeout( () => $searchInput.focus(), 300 )
	}

	$searchInput.on( 'focus', focus )
	$searchInput.on( 'input', debounce( typing, 250 ) )
	$searchInput.on( 'blur', blur )
	$openSearch.on( 'click', openSearch )
}

const bottomNavigationModule = $header => {
	const $bottomNavigation = $header.find( '#main-menu' )
	const resizer = breakpointResizer()

	if ( !$bottomNavigation.length )
		return

	const fillElement = element => {
		const $bottomNavigationChild = $bottomNavigation.children()
		const maxWidth = $bottomNavigation.width()
		let calcLiWidth = 0

		$bottomNavigationChild.each( function() {
			const node = $( this )[0]

			calcLiWidth += node.getBoundingClientRect().width

			if ( calcLiWidth + 100 > maxWidth )
				element.appendChild( node )
		} )

		return element
	}

	const clearMoreElement = () => {
		const $moreLi = $bottomNavigation.find( '#custom-more-li' )
		const subMenuLi = $moreLi.children( '.sub-menu' ).children()

		if ( $moreLi.length ) {
			if ( subMenuLi.length )
				$bottomNavigation.append( subMenuLi )

			$moreLi.remove()
		}
	}

	const transferMenuElement = () => {
		const moreLi = document.createElement( 'li' )
		const moreUl = fillElement( document.createElement( 'ul' ) )
		const moreLink = `
				<a href="#">
					More...

					<span class="parent-menu-item-arrow">
						<svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.25 5.375L6.5 8.625L9.75 5.375" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path></svg>
					</span>
				</a>
			`

		if ( !moreUl.childNodes.length )
			return

		moreLi.setAttribute( 'id', 'custom-more-li' )
		moreLi.setAttribute( 'class', 'custom-more-li' )
		moreUl.setAttribute( 'class', 'sub-menu' )

		moreLi.insertAdjacentHTML( 'afterbegin', moreLink )
		moreLi.insertAdjacentElement( 'beforeend', moreUl )
		$bottomNavigation.append( moreLi )
	}

	const run = () => {
		clearMoreElement()
		transferMenuElement()
	}

	run()
	resizer.between( ['desktop', 'large-desktop', '4k'], () => setTimeout( run, 100 ) )
}

const init = function( section ) {
	const $header = $( section )
	const headerWrap = $header.parents('.wp-block-template-part');

	if ( headerWrap.length )
		headerWrap.addClass('header-wrap')

	searchModule( $header )
	fullscreenMenuModule( $header )
	bottomNavigationModule( $header )
}


initScript( '.header', 'header', init )
