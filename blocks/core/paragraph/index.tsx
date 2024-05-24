/**
 * WordPress Dependencies
 */
import { registerBlockType } from '@wordpress/blocks'

/**
 * Internal Dependencies
 */
import Edit from './components/edit'
import Save from './components/save'
import transforms from './components/transforms'

/**
 * Styles
 */
import './styles/edit.scss'
import './styles/style.scss'

// @ts-ignore Data
import metadata from './block.json'


export enum EDirection {
	Ltr = 'ltr',
	Rtl = 'rtl'
}

export type TAttributes = {
	align: string,
	content: any,
	dropCap: boolean,
	placeholder: string,
	direction: EDirection,
	width: number
}


registerBlockType( metadata.name, {
    attributes: {
		align: {
			type: 'string',
		},
		content: {
			type: 'string',
			source: 'html',
			selector: 'p',
			default: '',
			__experimentalRole: 'content'
		},
		dropCap: {
			type: 'boolean'
		},
		placeholder: {
			type: 'string'
		},
		direction: {
			type: 'string',
			enum: [ 'ltr', 'rtl' ]
		},
		width: {
			type: 'number'
		}
	},

    example: {},

	transforms,

    edit: Edit,

    save: Save
} )
