// Requires Gulp v4.
// $ npm uninstall --global gulp gulp-cli
// $ rm /usr/local/share/man/man1/gulp.1
// $ npm install --global gulp-cli
// $ npm install
const {src, dest, watch, series, parallel} = require('gulp');
const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const plumber = require('gulp-plumber');
const sasslint = require('gulp-sass-lint');
const cache = require('gulp-cached');
const concat = require('gulp-concat');
const cssmin = require('gulp-cssmin');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');

// TO INSTALL:
// npm install -save gulp gulp-sass gulp-autoprefixer gulp-plumber gulp-sass-lint gulp-cached gulp-concat gulp-cssmin gulp-rename gulp-uglify

// Compile CSS from Sass.
function buildStyles() {
	return src('scss/*.scss', 'scss/**/*.scss')
		.pipe(plumber()) // Global error listener.
		.pipe(sass({outputStyle: 'compressed'}))
		.pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7']))
		.pipe(dest('compiled/'))
}

// Watch changes on all *.scss files and trigger buildStyles() at the end.
function watchFiles() {
	watch(
		['scss/*.scss', 'scss/**/*.scss', 'js/*', 'js/*/*'],
		{events: 'all', ignoreInitial: false},
		series(buildStyles, scriptsHeader, scriptsFooter)
		// series(buildStyles, scripts, scriptsFooter)
	);
}

// Init Sass linter.
function sassLint() {
	return src(['scss/*.scss', 'scss/**/*.scss'])
		.pipe(cache('sasslint'))
		.pipe(sasslint({
			configFile: '.sass-lint.yml'
		}))
		.pipe(sasslint.format())
		.pipe(sasslint.failOnError());
}

function cssMin() {
	return src(['compiled/*.css'])
		.pipe(cssmin())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('dist-minified/'));
}

function JavaScriptMin() {
	return src(['compiled/*.js'])
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('dist-minified/'))
}


// JavaScript concat
function scriptsHeader() {
	return src([
		'js/lib/parallax.js',
	])
		.pipe(concat('header.js'))
		.pipe(dest('compiled/'));
}

function scriptsFooter() {
	return src([
		'js/components/footerscripts.js',
		// 'js/components/slick.js',
	])
		.pipe(concat('footer.js'))
		.pipe(dest('compiled/'));
}


// Export commands.
exports.default = parallel(sassLint, watchFiles); // $ gulp
exports.sass = buildStyles; // $ gulp sass
exports.watch = watchFiles; // $ gulp watch
exports.js = JavaScriptMin; // $ gulp watch
exports.prod = parallel(cssMin, JavaScriptMin); // $ gulp prod
exports.build = series(buildStyles); // $ gulp build
