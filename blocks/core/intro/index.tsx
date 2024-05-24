// Libs
import { registerBlockType } from '@wordpress/blocks'

// Components
import IntroEdit from './components/edit'
import IntroSave from './components/save'

// Styles
import './styles/edit.scss'
import './styles/style.scss'

// @ts-ignore Data
import metadata from './block.json'

// Types
import { backgroundType } from '../../../resources/js/template-parts/section-background'


export type TAttributes = {
    backgroundType: backgroundType
    backgroundImage: string
    backgroundImageAlt: string
    backgroundVideo: string
    posterImage: string
	kicker: string,
	title: string,
	subtitle: string,
	description: string
}


registerBlockType( metadata.name, {
    attributes: {
        backgroundType: { type: 'string' },
        backgroundImage: { type: 'string' },
        backgroundImageAlt: { type: 'string' },
        backgroundVideo: { type: 'string' },
        posterImage: { type: 'string' },

		kicker: { type: 'string' },
		title: { type: 'string' },
		subtitle: { type: 'string' },
		description: { type: 'string' }
    },

    example: {},

    edit: IntroEdit,

    save: IntroSave
} )
