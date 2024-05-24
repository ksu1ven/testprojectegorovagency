// Libs
import { registerBlockType } from '@wordpress/blocks'

// Components
import TabEdit from './components/edit'
import TabSave from './components/save'

// Styles
import './styles/edit.scss'
import './styles/style.scss'

// @ts-ignore Data
import metadata from './block.json'

export type TAttributes = {
	key: string
	isActive: boolean
	tabName: string
}

registerBlockType( metadata.name, {
	attributes: {
		key: {
			type: 'string'
		},
		isActive: {
			type: 'boolean'
		},
		tabName: {
			type: 'string'
		}
	},

	example: {},

	edit: TabEdit,

	save: TabSave
} )
