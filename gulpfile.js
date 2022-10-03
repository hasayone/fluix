// Config
const projectConfig = {
	foldersName: 'fluix',
};

const jsLibs = [
	'',
];

const jsWatch = [
	'wp-content/themes/' + projectConfig.foldersName + '/assets/js/front.js',
	'wp-content/themes/' + projectConfig.foldersName + '/assets/js/admin/*.js',
	'wp-content/themes/' + projectConfig.foldersName + '/assets/js/blocks/*.js',
	/** exclude already minified files */
	'!wp-content/themes/' + projectConfig.foldersName + '/assets/js/admin/*.min.js',
];

const jsFilesFront = [
	'wp-content/themes/' + projectConfig.foldersName + '/assets/js/front.js',
	'wp-content/themes/' + projectConfig.foldersName + '/assets/js/blocks/*.js',
];

const jsFilesAdmin = [
	'wp-content/themes/' + projectConfig.foldersName + '/assets/js/admin/*.js',
	/** exclude already minified files */
	'!wp-content/themes/' + projectConfig.foldersName + '/assets/js/admin/*.min.js',
];

const cssWatch = [
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/*.scss',
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/layout/*.scss',
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/layout/*/*.scss',
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/blocks/*.scss',
];


const cssBlocksFront = [
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/blocks/*.scss',
]
const cssFilesFront = [
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/*.scss',
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/layout/*.scss',
	// 'wp-content/themes/' + projectConfig.foldersName + '/assets/css/blocks/*.scss',
	'!wp-content/themes/' + projectConfig.foldersName + '/assets/css/admin.scss',
	'!wp-content/themes/' + projectConfig.foldersName + '/assets/css/admin-editor-style.scss',
	'!wp-content/themes/' + projectConfig.foldersName + '/assets/css/critical-css.scss',
];

const cssSeparateFiles = [
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/admin.scss',
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/admin-editor-style.scss',
	'wp-content/themes/' + projectConfig.foldersName + '/assets/css/critical-css.scss',
];


// Initialize modules
// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const gulp = require('gulp');
const {
	src,
	dest,
	watch,
	series,
	parallel
} = gulp;

// Importing all the Gulp-related packages we want to use
const sourcemaps = require('gulp-sourcemaps'),
	sass = require('gulp-sass')(require('sass')),
	babel = require('gulp-babel'),
	rename = require('gulp-rename'),
	minifyjs = require('gulp-uglify-es').default,
	stringReplace = require('gulp-string-replace'),
	fs = require('fs'),
	autoPrefixer = require('gulp-autoprefixer'),
	plumber = require('gulp-plumber'),
	concat = require('gulp-concat'),
	merge = require('merge2');

// Sass task: compiles the style.scss file into style.css
function scssTask() {

	const frontFiles = src(cssFilesFront, {
			base: './'
		})
		.pipe(autoPrefixer({
			cascade: false
		}))
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed'
		}))
		.pipe(concat('app.min.css'))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('wp-content/themes/' + projectConfig.foldersName + '/assets/css/'));

	const blockFiles = src(cssBlocksFront, {
			base: './'
		})
		.pipe(autoPrefixer({
			cascade: false
		}))
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed'
		}))
		.pipe(sourcemaps.write('.'))
		.pipe(dest((file) => {
			return file.base;
		}));

	const separateFiles = src(cssSeparateFiles, {
			base: './'
		})
		.pipe(autoPrefixer({
			cascade: false
		}))
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed'
		}))
		.pipe(sourcemaps.write('.'))
		.pipe(dest((file) => {
			return file.base;
		}));

	return merge(frontFiles, blockFiles, separateFiles);

}

// JS Task: minify scripts
function jsTask() {

	/* const libsFiles = src(jsLibs)
		.pipe(concat('libs.min.js'))
		.pipe(dest('wp-content/themes/' + projectConfig.foldersName + '/assets/js/'));
*/
	const frontFiles = src(jsFilesFront, {
			base: './'
		})
		.pipe(babel({
			presets: [
				['@babel/env', {
					modules: 'commonjs'
				}]
			]
		}))
		.pipe(minifyjs())
		.pipe(concat('app.min.js'))
		.pipe(dest('wp-content/themes/' + projectConfig.foldersName + '/assets/js/'));

	const separateFiles = src(jsFilesAdmin, {
			base: './'
		})
		.pipe(babel({
			presets: [
				['@babel/env', {
					modules: 'commonjs'
				}]
			]
		}))
		.pipe(minifyjs())
		.pipe(rename({
			extname: '.min.js'
		}))
		.pipe(dest((file) => {
			return file.base;
		}));

	// return merge(libsFiles, frontFiles, separateFiles);
	return merge(frontFiles, separateFiles);

}

// Watch task: watch SCSS and JS files for changes
// If any change, run scss and js tasks simultaneously
function watchTask() {
	watch([...cssWatch, ...jsWatch], series(parallel(scssTask, jsTask)));
}

// Export the default Gulp task so it can be run
// Runs the scss and js tasks simultaneously
// then runs cacheBust, then watch task
exports.default = series(
	parallel(scssTask, jsTask),
	watchTask
);