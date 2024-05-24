/**
 * WordPress Dependencies
 */
import {
	Panel,
	PanelBody,
	PanelRow
} from '@wordpress/components'

import {
	useBlockProps,
	InspectorControls,
} from '@wordpress/block-editor'

import { more } from '@wordpress/icons'
import { __ } from '@wordpress/i18n'

/**
 * Internal Dependencies
 */
//...

/**
 * Internal Types
 */
import { TAttributes } from '../'


const THEME_TEXT_DOMAIN = 'react-wordpress'


type TProps = {
	clientId: string
    attributes: TAttributes
    setAttributes: ( {} ) => any
}


const Edit = ( props: TProps ) => {
    const { attributes } = props
    const { } = attributes
    const blockProps = useBlockProps()

    blockProps.className += ' section section-{{name}} block-preview'

    return (
        <>
            <InspectorControls key="setting">
				<Panel header="My panel">
					<PanelBody
						title={ __( 'Settings', THEME_TEXT_DOMAIN ) }
						icon={ more }
						initialOpen={ true }
					>
						<PanelRow>

						</PanelRow>
					</PanelBody>
				</Panel>
            </InspectorControls>

            <section { ...blockProps }>

            </section>
        </>
    )
}

export default Edit
