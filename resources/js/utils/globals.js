export const breakpointResizer = function() {
	const breakpoints = [
		{ name: 'mobile-small', interval: { min: 360, max: 575 }, callbacks: [] },
		{ name: 'mobile', interval: { min: 575.5, max: 767}, callbacks: [] },
		{ name: 'tablet', interval: { min: 767.5, max: 1023 }, callbacks: [] },
		{ name: 'small-desktop', interval: { min: 1023.5, max: 1279 }, callbacks: [] },
		{ name: 'desktop', interval: { min: 1279.5, max: 1439 }, callbacks: [] },
		{ name: 'large-desktop', interval: { min: 1439.5 , max: 1729 }, callbacks: [] },
		{ name: '4k', interval: { min: 1729.5 , max: 99999 }, callbacks: [] }
	]

	const currentlyActiveBreakpoint = new Proxy( { active: { interval: {}, callbacks: [] } }, {
		set( target, prop, value ) {
			const oldValue = target[prop].name
			const newValue = value.name

			if ( newValue !== oldValue )
				value.callbacks.forEach( func => func() )

			target[prop] = value
			return true
		}
	} )

	const setActiveBreakpoint = () => {
		for ( const breakpoint of breakpoints ) {
			const { interval } = breakpoint

			if ( window.matchMedia( `(min-width: ${ interval.min }px) and (max-width: ${ interval.max }px)` ).matches )
				currentlyActiveBreakpoint.active = breakpoint
		}
	}

	window.addEventListener( 'resize', setActiveBreakpoint )
	setActiveBreakpoint()

	return {
		/**
		 *
		 * @param func Function
		 */
		resize( func ) {
			breakpoints.forEach( ( { callbacks } ) => callbacks.push( func ) )
		},

		/**
		 * Performs a function on a specific breakpoints.
		 *
		 * @param breakpointName String | Array - Breakpoint name of names.
		 * @param func Function
		 */
		between( breakpointName, func ) {
			const add = name => {
				const find = breakpoints.filter( breakpoint => breakpoint.name === name )

				if ( find.length )
					find[0].callbacks.push( func )
			}

			if ( Array.isArray( breakpointName ) ) {
				breakpointName.forEach( name => add( name ) )
			} else if ( typeof breakpointName === 'string' ) {
				add( name )
			}
		},

		/**
		 * Performs a function on a specific media.
		 *
		 * @param breakpointName String	- Breakpoint name.
		 * @param func
		 */
		breakpointDown( breakpointName, func ) {
			const find = breakpoints.filter( breakpoint => breakpoint.name === breakpointName )

			if ( find.length && window.matchMedia( `(max-width: ${ find[0].interval.max - 0.5 }px)` ).matches )
				func()
		},

		/**
		 * Performs a function on a specific media.
		 *
		 * @param breakpointName String	- Breakpoint name.
		 * @param func
		 */
		breakpointUp( breakpointName, func ) {
			const find = breakpoints.filter( breakpoint => breakpoint.name === breakpointName )

			if ( find.length && window.matchMedia( `(min-width: ${ find[0].interval.min }px)` ).matches )
				func()
		},

		/**
		 * Performs a function on a specific media.
		 *
		 * @param breakpointName String | Array - Breakpoint name of names.
		 * @param func
		 */
		breakpointBetween( breakpointName, func ) {
			const run = name => {
				const find = breakpoints.filter( breakpoint => breakpoint.name === name )

				if ( find.length && window.matchMedia( `(min-width: ${ find[0].interval.min }px) and (max-width: ${ find[0].interval.max }px)` ).matches )
					func()
			}

			if ( Array.isArray( breakpointName ) ) {
				breakpointName.forEach( name => run( name ) )
			} else if ( typeof breakpointName === 'string' ) {
				run( name )
			}
		}
	}
}


export default {
	breakpointResizer
}
