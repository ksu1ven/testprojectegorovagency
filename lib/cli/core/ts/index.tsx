/**
 * WordPress Dependencies
 */
import { registerBlockType } from '@wordpress/blocks'

/**
 * Internal Dependencies
 */
import Edit from './components/edit'
import Save from './components/save'

/**
 * Styles
 */
import './styles/edit.scss'
import './styles/style.scss'

// @ts-ignore Data
import metadata from './block.json'


export type TAttributes = {}


registerBlockType( metadata.name, {
    attributes: {},

    example: {},

    edit: Edit,

    save: Save
} )
