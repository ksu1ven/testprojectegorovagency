export type TProps<A> = {
	attributes: A
	clientId: string
	context: {}
	insertBlocksAfter: () => any
	isSelected: boolean
	isSelectionEnabled: boolean
	mergeBlocks: () => any
	name: string
	onRemove: () => any
	onReplace: () => any
	setAttributes: ( {} ) => any
	toggleSelection: () => any
}

enum FileType {
    Image = 'image',
    Video = 'video'
}

/** ------------------------------------------- *
 *                  Image
 * ------------------------------------------- */

enum ImageType {
    ImageJpeg = 'image/jpeg'
}

enum ImageSubtype {
    Jpeg = 'jpeg'
}

export type MediaUploadRenderProp = {
    open: () => any
}

type ImgSize = {
    height: number
    orientation: string,
    url: string,
    width: number
}

export type UploadImage = {
    acf_errors: boolean
    alt: string
    author: string
    authorLink: string
    authorName: string
    caption: string
    compat: {
        item: string
        meta: string
    }
    context: string
    date: Date
    dateFormatted: string
    description: string
    editLink: string
    filename: string
    filesizeHumanReadable: string
    filesizeInBytes: number
    height: number
    icon: string
    id: number
    link: string
    menuOrder: number
    meta: boolean
    mime: ImageType
    modified: Date
    name: string
    nonces: {
        update: string
        delete: string
        edit: string
    }
    orientation: string
    sizes: {
        thumbnail: ImgSize
        medium: ImgSize
        large: ImgSize
        full: ImgSize
    }
    status: string
    subtype: ImageSubtype
    title: string
    type: FileType
    uploadedTo: number
    url: string
    width: number
}

/** ------------------------------------------- *
 *                  Video
 * ------------------------------------------- */

enum VideoType {
    VideoMp4 = 'video/mp4'
}

enum VideoSubtype {
    Mp4 = 'mp4'
}

export type UploadVideo = {
    acf_errors: boolean
    alt: string
    author: string
    authorLink: string
    authorName: string
    caption: string
    compat: {
        item: string
        meta: string
    }
    context: string
    date: Date
    dateFormatted: string
    description: string
    editLink: string
    fileLength: string                          // "0:35"
    fileLengthHumanReadable: string             // "0 minutes, 35 seconds"
	filename: string                                // "chrome_6ZeunVNMoS.mp4"
    filesizeHumanReadable: string               // "5 MB"
    filesizeInBytes: number
    height: number
    icon: string                                // "http://reactwordpress/wp-includes/images/media/video.png"
    id: number
    image: {
        src: string
        width: number
        height: number
    }
    link: string
    menuOrder: number
    meta: {
        artist: boolean
        album: boolean
        bitrate: number
        bitrate_mode: boolean
    }
    mime: VideoType
    modified: Date
    name: string
    nonces: {
        update: string
        delete: string
        edit: string
    }
    status: string
    subtype: VideoSubtype
    thumb: {
        src: string
        width: number
        height: number
    }
    title: string
    type: FileType
    uploadedTo: number
    url: string
    width: number
}
