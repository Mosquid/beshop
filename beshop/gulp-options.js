/**
 * @file
 * Config file for gulp.
 */

'use strict';

const magicImporter = require('node-sass-magic-importer');

let env = process.env.NODE_ENV || 'testing';
let isProduction = (env === 'production');
let options = {};

options.isProduction = isProduction;

options.rootPath = {
  project: __dirname + '/',
  src: __dirname + '/',
  dist: __dirname + '/build/'
};

options.theme = {
  name: 'beshop',
  root: options.rootPath.theme,
  sass: options.rootPath.src + 'scss/',
  css: options.rootPath.dist + 'css/',
  js: options.rootPath.src + 'js/'
};

options.sassFiles = [
  options.theme.sass + '**/*.scss',
  // Do not open Sass partials as they will be included as needed.
  '!' + options.theme.sass + '**/_*.scss'
];

options.sass = {
  importer: magicImporter(),
  outputStyle: (isProduction ? 'compresssed' : 'expanded')
};

options.eslint = {
  files: [
    options.rootPath.project + 'gulpfile.js',
    options.theme.js + '**/*.js',
    '!' + options.theme.js + '**/*.min.js',
    options.theme.components + '**/*.js',
    '!' + options.theme.build + '**/*.js'
  ]
};

// If your files are on a network share, you may want to turn on polling for
// Gulp watch. Since polling is less efficient, we disable polling by default.
// Use `options.gulpWatchOptions = {interval: 1000, mode: 'poll'};` as example.
options.gulpWatchOptions = {};

options.browserSync = false;

module.exports = options;
