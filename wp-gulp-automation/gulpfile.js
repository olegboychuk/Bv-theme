const gulp         = require('gulp'),
      sass         = require('gulp-sass'),
      postcss      = require('gulp-postcss'),
      autoprefixer = require('autoprefixer'),
      cssnano      = require('gulp-cssnano'),
      uglify       = require('gulp-uglify'),
      concat       = require('gulp-concat'),
      sourcemaps   = require('gulp-sourcemaps');

    
/**
 * Sources & destinations.
 */

const paths = {
    scss: {
        src: './assets/scss/**/*', // Will be used by `src()` and `watch()`.
        dest: './assets/dist/css/' // Will be used by `dest()`.
    },
    js: {
        src: './assets/js/**/*.js', // Will be used by `src()` and `watch()`.
        dest: './assets/dist/js/'   // Will be used by `dest()`.
    }
};


/*
 * Processing & compiling styles.
 */

function styles()
{
    return gulp.src(paths.scss.src)              // Source files. Could be an array.
        .pipe(sourcemaps.init())                 // Init source maps.
        .pipe(sass().on('error', sass.logError)) // Compile scss/sass into css.
        .pipe(postcss([ autoprefixer() ]))       // Autoprefixing for browser compatibility.
        .pipe(concat('style.min.css'))           // Putting everything in a single file.
        .pipe(cssnano())                         // Minifying.
        .pipe(sourcemaps.write('./maps'))        // Writing source maps (relative to destination).
        .pipe(gulp.dest(paths.scss.dest));       // Sending compiled file to destination.
}


/*
 * Processing JS.
 */

function scripts()
{
    return gulp.src([                 // Source files.
        // './node_modules/...',
        paths.js.src
    ])
    .pipe(sourcemaps.init())          // Init source maps.
    .pipe(concat('scripts.min.js'))   // Putting everything in a single file.
    .pipe(uglify())                   // = renaming variables + minifying.
    .pipe(sourcemaps.write('./maps')) // Writing source maps (relative to destination).
    .pipe(gulp.dest(paths.js.dest));  // Sending compiled file to destination.
}


/*
 * Watch tasks.
 */

function watchAll()
{
    gulp.watch(paths.scss.src, gulp.series(styles));
    gulp.watch(paths.js.src, gulp.series(scripts));
}

exports.styles  = styles;
exports.scripts = scripts;
exports.build   = gulp.parallel(styles, scripts);
exports.default = watchAll;