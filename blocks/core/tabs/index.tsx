// Libs
import { registerBlockType } from '@wordpress/blocks'

// Components
import TabsEdit from './components/edit'
import TabsSave from './components/save'

// Styles
import './styles/edit.scss'
import './styles/style.scss'

// @ts-ignore Data
import metadata from './block.json'

export type TAttributes = {

}

registerBlockType( metadata.name, {
    attributes: {},

    edit: TabsEdit,

    save: TabsSave
} )
