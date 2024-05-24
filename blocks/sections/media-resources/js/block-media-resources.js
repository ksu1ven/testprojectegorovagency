/**
 * Internal Dependencies
 */
import MediaResources from '../../../../resources/js/class/MediaResources'
import { initScript } from '../../../../resources/js/utils/init-script'


const init = function() {
	const $section = $( this )

	new MediaResources( $section )
}


initScript( '.section-media-resources', 'media-resources', init )
