/**
 * WordPress dependencies
 */
import { __experimentalInputControl as InputControl, Button, ButtonGroup, PanelBody, ResponsiveWrapper } from '@wordpress/components'
import { InnerBlocks, InspectorControls, useBlockProps, useInnerBlocksProps, MediaUpload } from '@wordpress/block-editor'
import { Path, SVG } from '@wordpress/primitives'
import {useEffect, useState} from '@wordpress/element'
import { more } from '@wordpress/icons'
import { __ } from '@wordpress/i18n'

/**
 * Types
 */
import { EType, EVideoType, TAttributes } from '../'
import { MediaUploadRenderProp, UploadImage, UploadVideo } from '../../../../resources/types/types'

const THEME_TEXT_DOMAIN = 'react-wordpress'


const LinkButton = ( props: any ) => {
	return (
		<>
			<a
				className="button button--fill"
				href="#"
				target="__blank"
			>
				<span className="button__text">
					Link
				</span>
			</a>
		</>
	)
}


const Popup = ( props: any ) => {
	const { onRequestClose, children } = props

	return (
		<>
			<div className="editor-popup">
				<div
					id="modal-safety-priority-"
					className="modal fade modal-safety-priority show editor-popup__modal"
					tabIndex={-1}
					role="dialog"
					aria-hidden="true"
				>
					<div className="modal-dialog modal-dialog-centered modal-lg">
						<div className="modal-content">
							<div className="modal-header">
								<button
									type="button"
									className="modal-close"
									data-bs-dismiss="modal"
									aria-label={ __( 'Close popup', THEME_TEXT_DOMAIN ) }
									onClick={ onRequestClose }
								>
									<SVG width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<Path d="M18 6L6 18" stroke="white" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
										<Path d="M6 6L18 18" stroke="white" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
									</SVG>

								</button>
							</div>

							<div className="modal-body">
								<div className="modal-safety-priority__body-wrap decor-line decor-line--section">
									<div className="modal-safety-priority__simple-content">
										<div className="text-content">
											{ children }
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</>
	)
}

const PopupButton = ( props: any ) => {
	const [isOpen, setOpen] = useState<boolean>( false )
	const blockProps = useBlockProps()
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		renderAppender: InnerBlocks.ButtonBlockAppender
	} )

	const openModal = () => setOpen( true )
	const closeModal = () => setOpen( false )

	return (
		<>
			<button
				className="button button--fill"
				onClick={ openModal }
			>
				<span className="button__text">
					Popup
				</span>
			</button>

			{ isOpen && (
				<Popup
					onRequestClose={ closeModal }
				>
					<div { ...innerBlocksProps } />
				</Popup>
			) }
		</>
	)
}


const VideoButton = ( props: any ) => {
	return (
		<>
			<a
				className="button button--fill"
				href="#"
				target="__blank"
			>
				<span className="button__text">
					Video
				</span>
			</a>
		</>
	)
}

type TProps = {
    attributes: TAttributes,
    setAttributes: ( {} ) => any
}

const ButtonEdit = ( props: TProps ) => {
    const { attributes, setAttributes } = props
    const {
		type,
		value,
		link,
		target,
		popupId,
		videoType,
		videoFile,
		videoPoster,
		videoLink
	} = attributes
    const blockProps = useBlockProps()

    blockProps.className += ''

	if ( !videoType ) {
		setAttributes( { videoType: EVideoType.YouTube } )
	}

	const setType = ( newType: EType ) => {
    	setAttributes( { type: newType } )
	}

	const setVideoType = ( newVideoType: EVideoType ) => {
    	setAttributes( { videoType: newVideoType } )
	}

    return (
        <>
            <InspectorControls key="setting">
				<PanelBody
					title={ __( 'Button', THEME_TEXT_DOMAIN ) }
					icon={ more }
					initialOpen={ true }
				>
					<InputControl
						label={ __( 'Value', THEME_TEXT_DOMAIN ) }
						value={ value }
						placeholder={ __( 'Type Value...', THEME_TEXT_DOMAIN ) }
						onChange={ ( value: string ) => setAttributes( { value } ) }
					/>

					<fieldset>
						<legend className="blocks-base-control__label">
							{ __( 'Type', THEME_TEXT_DOMAIN ) }
						</legend>

						<ButtonGroup>
							<Button
								variant={ type === EType.Link ? 'primary' : 'secondary' }
								onClick={ () => setType( EType.Link ) }
							>
								{ __( 'Link', THEME_TEXT_DOMAIN ) }
							</Button>

							<Button
								variant={ type === EType.Popup ? 'primary' : 'secondary' }
								onClick={ () => setType( EType.Popup ) }
							>
								{ __( 'Popup', THEME_TEXT_DOMAIN ) }
							</Button>

							<Button
								variant={ type === EType.Video ? 'primary' : 'secondary' }
								onClick={ () => setType( EType.Video ) }
							>
								{ __( 'Video', THEME_TEXT_DOMAIN ) }
							</Button>
						</ButtonGroup>
					</fieldset>

					{ type === EType.Link && (
						<>
							<InputControl
								label={ __( 'Link', THEME_TEXT_DOMAIN ) }
								value={ link }
								placeholder={ __( 'Type Link...', THEME_TEXT_DOMAIN ) }
								onChange={ ( link: string ) => setAttributes( { link } ) }
							/>

							<InputControl
								label={ __( 'Target', THEME_TEXT_DOMAIN ) }
								value={ target }
								placeholder={ __( 'Type Target...', THEME_TEXT_DOMAIN ) }
								onChange={ ( target: string ) => setAttributes( { target } ) }
							/>
						</>
					) }

					{ type === EType.Popup && (
						<InputControl
							label={ __( 'Popup ID', THEME_TEXT_DOMAIN ) }
							value={ popupId }
							placeholder={ __( 'Type Popup ID...', THEME_TEXT_DOMAIN ) }
							onChange={ ( popupId: number ) => setAttributes( { popupId } ) }
						/>
					) }

					{ type === EType.Video && (
						<>
							<ButtonGroup>
								<Button
									variant={ videoType === EVideoType.SelfHosted ? 'primary' : 'secondary' }
									onClick={ () => setVideoType( EVideoType.SelfHosted ) }
								>
									{ __( 'Self Hosted', THEME_TEXT_DOMAIN ) }
								</Button>

								<Button
									variant={ videoType === EVideoType.YouTube ? 'primary' : 'secondary' }
									onClick={ () => setVideoType( EVideoType.YouTube ) }
								>
									{ __( 'YouTube', THEME_TEXT_DOMAIN ) }
								</Button>
							</ButtonGroup>

							<fieldset>
								<MediaUpload
									value={ 1 }
									allowedTypes={ ['image'] }
									onSelect={ ( { url }: UploadImage ) => setAttributes( { videoPoster: url } ) }
									render={ ( render: MediaUploadRenderProp ) => (
										<>
											{ videoPoster ? (
												<>
													<Button
														label={ __( 'Code is poetry', THEME_TEXT_DOMAIN ) }
														icon={<SVG viewBox="-2 -2 24 24" xmlns="http://www.w3.org/2000/svg"><Path d="M20 10c0-5.51-4.49-10-10-10C4.48 0 0 4.49 0 10c0 5.52 4.48 10 10 10 5.51 0 10-4.48 10-10zM7.78 15.37L4.37 6.22c.55-.02 1.17-.08 1.17-.08.5-.06.44-1.13-.06-1.11 0 0-1.45.11-2.37.11-.18 0-.37 0-.58-.01C4.12 2.69 6.87 1.11 10 1.11c2.33 0 4.45.87 6.05 2.34-.68-.11-1.65.39-1.65 1.58 0 .74.45 1.36.9 2.1.35.61.55 1.36.55 2.46 0 1.49-1.4 5-1.4 5l-3.03-8.37c.54-.02.82-.17.82-.17.5-.05.44-1.25-.06-1.22 0 0-1.44.12-2.38.12-.87 0-2.33-.12-2.33-.12-.5-.03-.56 1.2-.06 1.22l.92.08 1.26 3.41zM17.41 10c.24-.64.74-1.87.43-4.25.7 1.29 1.05 2.71 1.05 4.25 0 3.29-1.73 6.24-4.4 7.78.97-2.59 1.94-5.2 2.92-7.78zM6.1 18.09C3.12 16.65 1.11 13.53 1.11 10c0-1.3.23-2.48.72-3.59C3.25 10.3 4.67 14.2 6.1 18.09zm4.03-6.63l2.58 6.98c-.86.29-1.76.45-2.71.45-.79 0-1.57-.11-2.29-.33.81-2.38 1.62-4.74 2.42-7.1z" /></SVG>}
														onClick={ () => setAttributes( { videoPoster: '' } ) }
													/>

													<ResponsiveWrapper
														naturalWidth={ 640 }
														naturalHeight={ 360 }
													>
														<img src={ videoPoster } alt={ 'Test' } />
													</ResponsiveWrapper>
												</>
											) : (
												<Button
													onClick={ render.open }
													variant="primary"
												>
													{ __('Upload Video Poster', THEME_TEXT_DOMAIN) }
												</Button>
											) }
										</>
									) }
								/>

								{ videoType === EVideoType.YouTube && (
									<InputControl
										label={ __( 'YouTube Link', THEME_TEXT_DOMAIN ) }
										value={ videoLink }
										placeholder={ __( 'Type Link...', THEME_TEXT_DOMAIN ) }
										onChange={ ( videoLink: string ) => setAttributes( { videoLink } ) }
									/>
								) }

								{ videoType === EVideoType.SelfHosted && (
									<MediaUpload
										value={ 1 }
										allowedTypes={ ['video'] }
										onSelect={ ( { url }: UploadVideo ) => setAttributes( { videoFile: url } ) }
										render={ ( render: MediaUploadRenderProp ) =>
											<Button
												onClick={ render.open }
												variant="primary"
											>
												{ __('Upload Video', THEME_TEXT_DOMAIN) }
											</Button>
										}
									/>
								) }
							</fieldset>
						</>
					) }
				</PanelBody>
            </InspectorControls>

			{ type === EType.Link ? <LinkButton/> : null }
			{ type === EType.Popup ? <PopupButton/> : null }
			{ type === EType.Video ? <VideoButton/> : null }
        </>
    )
}

export default ButtonEdit
