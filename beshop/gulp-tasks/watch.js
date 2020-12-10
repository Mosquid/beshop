/**
 * @file
 * Watch.
 */

const {series, watch} = require('gulp');
const {cleanCss, cleanJs} = require('./clean');
const {lintCss, lintJs} = require('./lint');
const {styles} = require('./styles');
const {clean} = require('./clean');
const {scripts} = require('./scripts');
const options = require('../gulp-options');

function watchFiles() {
  watch(
    options.theme.sass + '**/*.scss',
    // options.gulpWatchOptions,
    // styles
    series(lintCss, cleanCss, styles)
  );
  watch(
    options.theme.js,
    options.gulpWatchOptions,
    series(lintJs, cleanJs, scripts)
  );
}

exports.watch = watchFiles;
