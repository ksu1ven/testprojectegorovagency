/**
 * Internal Dependencies
 */
import resetBlockEvents from "../modules/editor"

export const initScript = ( sectionSelector, blockName, callback ) => {
	const initializeBlock = function ( section = false, isAdmin = false ) {
		const $sections = section ? $( section ) : $( sectionSelector );

		$sections.each( (i, section) => callback(section , isAdmin) )
	};

	window.acf.addAction("ready", function () {
		if ( window.acf.isGutenberg() ) {
			// Site Editor
			window.acf.addAction(
				`render_block_preview/type=${ blockName }`,
				adminInitializeBlock( initializeBlock, sectionSelector )
			);
		} else {
			// Front-end
			$(document).ready(function(){
				initializeBlock();
			});
		}
	});
}

export const initFrontScript = ( sectionSelector, blockName, callback ) => {
	const initializeBlock = function ( section = false ) {
		const $sections = section ? $( section ) : $( sectionSelector );

		$sections.each( ( i, section ) => callback( section ) )
	};

	window.acf.addAction("ready", function () {
		if ( !window.acf.isGutenberg() ) {
			$( document ).ready(function(){
				initializeBlock();
			});
		}
	});
}

export const initBackScript = ( sectionSelector, blockName, callback ) => {
	const initializeBlock = function ( section = false ) {
		const $sections = section ? $( section ) : $( sectionSelector );

		$sections.each( ( i, section ) => callback( section ) )
	};

	window.acf.addAction("ready", function () {
		if ( window.acf.isGutenberg() ) {
			window.acf.addAction(
				`render_block_preview/type=${ blockName }`,
				adminInitializeBlock( initializeBlock, sectionSelector )
			);
		}
	});
}


export default {
	initScript,
	initFrontScript,
	initBackScript
}
