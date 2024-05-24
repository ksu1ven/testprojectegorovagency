// Libs
import { Button, ButtonGroup } from '@wordpress/components'
import { MediaUpload } from '@wordpress/block-editor'
import { useState } from '@wordpress/element'
import { __ } from '@wordpress/i18n'

// Types
import { MediaUploadRenderProp, UploadImage } from '../../types/types'

export enum backgroundType {
    None = 'none',
    Image = 'image',
    Video = 'video'
}

interface IBackgroundFields {
    type: backgroundType
    setType: ( arg: backgroundType ) => void
    setImage: ( {}: UploadImage ) => void
    setVideo: ( {}: any ) => void
    setPoster: ( {}: UploadImage ) => void
}

export const BackgroundFields = ( { type, setType, setImage, setVideo, setPoster }: IBackgroundFields ) => {
    const THEME_TEXT_DOMAIN = 'react-wordpress'

    const imageFields = () => {
        return (
            <fieldset>
                <legend className="blocks-base-control__label">
                    { __( 'Image', THEME_TEXT_DOMAIN ) }
                </legend>

                <MediaUpload
                    value={ 1 }
                    allowedTypes={ ['image'] }
                    onSelect={ setImage }
                    render={ ( render: MediaUploadRenderProp ) =>
                        <Button
                            onClick={ render.open }
                            variant="primary"
                        >
                            { __('Upload Image', THEME_TEXT_DOMAIN) }
                        </Button>
                    }
                />
            </fieldset>
        )
    }

    const videoFields = () => {
        return (
            <fieldset>
                <legend className="blocks-base-control__label">
                    { __( 'Video', THEME_TEXT_DOMAIN ) }
                </legend>

                <MediaUpload
                    value={ 1 }
                    allowedTypes={ ['video'] }
                    onSelect={ setVideo }
                    render={ ( render: MediaUploadRenderProp ) =>
                        <Button
                            onClick={ render.open }
                            variant="primary"
                        >
                            { __('Upload Video', THEME_TEXT_DOMAIN) }
                        </Button>
                    }
                />

                <MediaUpload
                    value={ 1 }
                    allowedTypes={ ['image'] }
                    onSelect={ setPoster }
                    render={ ( render: MediaUploadRenderProp ) =>
                        <Button
                            onClick={ render.open }
                            variant="primary"
                        >
                            { __('Upload Video Poster', THEME_TEXT_DOMAIN) }
                        </Button>
                    }
                />
            </fieldset>
        )
    }

    return (
        <>
            <fieldset>
                <legend className="blocks-base-control__label">
                    { __( 'Background Type', THEME_TEXT_DOMAIN ) }
                </legend>

                <ButtonGroup>
                    <Button
                        variant="primary"
                        onClick={ () => setType( backgroundType.None ) }
                    >
                        { __( 'None', THEME_TEXT_DOMAIN ) }
                    </Button>

                    <Button
                        variant="primary"
                        onClick={ () => setType( backgroundType.Image ) }
                    >
                        { __( 'Image', THEME_TEXT_DOMAIN ) }
                    </Button>

                    <Button
                        variant="primary"
                        onClick={ () => setType( backgroundType.Video ) }
                    >
                        { __( 'Video', THEME_TEXT_DOMAIN ) }
                    </Button>
                </ButtonGroup>
            </fieldset>

            { type === 'image' ? imageFields() : null }
            { type === 'video' ? videoFields() : null }
        </>
    )
}

interface ISectionBackground {
    type: backgroundType

    imageSrc?: string
    imageAlt?: string

    videoSrc?: string
    videoPoster?: string
}


const SectionBackground = ( { type, imageSrc = '', imageAlt = '', videoSrc = '', videoPoster = '' }: ISectionBackground ) => {

    const imageBg = () => {
        return (
            <picture>
                <source srcSet={ imageSrc } media="(min-width: 1920px)"/>
                <source srcSet={ imageSrc } media="(min-width: 1280px)"/>
                <source srcSet={ imageSrc } media="(max-width: 1279px)"/>
                <source srcSet={ imageSrc } media="(max-width: 767px)"/>
                <img src={ imageSrc } alt={ imageAlt }/>
            </picture>
        )
    }

    const videoBg = () => {
        return (
            <video disablePictureInPicture loop autoPlay playsInline muted poster={ videoPoster }>
                <source src={ videoSrc } type="video/mp4"/>
            </video>
        )
    }

    return (
        <>
            <div className="section__bg section-hero__background menu-two-lines" aria-hidden="true">
                <div className="background-img">
                    { type === backgroundType.Image ? imageBg() : null }
                    { type === backgroundType.Video ? videoBg() : null }
                </div>
            </div>
        </>
    )
}

export default SectionBackground
