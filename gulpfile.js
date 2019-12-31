var gulp = require('gulp');

var autoprefix = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var stylelint = require('gulp-stylelint');
var uglify = require('gulp-uglify');

// Lint backend Sass
gulp.task('lint-backend', function() {
    return gulp.src('upload/backend/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(stylelint({
            reporters: [
                {formatter: 'string', console: true}
            ]
        }));
});

// Lint frontend Sass
gulp.task('lint-frontend', function() {
    return gulp.src('upload/frontend/view/default/stylesheet/sass/partial/*.scss')
        .pipe(stylelint({
            reporters: [
                {formatter: 'string', console: true}
            ]
        }));
});

// Lint install Sass
gulp.task('lint-install', function() {
    return gulp.src('upload/install/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(stylelint({
            reporters: [
                {formatter: 'string', console: true}
            ]
        }));
});

var autoprefixOptions = {
    browsers: ['last 2 versions']
};

/* Precompile and minify Sass for backend */
gulp.task('sass-backend', function() {
    return gulp.src('upload/backend/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(autoprefix(autoprefixOptions))
        .pipe(gulp.dest('upload/backend/view/default/stylesheet/css'))
        .pipe(rename('stylesheet.min.css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('upload/backend/view/default/stylesheet/css'))
});

/* Precompile and minify Sass for frontend */
gulp.task('sass-frontend', function() {
    return gulp.src('upload/frontend/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(autoprefix(autoprefixOptions))
        .pipe(gulp.dest('upload/frontend/view/default/stylesheet/css'))
        .pipe(rename('stylesheet.min.css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('upload/frontend/view/default/stylesheet/css'))
});

/* Precompile and minify Sass for install */
gulp.task('sass-install', function() {
    return gulp.src('upload/install/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(autoprefix(autoprefixOptions))
        .pipe(gulp.dest('upload/install/view/default/stylesheet/css'))
        .pipe(rename('stylesheet.min.css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('upload/install/view/default/stylesheet/css'))
});

var js_files = [
    'upload/frontend/view/default/javascript/autodetect.js',
    'upload/3rdparty/highlight/highlight.js',
    'upload/3rdparty/timeago/timeago.js',
    'upload/frontend/view/default/javascript/common.js'
];

/* Concatenate and minify JS */
gulp.task('common', function() {
    return gulp.src(js_files)
        .pipe(concat('common.min.js'))
        .pipe(gulp.dest('upload/frontend/view/default/javascript'))
        .pipe(uglify())
        .pipe(gulp.dest('upload/frontend/view/default/javascript'));
});

var jquery = [
    'upload/frontend/view/default/javascript/jquery/jquery.min.js'
];

/* Concatenate and minify JS (with jQuery) */
gulp.task('common-jq', function() {
    return gulp.src(jquery.concat(js_files))
        .pipe(concat('common-jq.min.js'))
        .pipe(gulp.dest('upload/frontend/view/default/javascript'))
        .pipe(uglify())
        .pipe(gulp.dest('upload/frontend/view/default/javascript'));
});

/* Auto precompile Sass on save */
gulp.task('watch', function() {
    gulp.watch('upload/backend/view/default/stylesheet/sass/**/*.scss', ['sass-backend']);
    gulp.watch('upload/frontend/view/default/stylesheet/sass/**/*.scss', ['sass-frontend']);
    gulp.watch('upload/install/view/default/stylesheet/sass/**/*.scss', ['sass-install']);
});

gulp.task('lint', ['lint-backend', 'lint-frontend', 'lint-install']);

gulp.task('sass', ['sass-backend', 'sass-frontend', 'sass-install']);

gulp.task('js', ['common', 'common-jq']);

/* Default task when running gulp without a command */
gulp.task('default', ['watch']);