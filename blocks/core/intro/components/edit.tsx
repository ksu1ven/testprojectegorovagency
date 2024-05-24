/**
 * WordPress dependencies
 */
import {
	__experimentalInputControl as InputControl,
	TextareaControl,
	Panel,
	PanelBody,
	PanelRow
} from '@wordpress/components'

import {
	useBlockProps,
	useInnerBlocksProps,
	InspectorControls,
	store as blockEditorStore
} from '@wordpress/block-editor'

import { useSelect, withDispatch, useDispatch } from '@wordpress/data'
import { Path, SVG } from '@wordpress/primitives'
import { createBlock } from '@wordpress/blocks'
import { more } from '@wordpress/icons'
import { __ } from '@wordpress/i18n'


// Components
import SectionBackground, { BackgroundFields, backgroundType } from '../../../../resources/js/template-parts/section-background'

/**
 * Types
 */
import { TEditBlockDispatch } from '../../../../resources/types/libs'
import { UploadImage, UploadVideo } from '../../../../resources/types/types'
import { TAttributes } from '../'

const THEME_TEXT_DOMAIN = 'react-wordpress'
const BUTTON_COMPONENT = 'ea-component/button'
const ALLOWED_BLOCKS = [ BUTTON_COMPONENT ]

type TProps = {
	clientId: string
    attributes: TAttributes
    setAttributes: ( {} ) => any
}

const IntroEdit = ( props: TProps ) => {
    const { clientId, attributes, setAttributes } = props
    const {
		backgroundType: bgType,
		backgroundImage,
		backgroundImageAlt,
		backgroundVideo,
		posterImage,
		kicker,
		title,
		subtitle,
		description
	} = attributes
    const blockProps = useBlockProps()
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		allowedBlocks: ALLOWED_BLOCKS,
		renderAppender: false,
	} )
	const hasInnerBlocks = useSelect( ( select: any ) => select( blockEditorStore ).getBlocks( clientId ).length > 0, [clientId] )
	const { replaceInnerBlocks }: TEditBlockDispatch = useDispatch( blockEditorStore)

	if ( !hasInnerBlocks ) {
		replaceInnerBlocks( clientId, [
			createBlock( BUTTON_COMPONENT, {
				type: 'video'
			} )
		] )
	}

    blockProps.className += ' section section-hero block-preview'

	const setKicker = ( value: string ) => {
		setAttributes( { kicker: value } )
	}

    const setTitle = ( value: string ) => {
        setAttributes( { title: value } )
    }

	const setSubtitle = ( value: string ) => {
		setAttributes( { subtitle: value } )
	}

	const setDescription = ( value: string ) => {
		setAttributes( { description: value } )
	}

    const setType = ( type: backgroundType ) => {
        setAttributes( { backgroundType: type } )
    }

    const setImage = ( { url, alt }: UploadImage ) => {
        setAttributes( { backgroundImage: url, backgroundImageAlt: alt } )
    }

    const setVideo = ({ url }: UploadVideo ) => {
        setAttributes( { backgroundVideo: url } )
    }

    const setPoster = ( { url, alt }: UploadImage ) => {
        setAttributes( { posterImage: url, posterImageAlt: alt } )
    }

    return (
        <>
            <InspectorControls key="setting">
				<Panel header="My panel">
					<PanelBody
						title={ __( 'Background', THEME_TEXT_DOMAIN ) }
						icon={ more }
						initialOpen={ true }
					>
						<PanelRow>
							<div>
								<BackgroundFields
									type={ bgType }
									setType={ setType }
									setImage={ setImage }
									setVideo={ setVideo }
									setPoster={ setPoster }
								/>
							</div>
						</PanelRow>
					</PanelBody>

					<PanelBody
						title={ __( 'Content', THEME_TEXT_DOMAIN ) }
						icon={ more }
						initialOpen={ true }
					>
						<InputControl
							label={ __( 'Kicker', THEME_TEXT_DOMAIN ) }
							value={ kicker }
							placeholder={ __( 'Type Kicker', THEME_TEXT_DOMAIN ) }
							onChange={ ( value: string ) => setKicker( value ?? '' ) }
						/>

						<InputControl
							label={ __( 'Title', THEME_TEXT_DOMAIN ) }
							value={ title }
							placeholder={ __( 'Type Title', THEME_TEXT_DOMAIN ) }
							onChange={ ( value: string ) => setTitle( value ?? '' ) }
						/>

						<InputControl
							label={ __( 'Subtitle', THEME_TEXT_DOMAIN ) }
							value={ subtitle }
							placeholder={ __( 'Type Subtitle', THEME_TEXT_DOMAIN ) }
							onChange={ ( value: string ) => setSubtitle( value ?? '' ) }
						/>

						<TextareaControl
							label={ __( 'Description', THEME_TEXT_DOMAIN ) }
							value={ description }
							help={ __( 'Type Description', THEME_TEXT_DOMAIN ) }
							onChange={ ( value: string ) => setDescription( value ?? '' ) }
						/>
					</PanelBody>
				</Panel>
            </InspectorControls>

            <section { ...blockProps }>
                <SectionBackground
                    type={ bgType }
                    imageSrc={ backgroundImage }
                    imageAlt={ backgroundImageAlt }
                    videoSrc={ backgroundVideo }
                    videoPoster={ posterImage }
                />

                <div className="section__body">
                    <div className="container">
                        <div className="section-hero__content">
							<div className="section-hero__top">
								<div className="subtitle section-hero__note">
									{ kicker }
								</div>

								<div className="section-hero__bread-crumbs">

								</div>
							</div>

							<div className="section-hero__main decor-line">
								<div className="section-title section-title--style1 section-hero__title section-title--white">
									<h1>
										{ title }
									</h1>
								</div>

								<div className="subtitle section-hero__subtitle">
									{ subtitle }
								</div>

								<div className="section-hero__description text-content text-content--white">
									<p>
										{ description }
									</p>
								</div>

								<div className="buttons-wrap section-hero__buttons-container">
									<div { ...innerBlocksProps } />
								</div>
							</div>

							<div className="scroll-down section-hero__scroll">
								<button className="button button--scroll-down js-scroll-to-next-section">
									<span className="icon icon-wrap button--scroll-down-icon">
										<SVG width="24" height="98" viewBox="0 0 24 98" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g clipPath="url(#clip0_965_21792)" stroke="#fff" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
												<Path d="M14 4v90m-7-7l7 7"/>
											</g>

											<defs>
												<clipPath id="clip0_965_21792">
													<Path fill="#fff" transform="matrix(0 1 1 0 0 0)" d="M0 0h98v24H0z"/>
												</clipPath>
											</defs>
										</SVG>
									</span>
								</button>

								<div className="scroll-down__text js-scroll-to-next-section">
									{ __( 'SCROLL DOWN', THEME_TEXT_DOMAIN ) }
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </section>
        </>
    )
}

export default IntroEdit
