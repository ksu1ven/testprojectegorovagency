/**
 * Internal dependencies
 */
import { initScript } from '../../../../resources/js/utils/init-script'

const init = function() {
	const $tabs = $( this )
	const $items = $tabs.find( '.tabs-nav-line__item' )
	const $contents = $tabs.find( '.tabs-content__tab' )

	$items.on( 'click', function() {
		const $this = $( this )
		const dataTarget = $this.data( 'hmTarget' )

		$items.each( function() {
			$( this ).removeClass( 'active' )
		} )

		$contents.each( function() {
			const $content = $( this )

			if ( $content.data( 'hmTab' ) === dataTarget )
				return $content.addClass( 'active' )

			$content.removeClass( 'active' )
		} )

		$this.addClass( 'active' )
	} )
}

initScript( '.js-tabs', 'react-wordpress/tabs', init )
