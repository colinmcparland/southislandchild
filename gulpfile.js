var gulp = require('gulp');  //loads the gulp node package
var sass = require('gulp-ruby-sass');
var cleanCSS = require('gulp-clean-css');
var autoprefix = require('gulp-autoprefixer');
var pump = require('pump');
var uglify = require('gulp-uglify');
var runSequence = require('run-sequence');

/*  CSS Tasks  */
gulp.task('compile-css', function() {
  return sass('scss/style.scss')
  .pipe(gulp.dest('.'));
});

gulp.task('minify-css', function() {
  return gulp.src('./style.css')
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(gulp.dest('.'));
});

gulp.task('prefix-css', function() {
  return gulp.src('./style.css')
    .pipe(autoprefix({browsers: 'last 4 versions'}))
    .pipe(gulp.dest('.'));
});

gulp.task('js', function (cb) {
  pump([
        gulp.src('script/main.js'),
        // uglify(),
        gulp.dest('.')
    ],
    cb
  );
});

//  Master build task
gulp.task('build-css', function(callback) {
  runSequence('compile-css', 'prefix-css', 'minify-css', callback);
});

// Watch task, compile CSS on changes
gulp.task('watch', function() {
  gulp.watch('scss/*.scss', ['build-css']); 
  // gulp.watch('script/*.js', ['js']);
});

// Main Task
gulp.task('default', ['watch']);
