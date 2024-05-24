/**
 * The module dependencies.
 */
const path = require( 'path' );
const slash = require( 'slash' );

module.exports.themeRootPath = 			( basePath = '', destPath = '' ) => slash(path.resolve( __dirname, '../', basePath, destPath ) );
module.exports.blockPath = 				( basePath = '', destPath = '' ) => path.resolve( __dirname, '../../blocks', basePath, destPath );

// Source paths.
module.exports.srcPath = 				( basePath = '', destPath = '' ) => slash( path.resolve( __dirname, '../', basePath, destPath ) );
module.exports.srcScriptsPath = 		destPath => exports.srcPath('js', destPath);
module.exports.srcStylesPath = 			destPath => exports.srcPath('scss', destPath);
module.exports.srcImagesPath = 			destPath => exports.srcPath('images', destPath);
module.exports.srcCacheImagesPath = 	destPath => exports.srcPath('cache', destPath);
module.exports.srcFontsPath = 			destPath => exports.srcPath('fonts', destPath);
module.exports.srcBlocks =				destPath => exports.srcPath('../blocks', destPath);

// Build paths.
module.exports.buildPath = 				( basePath = '', destPath = '' ) => path.resolve( __dirname, '../../dist', basePath, destPath );
module.exports.buildScriptsPath = 		destPath => exports.buildPath('js', destPath);
module.exports.buildStylesPath = 		destPath => exports.buildPath('css', destPath);
module.exports.buildStylesBlocksPath = 	destPath => exports.buildPath('css/blocks', destPath);
module.exports.buildBlocksPath = 		destPath => exports.blockPath('', destPath);
module.exports.buildImagesPath = 		destPath => exports.buildPath('images', destPath);
module.exports.buildCacheImagesPath = 	destPath => exports.buildPath('cache', destPath);
module.exports.buildFontsPath = 		destPath => exports.buildPath('fonts', destPath);


module.exports.detectEnv = () => {
	const env = process.env.NODE_ENV || 'development';
	const isDev = env === 'development';
	const isProd = env === 'production';
	const isBuild = env === 'build';

	return { env, isDev, isProd, isBuild };
};
