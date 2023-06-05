/**
 *  Copyright 2017 Amardeep Rai
 *  
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *  
 *      http://www.apache.org/licenses/LICENSE-2.0
 *  
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

'use strict';



var autoprefixer = require('gulp-autoprefixer');
var csso = require('gulp-csso');
var del = require('del');
var gulp = require('gulp');
var htmlmin = require('gulp-htmlmin');
var runSequence = require('run-sequence');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass')(require('sass'));
var cleanCss = require('gulp-clean-css');
var image = require('gulp-image');

// Set the browser that you want to supoprt
const AUTOPREFIXER_BROWSERS = [
  'ie >= 10',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'ios >= 7',
  'android >= 4.4',
  'bb >= 10'
];

// Gulp task to minify CSS files
gulp.task('styles', function () {
  return gulp.src('source/assets/sass/styles.scss', { allowEmpty: true } )
    // Compile SASS files
    .pipe(sass({
      outputStyle: 'nested',
      precision: 10,
      includePaths: ['.'],
      onError: console.error.bind(console, 'Sass error:')
    }))
    // Auto-prefix css styles for cross browser compatibility
    .pipe(autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
    // Minify the file
    .pipe(csso())
    // Output
    .pipe(gulp.dest('./dist/assets/css'))
});

// Minify CSS
gulp.task('css', async function() {
return gulp.src('source/assets/css/**/*.css')
 .pipe(cleanCss())
 .pipe(gulp.dest('./dist/assets/css'))
});

// Gulp task to minify JavaScript files
gulp.task('scripts', function() {
  return gulp.src('source/assets/js/**/*.js')
    // Minify the file
    .pipe(uglify())
    // Output
    .pipe(gulp.dest('./dist/assets/js'))
});

// Gulp task to minify HTML files
gulp.task('pages', function() {
  return gulp.src(['source/**/*.html'])
    .pipe(htmlmin({
      collapseWhitespace: true,
      removeComments: true
    }))
    .pipe(gulp.dest('./dist'));
});

// Minify images
gulp.task('images', function () {
    return gulp.src(['source/assets/images/**/*.*'])
        .pipe(image())
        .pipe(gulp.dest('./dist/assets/images'));
});

// Copy fonts
gulp.task('fonts', function () {
    return gulp.src(['source/assets/fonts/**/*']).pipe(gulp.dest('./dist/assets/fonts'));
});

// Clean output directory
gulp.task('clean', () => del(['dist']));

// Gulp task to minify all files
gulp.task('default', gulp.series('clean',
    'styles',
    'css',
    'scripts',
    'images',
    'pages',
    'fonts'
    ), function () {});