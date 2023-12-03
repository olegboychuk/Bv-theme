'use strict';

const gulp = require('gulp');

const sass = require('gulp-sass')(require('sass'));
const rtlcss  = require('gulp-rtlcss');
const rename = require('gulp-rename');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');

const concat = require('gulp-concat');
const terser = require('gulp-terser');

const ftp = require('vinyl-ftp');

const ftpPath     = ''; // e.g /folder/subfolder/wp-content/themes/custom-theme
const ftpHost     = '';
const ftpUser     = '';
const ftpPassword = '';

const conn = ftp.create({
  host: ftpHost,
  user: ftpUser,
  password: ftpPassword,
  parallel: 5,
});
const deployGlobs = ['./**/*.php', './style.css', './script.js'];

function cssTask() {
  return gulp
    .src('./assets/sass/style.scss')
    .pipe(sass({
      outputStyle: 'expanded'
    }))
    .pipe(autoprefixer('last 4 versions'))
    .pipe(cleanCSS({
      compatibility: '*'
    }))
    .pipe(gulp.dest('./'))

    .pipe(rtlcss())                     // Convert to RTL
    .pipe(rename({ basename: 'rtl' }))  // Rename to rtl.css
    .pipe(gulp.dest('./'));             // Output (rtl.css)
}

function jsTask() {
  return gulp
    .src(['./assets/js/**/*.js'])
    .pipe(concat('script.js'))
    .pipe(terser({
      keep_fnames: true,
      mangle: false
    }))
    .pipe(gulp.dest('./'));
}

function deployTask() {
  return gulp
    .src(deployGlobs, {
      base: '.',
      buffer: false,
      allowEmpty: true,
    })
    .pipe(conn.newer(ftpPath))
    .pipe(conn.dest(ftpPath));
}

function deployAll() {
  return gulp
    .src(deployGlobs, {
      base: '.',
      buffer: false,
      allowEmpty: true,
    })
    .pipe(conn.dest(ftpPath));
}

function watchFiles() {
  gulp.watch(['./assets/sass/**/*.scss'], gulp.series(cssTask, deployTask));
  gulp.watch('./assets/js/**/*.js', gulp.series(jsTask, deployTask));
  gulp.watch('./**/*.php', deployTask);
}

const watch = watchFiles;

exports.build = gulp.series(jsTask, cssTask);
exports.deploy = deployTask;
exports.depall = deployAll;
exports.watch = watch;
exports.default = watch;
