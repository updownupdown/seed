// Required
var gulp          = require('gulp'),
    autoprefixer  = require('gulp-autoprefixer'),
    concat        = require('gulp-concat'),
    csso          = require('gulp-csso'),
    jshint        = require('gulp-jshint'),
    livereload    = require('gulp-livereload'),
    rename        = require('gulp-rename'),
    sass          = require('gulp-sass'),
    sassLint      = require('gulp-sass-lint'),
    sourcemaps    = require('gulp-sourcemaps'),
    stylish       = require('jshint-stylish'),
    uglify        = require('gulp-uglify'),
    watch         = require('gulp-watch');



// Sass - lint
gulp.task('sass-lint', function(){
  return gulp.src(['sass/*.scss'])
    .pipe(sassLint({
      rules: {
        'extends-before-mixins': 0,
        'space-around-operator': 0,
        'space-before-brace': 0,
        'space-before-colon': 0,
        'space-after-colon': 0,
        'one-declaration-per-line': 0,
        'property-sort-order': 0,
        'indentation': 0,
        'force-element-nesting': 0,
        'space-after-comma': 0,
        'no-color-literals': 0,
        'shorthand-values': 0,
        'force-pseudo-nesting': 0,
        'nesting-depth': 0,
        'no-duplicate-properties': 0,
        'no-qualifying-elements': 0,
        'no-ids': 0,
        'no-mergeable-selectors': 0,
        'placeholder-in-extend': 0,
        'empty-line-between-blocks': 0,
        'class-name-format': 0,
        'extends-before-declarations': 0,
        'force-attribute-nesting': 0,
        'single-line-per-selector': 0,
        'hex-notation': 0,
        'brace-style': 0,
        'url-quotes': 0,
        'no-vendor-prefixes': 0,
        'mixins-before-declarations': 0,
        'hex-length': 0,
        'no-important': 0
      }
    }))
    .pipe(sassLint.format())
    .pipe(sassLint.failOnError())
});


// Sass - uglify + sourcemap + livereload
gulp.task('sass-uglify', function(){
  return gulp.src('sass/styles.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer("last 5 versions", "> 5%", "ie 11", "ie 10", "android", "Edge", "Safari", "iOS"))
    .pipe(csso())
    .pipe(rename('styles.min.css'))
    .pipe(sourcemaps.write('maps'))
    .pipe(gulp.dest('build/css'))
    .pipe(livereload());
});


// JS - Global
gulp.task('js-global', function() {
  return gulp.src([
      'js/flexible.js',
      'js/nav.js',
      'js/global.js'
    ])
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('global.js'))
    .pipe(rename('global.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('build/js'));
});


// JS - Other
gulp.task('js-other', function() {
  return gulp.src([
    'js/gravity-forms.js',
    'js/acf-maps.js'
    ])
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest('build/js'));
});


// Watch
var watchedFiles = ['sass/*.scss', 'js/*.js'];
var runTasks = ['sass-lint', 'sass-uglify', 'js-global', 'js-other']

gulp.task('watch', function () {

    livereload.listen();
      gulp.watch('build/js/*.js');
      gulp.watch('build/css/*.css');

    gulp.start(runTasks);
    gulp.watch(watchedFiles, runTasks);
});


// Default Task
gulp.task('default', ['watch']);
//gulp.task('default', runTasks);
