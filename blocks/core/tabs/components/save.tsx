/**
 * WordPress dependencies
 */
import {
	useInnerBlocksProps,
	useBlockProps
} from '@wordpress/block-editor'

/**
 * Types
 */
import { TBlock } from '../../../resources/types/libs'
import { TAttributes } from '../index'

type TTabSaveItem = {
	block: TBlock
}

const TTabSaveItem = ( { block }: TTabSaveItem ) => {
	return (
		<>
			<div
				className={ 'tabs-nav-line__item ' + ( block.attributes?.isActive ? 'active' : '' ) }
				key={ block.clientId }
				data-hm-target={ block.clientId }
			>
				<span>
					{ block.attributes.tabName }
				</span>
			</div>
		</>
	)
}

type TSaveProps = {
	attributes: TAttributes,
	innerBlocks: TBlock[]
}

const TabsSave = ( { innerBlocks }: TSaveProps ) => {
	// @ts-ignore
	const blockProps = useBlockProps?.save()
	// @ts-ignore
	const innerBlocksProps = useInnerBlocksProps?.save( blockProps )

    return (
		<>
			<div { ...blockProps } >
				<div className="tabs js-tabs">
					<div className="tabs__nav">
						<div className="tabs-nav-line">
							{
								innerBlocks.map( ( block: TBlock ) => (
									<TTabSaveItem
										block={ block }
									/>
								) )
							}
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

export default TabsSave
