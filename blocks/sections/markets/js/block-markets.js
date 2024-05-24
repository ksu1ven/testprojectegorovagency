/**
 * Internal Dependencies
 */
import customScrollbar from '../../../../resources/js/modules/custom-scrollbar'
import { breakpointResizer } from '../../../../resources/js/utils/globals'
import { initScript } from '../../../../resources/js/utils/init-script'


const accordionModule = $section => {
	const $accordion = $section.find( '.js-markets-accordion' )
	const $items = $accordion.find( '.js-accordion-item' )
	const $spine = $items.find( '.js-accordion-spine' )
	const resizer = breakpointResizer()

	const toAccordion = function() {
		$items.each( function() {
			const $item = $( this )

			if ( $item.hasClass( 'active' ) ) {
				const $info = $item.find( '.js-accordion-info' )
				const $infoContent = $item.find( '.js-accordion-info__wrapper' )

				resizer.breakpointDown( 'small-desktop', () => {
					$info.height( $infoContent.height() )
				} )
			}
		} )
	}

	const removeCurrent = function() {
		$items.each( function() {
			$( this ).removeClass( 'active' )

			resizer.breakpointDown( 'small-desktop', () => {
				const $info = $( this ).find( '.js-accordion-info' )

				$info.animate( { height: 0 }, 300, 'swing', function() {
					$info.removeAttr( 'style' )
				} )
			} )
		} )
	}

	const setTab = function() {
		const $item = $( this ).closest( '.js-accordion-item' )
		const $info = $item.find( '.js-accordion-info' )
		const $infoContent = $item.find( '.js-accordion-info__wrapper' )

		removeCurrent()

		$item.addClass( 'active' )
		resizer.breakpointDown( 'small-desktop', () => {
			$info.animate( { height: $infoContent.height() }, 300 )
		} )
	}

	const clear = function() {
		$items.find( '.js-accordion-info' ).removeAttr( 'style' )
	}

	toAccordion()

	resizer.between( ['small-desktop', 'tablet', 'mobile', 'mobile-small'], toAccordion )
	resizer.between( ['desktop', 'large-desktop', '4k'], clear )

	$spine.on( 'click', setTab )
}

const init = function() {
	const $section = $( this )

	accordionModule( $section )
	customScrollbar( $section )
}


initScript( '.section-markets', 'markets', init )
