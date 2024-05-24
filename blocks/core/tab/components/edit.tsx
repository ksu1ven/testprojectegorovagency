// Libs
import {
	useSelect,
	withDispatch,
	useDispatch
} from '@wordpress/data'
import {
	PanelBody,
	__experimentalInputControl as InputControl
} from '@wordpress/components'
import {
	InnerBlocks,
	InspectorControls,
	useBlockProps,
	useInnerBlocksProps,
	store as blockEditorStore
} from '@wordpress/block-editor'
import { __ } from '@wordpress/i18n'

// Types
import { TAttributes } from '../'

type TProps = {
	clientId: any,
	attributes: TAttributes,
	setAttributes: ( {} ) => any
}

const THEME_TEXT_DOMAIN = 'react-wordpress'

const TabEdit = ( { clientId, attributes, setAttributes }: TProps ) => {
	const { isActive, tabName } = attributes
	const { hasChildBlocks, rootClientId } = useSelect( ( select: any ) => {
		const { getBlockOrder, getBlockRootClientId } = select( blockEditorStore )

		return {
			hasChildBlocks: getBlockOrder( clientId ).length > 0,
			rootClientId: getBlockRootClientId( clientId ),
		};
	}, [clientId] )
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		renderAppender: hasChildBlocks ? undefined : InnerBlocks.ButtonBlockAppender
	} )

	setAttributes( {
		key: clientId
	} )

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Tab settings', THEME_TEXT_DOMAIN ) } >
					<InputControl
						type="text"
						label={ __( 'Tab Name:', THEME_TEXT_DOMAIN ) }
						placeholder={ __( 'Name', THEME_TEXT_DOMAIN ) }
						value={ tabName }
						onChange={ ( newValue: string ) => setAttributes( { tabName: newValue } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div className={ 'tabs-content__tab ' + ( isActive ? 'active' : '' ) }>
				<div>
					Hello World { tabName }
				</div>

				<div { ...innerBlocksProps } />
			</div>
		</>
	)
}

export default TabEdit
