// Libs
import { useSelect, withDispatch, useDispatch } from '@wordpress/data'
import {
	useBlockProps,
	useInnerBlocksProps,
	InspectorControls,
	RichText,
	store as blockEditorStore
} from '@wordpress/block-editor'
import { useState, useRef } from '@wordpress/element'
import { __ } from '@wordpress/i18n'
import { createBlock } from '@wordpress/blocks'
import { PanelBody, Notice, RangeControl } from '@wordpress/components'

// Types
import { TAttributes } from '../'
import { TEditBlockDispatch, TBlock, TRegistry } from '../../../../resources/types/libs'

export type TProps = {
    clientId: string,
    attributes: TAttributes,
    setAttributes: ( {} ) => any
}

const TAB_COMPONENT = 'ea-component/tab'
const ALLOWED_BLOCKS = [ TAB_COMPONENT ]
const THEME_TEXT_DOMAIN = 'react-wordpress'

type TTabItem = {
	key: number|string
	content: string
	block: TBlock
	setActiveTab: ( clientId: string ) => void
	deleteTab: ( delClientId: string ) => void
	updateTabName: ( clientId: string, tabName: string ) => void,
}

const TabItem = ( { key, content, block, setActiveTab, deleteTab, updateTabName }: TTabItem ) => {
	return (
		<>
			<div
				className={ 'tabs-nav-line__item ' + ( block.attributes?.isActive ? 'active' : '' ) }
				key={ key }
				onClick={ () => setActiveTab( block.clientId ) }
			>
				{
					block.attributes?.isActive ? (
							<RichText
								identifier={ 'tab' + key }
								tagName="span"
								value={ content }
								onChange={ ( newValue: string ) => updateTabName( block.clientId, newValue ) }
							/>
						) : (
							<span>
								{ content }
							</span>
						)
				}

				<button
					className="item-delete"
					onClick={ () => deleteTab( block.clientId ) }
				>
					-
				</button>
			</div>
		</>
	)
}

type TabEdit = {
	attributes: TAttributes,
	setAttributes: ( {} ) => any,
	setActiveTab: ( tabBlockId: string ) => void
	updateTabs: ( prevCount: number, newCount: number ) => void,
	updateTabName: ( clientId: string, tabName: string ) => void,
	addTab: () => void,
	deleteTab: ( delClientId: string ) => void
	clientId: any
}

const TabEditContainer = function( { attributes, setAttributes, setActiveTab, updateTabName, addTab, deleteTab, updateTabs, clientId }: TabEdit ) {
	const {  } = attributes
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		allowedBlocks: ALLOWED_BLOCKS,
		renderAppender: false,
	} )
	const { count, innerBlocks, canInsertTabBlock } = useSelect( ( select: any ) => ( {
		count: select( blockEditorStore ).getBlockCount( clientId ),
		innerBlocks: select( blockEditorStore ).getBlocks( clientId ),
		canInsertTabBlock: select( blockEditorStore ).canInsertBlockType( 'react-wordpress/tab', clientId )
	} ), [ clientId ] )

	return (
		<>
			<InspectorControls>
				<PanelBody>
					<RangeControl
						__nextHasNoMarginBottom
						label={ __( 'Tabs' ) }
						value={ count }
						onChange={ ( newCount: number ) => updateTabs( count, newCount ) }
						min={ 1 }
						max={ Math.max( 10, count ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps } >
				<div className="tabs">
					<div className="tabs__nav">
						<div className="tabs-nav-line">
							{
								innerBlocks.map( ( block: TBlock, index: number ) => (
									<TabItem
										key={ index }
										block={ block }
										content={ ( 'tabName' in block.attributes ) ? block.attributes.tabName : `${ __( 'Tab', THEME_TEXT_DOMAIN ) } ${ index }` }
										setActiveTab={ setActiveTab }
										updateTabName={ updateTabName }
										deleteTab={ deleteTab }
									/>
								) )
							}

							<button
								className="tabs-nav-line__item add_new"
								onClick={ addTab }
							>
								+
							</button>
						</div>
					</div>

					<div className="tabs__content">
						<div { ...innerBlocksProps } />
					</div>
				</div>
			</div>
		</>
	)
}

const TabEditContainerWrapper = withDispatch( ( dispatch, ownProps, registry: TRegistry ) => ( {
	updateTabName( tabBlockId, tabName: string ) {
		const { clientId } = ownProps
		const { updateBlockAttributes } = dispatch( blockEditorStore )
		const { getBlockOrder } = registry.select( blockEditorStore )

		const innerBlockClientIds = getBlockOrder( clientId )
		innerBlockClientIds.forEach( ( innerBlockClientId: string ) => {
			if ( innerBlockClientId === tabBlockId )
				updateBlockAttributes( innerBlockClientId, { tabName } )
		} )
	},
	setActiveTab( tabBlockId: string = '' ) {
		const { clientId } = ownProps
		const { updateBlockAttributes } = dispatch( blockEditorStore )
		const { getBlockOrder } = registry.select( blockEditorStore )

		const innerBlockClientIds = getBlockOrder( clientId )
		innerBlockClientIds.forEach( ( innerBlockClientId: string ) => {
			if ( innerBlockClientId === tabBlockId )
				return updateBlockAttributes( innerBlockClientId, { isActive: true } )

			updateBlockAttributes( innerBlockClientId, { isActive: false } )
		} )
	},
	updateTabs( previousTabs: number, newTabs: number ) {
		const { clientId } = ownProps
		const { replaceInnerBlocks }: TEditBlockDispatch = dispatch( blockEditorStore )
		const { getBlocks } = registry.select( blockEditorStore )
		const isAddingColumn = newTabs > previousTabs
		let innerBlocks: TBlock[] = getBlocks( clientId )

		if ( isAddingColumn ) {
			// Add new tabs.
			innerBlocks = [
				...innerBlocks,
				createBlock( TAB_COMPONENT, {
					isActive: true,
					tabName: `Tab ${ innerBlocks.length }`
				} )
			];
		} else {
			// Remove tabs.
			innerBlocks = innerBlocks.slice( 0, -( previousTabs - newTabs ) )
		}

		replaceInnerBlocks( clientId, innerBlocks )

		this.setActiveTab( innerBlocks.at( -1 ).clientId )
	},
	addTab() {
		const { clientId }: TProps = ownProps
		const { replaceInnerBlocks }: TEditBlockDispatch = dispatch( blockEditorStore )
		const { getBlocks } = registry.select( blockEditorStore )
		let innerBlocks: TBlock[] = getBlocks( clientId )
		let tabName = `Tab ${ innerBlocks.length }`

		// Add new tab
		innerBlocks = [
			...innerBlocks,
			createBlock( TAB_COMPONENT, { isActive: true, tabName } )
		];

		replaceInnerBlocks( clientId, innerBlocks )

		this.setActiveTab( innerBlocks.at( -1 ).clientId )
	},
	deleteTab( delClientId: string ) {
		const { clientId }: TProps = ownProps
		const { replaceInnerBlocks }: TEditBlockDispatch = dispatch( blockEditorStore )
		const { getBlocks } = registry.select( blockEditorStore )
		let innerBlocks: TBlock[] = getBlocks( clientId )

		innerBlocks = innerBlocks.filter( ( block: TBlock ) => block.clientId !== delClientId )

		replaceInnerBlocks( clientId, innerBlocks )

		this.setActiveTab( innerBlocks[0].clientId )
	}
} ) )( TabEditContainer )


const TabsEdit = ( props: TProps ) => {
    const { clientId, attributes } = props
    const {  } = attributes
    const hasInnerBlocks = useSelect( ( select: any ) => select( blockEditorStore ).getBlocks( clientId ).length > 0, [clientId] );
	const { replaceInnerBlocks }: TEditBlockDispatch = useDispatch( blockEditorStore );

	if ( !hasInnerBlocks )
		replaceInnerBlocks( clientId, [
			createBlock( TAB_COMPONENT, {
				isActive: true,
				tabName: __( 'Tab 0', THEME_TEXT_DOMAIN )
			} )
		], true )

	return <TabEditContainerWrapper { ...props } />
}

export default TabsEdit
