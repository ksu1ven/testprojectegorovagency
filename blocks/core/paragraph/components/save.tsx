/**
 * External dependencies
 */
import classnames from 'classnames'

/**
 * WordPress Dependencies
 */
import { RichText, useBlockProps } from '@wordpress/block-editor'
import { isRTL } from '@wordpress/i18n'


const Save = ( props: any ) => {
	const { attributes } = props
	const { align, content, dropCap, direction, width } = attributes;
	const className = classnames( {
		'has-drop-cap':
			align === ( isRTL() ? 'left' : 'right' ) || align === 'center'
				? false
				: dropCap,
		[ `has-text-align-${ align }` ]: align,
	} );

    return (
		<>
			<div style={ { width: width + '%' } }>
				<p { ...useBlockProps.save( { className, dir: direction } ) }>
					<RichText.Content value={ content } />
				</p>
			</div>
		</>
    )
}

export default Save
