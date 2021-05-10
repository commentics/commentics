var gulp = require('gulp');

var autoprefix = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var stylelint = require('gulp-stylelint');
var uglify = require('gulp-uglify');

// Lint backend Sass
gulp.task('lint-backend', function() {
    return gulp.src('comments/backend/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(stylelint({
            reporters: [
                {formatter: 'string', console: true}
            ]
        }));
});

// Lint frontend Sass
gulp.task('lint-frontend', function() {
    return gulp.src('comments/frontend/view/default/stylesheet/sass/partial/*.scss')
        .pipe(stylelint({
            reporters: [
                {formatter: 'string', console: true}
            ]
        }));
});

// Lint install Sass
gulp.task('lint-install', function() {
    return gulp.src('comments/install/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(stylelint({
            reporters: [
                {formatter: 'string', console: true}
            ]
        }));
});

var autoprefixOptions = {
    Browserslist: ['last 2 versions']
};

/* Precompile and minify Sass for backend */
gulp.task('sass-backend', function() {
    return gulp.src('comments/backend/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(autoprefix(autoprefixOptions))
        .pipe(gulp.dest('comments/backend/view/default/stylesheet/css'))
        .pipe(rename('stylesheet.min.css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('comments/backend/view/default/stylesheet/css'))
});

/* Precompile and minify Sass for frontend */
gulp.task('sass-frontend', function() {
    return gulp.src('comments/frontend/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(autoprefix(autoprefixOptions))
        .pipe(gulp.dest('comments/frontend/view/default/stylesheet/css'))
        .pipe(rename('stylesheet.min.css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('comments/frontend/view/default/stylesheet/css'))
});

/* Precompile and minify Sass for install */
gulp.task('sass-install', function() {
    return gulp.src('comments/install/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(autoprefix(autoprefixOptions))
        .pipe(gulp.dest('comments/install/view/default/stylesheet/css'))
        .pipe(rename('stylesheet.min.css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('comments/install/view/default/stylesheet/css'))
});

var js_files = [
    'comments/frontend/view/default/javascript/autodetect.js',
    'comments/3rdparty/highlight/highlight.js',
    'comments/3rdparty/timeago/timeago.js',
    'comments/frontend/view/default/javascript/common.js'
];

/* Concatenate and minify JS */
gulp.task('common', function() {
    return gulp.src(js_files)
        .pipe(concat('common.min.js'))
        .pipe(gulp.dest('comments/frontend/view/default/javascript'))
        .pipe(uglify())
        .pipe(gulp.dest('comments/frontend/view/default/javascript'));
});

var jquery = [
    'comments/frontend/view/default/javascript/jquery/jquery.min.js'
];

/* Concatenate and minify JS (with jQuery) */
gulp.task('common-jq', function() {
    return gulp.src(jquery.concat(js_files))
        .pipe(concat('common-jq.min.js'))
        .pipe(gulp.dest('comments/frontend/view/default/javascript'))
        .pipe(uglify())
        .pipe(gulp.dest('comments/frontend/view/default/javascript'));
});

/* Auto precompile Sass on save */
gulp.task('watch', function() {
    gulp.watch('comments/backend/view/default/stylesheet/sass/**/*.scss', ['sass-backend']);
    gulp.watch('comments/frontend/view/default/stylesheet/sass/**/*.scss', ['sass-frontend']);
    gulp.watch('comments/install/view/default/stylesheet/sass/**/*.scss', ['sass-install']);
});

gulp.task('lint', gulp.series('lint-backend', 'lint-frontend', 'lint-install'));

gulp.task('sass', gulp.series('sass-backend', 'sass-frontend', 'sass-install'));

gulp.task('js', gulp.series('common', 'common-jq'));

/* Default task when running gulp without a command */
gulp.task('default', gulp.series('watch'));