/**
 * The module dependencies.
 */
const del = require("del");
const gulp = require("gulp");
const path = require("path");
const sass = require("gulp-sass")(require("sass"));
const sassGlob = require('gulp-sass-glob');
const utils = require("./utils");
const gulpif = require("gulp-if");
const rename = require("gulp-rename");
const notify = require("gulp-notify");
const postcss = require("gulp-postcss");
const plumber = require("gulp-plumber");
const webpack = require("webpack-stream");
const bundler = require("webpack");
const imagemin = require("gulp-imagemin");
const imageminMozjpeg = require("imagemin-mozjpeg");
const imageminPNGquant = require("imagemin-pngquant");
const sourcemaps = require("gulp-sourcemaps");
const rev = require("gulp-rev");
const vinyl = require("vinyl-paths");
const named = require("vinyl-named");
const browserSync = require("browser-sync");
const changed = require("gulp-changed");

/**
 * Setup the env.
 */
const { isProd, isDev } = utils.detectEnv();

/**
 * Show notification on error.
 */
const error = function (e) {
	notify.onError({
		title: "Gulp",
		message: e.message,
		sound: "Beep",
	})(e);

	this.emit("end");
};

/**
 * Process sass files through sass and PostCSS.
 */
const styles = () => {
	const config = require("./postcss");
	const src = utils.srcStylesPath("load.scss");
	const dest = utils.buildStylesPath();

	return gulp
		.src(src, {
			allowEmpty: true,
		})
		.pipe(gulpif(isDev, sourcemaps.init()))
		.pipe(sassGlob())
		.pipe(
			sass({
				paths: [".", path.resolve(__dirname, "../node_modules")],
			}).on("error", error)
		)
		.pipe(gulpif(isDev, plumber({ errorHandler: error })))
		.pipe(postcss(config))
		.pipe(rename("bundle.css"))
		.pipe(gulpif(isDev, sourcemaps.write("./")))
		.pipe(gulp.dest(dest));
};

const blockStyles = () => {
	const sectionsSrc = utils.srcBlocks( 'sections/*/scss/*.scss' );
	const componentsSrc = utils.srcBlocks( 'components/*/scss/*.scss' );
	const dest = utils.buildStylesBlocksPath();

	return gulp
		.src( [sectionsSrc, componentsSrc] , {
			allowEmpty: true,
		})
		.pipe(gulpif(isDev, sourcemaps.init()))
		.pipe(sassGlob())
		.pipe(
			sass({
				paths: [".", path.resolve(__dirname, "../node_modules")],
			}).on("error", error)
		)
		.pipe(gulpif(isDev, plumber({ errorHandler: error })))
		.pipe(
			rename({
				prefix: "block-",
			})
		)
		.pipe(gulpif(isDev, sourcemaps.write("./")))
		.pipe(gulp.dest(dest));
};

/**
 * Process sass files through sass and PostCSS used in the administration area.
 */
const adminstyles = () => {
	const config = require("./postcss");
	const src = utils.srcStylesPath("load-admin.scss");
	const dest = utils.buildStylesPath("");

	return gulp
		.src(src, {
			allowEmpty: true,
		})
		.pipe(gulpif(isDev, sourcemaps.init()))
		.pipe(sassGlob())
		.pipe(
			sass({
				paths: [".", path.resolve(__dirname, "../node_modules")],
			}).on("error", error)
		)
		.pipe(gulpif(isDev, plumber({ errorHandler: error })))
		.pipe(postcss(config))
		.pipe(rename("admin-styles.css"))
		.pipe(gulpif(isDev, sourcemaps.write("./")))
		.pipe(gulp.dest(dest));
};

/**
 * Process JS files through Webpack.
 */
const scripts = () => {
	const src = utils.srcScriptsPath("main.js");
	const srcBlocksSections = utils.srcBlocks("sections/*/js/*.js");
	const srcBlocksComponents = utils.srcBlocks("components/*/js/*.js");
	const srcBlocksCore = utils.srcBlocks("core/*/js/*.js");
	const srcAdmin = utils.srcScriptsPath("admin.js");
	const dest = utils.buildScriptsPath();
	const config = require("./webpack");

	return gulp
		.src([src, srcBlocksSections, srcBlocksComponents, srcBlocksCore, srcAdmin])
		.pipe(named())
		.pipe(plumber({ errorHandler: error }))
		.pipe(webpack(config, bundler))
		.pipe(gulp.dest(dest));
};

/**
 * Copy all images used in HTML files.
 */
const images = () => {
	const src = [
		utils.srcImagesPath("**/*"),
		`!${utils.srcImagesPath("sprite*")}`,
		`!${utils.srcImagesPath("sprite/*")}`,
	];

	const dest = utils.buildImagesPath();

	return gulp
		.src(src)
		.pipe(changed(dest))
		.pipe(plumber({ errorHandler: error }))
		.pipe(gulp.dest(dest));
};

const cache = () => {
	const src = [
		utils.srcCacheImagesPath("**/*")
	];

	const dest = utils.buildCacheImagesPath();

	return gulp
		.src(src)
		.pipe(changed(dest))
		.pipe(plumber({ errorHandler: error }))
		.pipe(gulp.dest(dest));
};

/**
 * Optimize all images in the build folder.
 */
const optimize = () => {
	const src = utils.buildImagesPath("**/*");
	const dest = utils.buildImagesPath();

	return gulp
		.src(src)
		.pipe(plumber({ errorHandler: error }))
		.pipe(
			imagemin([
				// GIFs
				// https://github.com/imagemin/imagemin-gifsicle#api
				imagemin.gifsicle({
					interlaced: true,
				}),

				// JP(E)G
				// https://github.com/imagemin/imagemin-jpegtran#api
				imageminMozjpeg({
					quality: 70,
				}),

				// PNG
				// https://github.com/imagemin/imagemin-optipng#api
				imageminPNGquant({
					speed: 1,
					quality: [.8, .9],
				}),

				// SVG
				// https://github.com/imagemin/imagemin-svgo#api
				// https://github.com/svg/svgo#what-it-can-do
				imagemin.svgo({
					plugins: [
						{ cleanupAttrs: true },
						{ removeDoctype: true },
						{ removeXMLProcInst: true },
						{ removeComments: true },
						{ removeMetadata: true },
						{ removeUselessDefs: true },
						{ removeEditorsNSData: true },
						{ removeEmptyAttrs: true },
						{ removeHiddenElems: false },
						{ removeEmptyText: true },
						{ removeEmptyContainers: true },
						{ cleanupEnableBackground: true },
						{ removeViewBox: false },
						{ cleanupIDs: false },
						{ convertStyleToAttrs: true },
					],
				}),
			])
		)
		.pipe(gulp.dest(dest));
};

/**
 * Generate a production-ready manifest file.
 */
const manifest = () => {
	const base = utils.buildPath();
	const src = [
		utils.buildScriptsPath("blocks/*.js"),
		utils.buildScriptsPath("main.js"),
		utils.buildStylesPath("bundle.css"),
	];

	return gulp
		.src(src, { base })
		.pipe(vinyl((paths) => del(paths, { force: true })))
		.pipe(rev())
		.pipe(gulp.dest(base))
		.pipe(rev.manifest("manifest.json"))
		.pipe(gulp.dest(base));
};

/**
 * Watch for changes and run through different tasks.
 */
const watch = () => {
	gulp.watch(
		[
			utils.srcBlocks("**/*.scss"),
			utils.srcStylesPath("*.scss"),
			utils.srcStylesPath("**/**/*.scss"),
			utils.srcStylesPath("blocks/*.scss"),
			utils.srcImagesPath("sprite/*.png"),
		],
		gulp.series(styles, blockStyles, adminstyles)
	);

	gulp.watch([utils.srcImagesPath("**/*")], images, cache);

	gulp.watch(
		[
			utils.srcScriptsPath("**/*"),
			utils.srcBlocks("**/*")
		],
		scripts
	);
};

/**
 * Refresh the browser when a file is changed.
 */
const reload = () => {
	const config = require("./browsersync");

	browserSync(config);
};

/**
 * Remove the build.
 */
const clean = () => {
	return del([utils.buildPath()], { force: true });
};

/**
 * Register the tasks.
 */
gulp.task(
	"dev",
	gulp.series(
		clean,
		gulp.parallel(styles, blockStyles, adminstyles, images, cache),
		gulp.parallel(scripts, watch, reload)
	)
);

gulp.task(
	"watch",
	gulp.series(
		clean,
		gulp.parallel(styles, blockStyles, adminstyles, images, cache),
		gulp.parallel(scripts),
		gulp.parallel(watch)
	)
);

gulp.task(
	"build",
	gulp.series(
		clean,
		styles,
		blockStyles,
		adminstyles,
		scripts,
		images,
		cache,
		optimize,
		manifest
	)
);

/**
 * Register default gulp task.
 */
gulp.task("default", gulp.parallel("dev"));
