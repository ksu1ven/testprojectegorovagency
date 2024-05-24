/**
 * External dependencies
 */
import classnames from 'classnames'

/**
 * WordPress Dependencies
 */
import {
	ToolbarButton,
	ToggleControl,
	__experimentalToolsPanelItem as ToolsPanel,
	ResizableBox
} from '@wordpress/components'

import {
	AlignmentControl,
	BlockControls,
	InspectorControls,
	RichText,
	useBlockProps,
	useSetting
} from '@wordpress/block-editor'

import { createBlock } from '@wordpress/blocks'
import { __, _x, isRTL } from '@wordpress/i18n'
import { formatLtr } from '@wordpress/icons'
import { useRef, useEffect, useState } from '@wordpress/element'


/**
 * Internal Dependencies
 */
import { useOnEnter } from './use-enter';

/**
 * Internal Types
 */
import { TAttributes } from '../'
import { TProps } from '../../../../resources/types/types'


type TSize = {
	width: number
	height: number
}

const ParagraphRTLControl = ( { direction, setDirection } ) => {
	return (
		isRTL() && (
			<ToolbarButton
				icon={ formatLtr }
				title={ _x( 'Left to right', 'editor button' ) }
				isActive={ direction === 'ltr' }
				onClick={ () => {
					setDirection( direction === 'ltr' ? undefined : 'ltr' );
				} }
			/>
		)
	);
}

const hasDropCapDisabled = ( align: string ): boolean => {
	return align === ( isRTL() ? 'left' : 'right' ) || align === 'center';
}

const Edit = ( props: TProps<TAttributes> ) => {
    const { attributes, mergeBlocks, onReplace, onRemove, setAttributes, clientId } = props
    const { align, content, direction, dropCap, placeholder, width } = attributes
	const blockProps = useBlockProps( {
		ref: useOnEnter( { clientId, content } ),
		className: classnames( {
			'has-drop-cap': hasDropCapDisabled( align ) ? false : dropCap,
			[ `has-text-align-${ align }` ]: align,
		} ),
		style: { direction },
	} )
	const pWrapper = useRef<HTMLDivElement>( null )
	const [showWidth, setShowWidth] = useState<number | string>( 'auto' )

	useEffect( () => {
		if ( !pWrapper.current )
			return

		const wrapperWidth = pWrapper.current.getBoundingClientRect().width

		if ( !width )
			return

		const pxWidth = ( wrapperWidth / 100 ) * width

		setShowWidth( pxWidth )
	}, [] )

    return (
        <>
			<BlockControls group="block">
				<AlignmentControl
					value={ align }
					onChange={ ( newAlign: string ) =>
						setAttributes( {
							align: newAlign,
							dropCap: hasDropCapDisabled( newAlign ) ? false : dropCap,
						} )
					}
				/>

				<ParagraphRTLControl
					direction={ direction }
					setDirection={ ( newDirection ) => setAttributes( { direction: newDirection } ) }
				/>
			</BlockControls>

			<div
				className="paragraph-wrapper"
				ref={ pWrapper }
			>
				<ResizableBox
					enable={ {
						bottom: false,
						bottomLeft: false,
						bottomRight: false,
						left: false,
						right: true,
						top: false,
						topLeft: false,
						topRight: false
					} }
					onResizeStop={ ( event: MouseEvent, pointer: string, element: HTMLDivElement, size: TSize ) => {
						if ( !pWrapper.current )
							return

						const wrapperWidth = pWrapper.current.getBoundingClientRect().width
						const elementWidth = element.getBoundingClientRect().width
						const width = elementWidth / ( wrapperWidth / 100 )

						setShowWidth( elementWidth )
						setAttributes( { width } )
					} }
					size={ {
						width: showWidth
					} }
				>
					<RichText
						identifier="content"
						tagName="p"
						{ ...blockProps }
						value={ content }
						onChange={ ( newContent: string ) => setAttributes( { content: newContent } ) }
						onSplit={ ( value, isOriginal ) => {
							const newAttributes = isOriginal || value ? { ...attributes, content: value } : '';
							const block = createBlock( 'ea-core/paragraph', newAttributes );

							if ( isOriginal )
								block.clientId = clientId;

							return block;
						} }
						onMerge={ mergeBlocks }
						onReplace={ onReplace }
						onRemove={ onRemove }
						aria-label={ content ? __( 'Paragraph block' ) : __( 'Empty block; start writing or type forward slash to choose a block' ) }
						data-empty={ !content }
						placeholder={ placeholder || __( 'Type / to choose a block' ) }
						data-custom-placeholder={ placeholder ? true : undefined }
						__unstableEmbedURLOnPaste
						__unstableAllowPrefixTransformations
					/>
				</ResizableBox>
			</div>
        </>
    )
}

export default Edit
