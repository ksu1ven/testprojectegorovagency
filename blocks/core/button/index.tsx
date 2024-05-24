/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks'

/**
 * Internal dependencies
 */
import ButtonEdit from './components/edit'
import ButtonSave from './components/save'

/**
 * Styles
 */
import './styles/edit.scss'
import './styles/style.scss'

// @ts-ignore Data
import metadata from './block.json'

export enum EType {
	Link = 'link',
	Popup = 'popup',
	Video = 'video'
}
export enum EVideoType {
	SelfHosted = 'selfHosted',
	YouTube = 'youtube'
}
export type TAttributes = {
	type: EType
	value: string
	link: string
	target: string
	popupId: number
	videoType: EVideoType
	videoFile: string
	videoPoster: string
	videoLink: string
}


registerBlockType( metadata.name, {
    attributes: {
		type: { enum: [ 'link', 'popup', 'video' ] },
		value: { type: 'string' },

		link: { type: 'string' },
		target: { type: 'string' },

		popupId: { type: 'number' },

		videoType: { enum: [ 'selfHosted', 'youtube' ] },
		videoFile: { type: 'string' },
		videoPoster: { type: 'string' },
		videoLink: { type: 'string' },
    },

    example: {},

    edit: ButtonEdit,

    save: ButtonSave
} )
