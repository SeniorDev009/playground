'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var csso = require('gulp-csso');

sass.compiler = require('node-sass');

gulp.task('css', function() {
  return gulp.src([
      './web/css/interface/interface.scss'
    ])
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(csso()) // minify
    .pipe(gulp.dest('./web/css'));
});
 
gulp.task('watch', function() {
  gulp.watch('./web/css/**/*.scss', gulp.parallel('css'));
});
