var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var cssmin = require('gulp-cssmin');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');

// sass preprocess
gulp.task('scss', function () {
    return gulp.src('./css/main.scss')
            .pipe(sourcemaps.init())
            .pipe(sass().on('error', sass.logError))
            .pipe(autoprefixer({
                browsers: ["> 1%", "last 2 versions"],
                cascade: false
            }))
            .pipe(sourcemaps.write())
            .pipe(gulp.dest('./css'))
            .pipe(cssmin())
            .pipe(rename({suffix: '.min'}))
            .pipe(gulp.dest('./css'));
});

//minify js file
gulp.task('js', function () {
    return gulp.src('./js/app.js')
            .pipe(uglify())
            .pipe(rename({suffix: '.min'}))
            .pipe(gulp.dest('./js/'));
});

// watcher
//gulp.task('watcher', function () {
//    gulp.watch(['./css/**/*.scss'], ['scss']); // scss
////    gulp.watch('./js/app.js', ['js']); // js-main
//});

gulp.task('default', function () {
    gulp.watch('./css/**/*.scss', gulp.series('scss'))
    return
});

