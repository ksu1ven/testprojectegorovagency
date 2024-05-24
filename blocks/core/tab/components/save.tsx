/**
 * WordPress dependencies
 */
import { useInnerBlocksProps, useBlockProps } from '@wordpress/block-editor'

/**
 * Types
 */
import { TAttributes } from '../index'
import { TBlock } from '../../../../resources/types/libs'

type TSaveProps = {
	attributes: TAttributes,
	innerBlocks: TBlock[]
}

const TabSave = ( { attributes }: TSaveProps ) => {
	const { key, isActive, tabName } = attributes
	// @ts-ignore
	const blockProps = useBlockProps?.save()
	// @ts-ignore
	const innerBlocksProps = useInnerBlocksProps?.save( blockProps )

	return (
		<div
			className={ 'tabs-content__tab ' + ( isActive ? 'active' : '' ) }
			data-hm-tab={ key }
		>
			<div>
				Hello World { tabName }
			</div>

			<div { ...innerBlocksProps } />
		</div>
	)
}

export default TabSave
