/**
 * WordPress dependencies
 */
import { createBlock, getBlockAttributes } from '@wordpress/blocks'

// @ts-ignore Data
import { name } from '../block.json'

const transforms = {
	from: [
		{
			type: 'raw',
			priority: 20,
			selector: 'p',
			schema: ( { phrasingContentSchema, isPaste } ) => ( {
				p: {
					children: phrasingContentSchema,
					attributes: isPaste ? [] : [ 'style', 'id' ],
				},
			} ),
			transform( node ) {
				const attributes = getBlockAttributes( name, node.outerHTML )
				const { textAlign } = node.style || {}

				if ( textAlign === 'left' || textAlign === 'center' || textAlign === 'right' )
					attributes.align = textAlign

				return createBlock( name, attributes )
			},
		},
	],
}

export default transforms
