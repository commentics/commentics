var gulp = require('gulp');

var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var sass = require('gulp-sass')(require('sass'));
var sassLint = require('gulp-sass-lint');
var terser = require('gulp-terser');
var strip = require('gulp-strip-comments');

// Lint backend Sass
gulp.task('lint-backend', function() {
    return gulp.src('comments/backend/view/default/stylesheet/sass/stylesheet.scss')
    .pipe(sassLint({
        configFile: '.sasslint.yml'
    }))
    .pipe(sassLint.format())
    .pipe(sassLint.failOnError())
});

// Lint frontend Sass
gulp.task('lint-frontend', function() {
    return gulp.src('comments/frontend/view/default/stylesheet/sass/partial/*.scss')
        .pipe(sassLint({
            configFile: '.sasslint.yml'
        }))
        .pipe(sassLint.format())
        .pipe(sassLint.failOnError())
});

// Lint install Sass
gulp.task('lint-install', function() {
    return gulp.src('comments/install/view/default/stylesheet/sass/stylesheet.scss')
    .pipe(sassLint({
        configFile: '.sasslint.yml'
    }))
    .pipe(sassLint.format())
    .pipe(sassLint.failOnError())
});

var autoprefixerOptions = {
    Browserslist: ['last 2 versions']
};

/* Precompile and minify Sass for backend */
gulp.task('sass-backend', function() {
    return gulp.src('comments/backend/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(gulp.dest('comments/backend/view/default/stylesheet/css'))
        .pipe(rename('stylesheet.min.css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('comments/backend/view/default/stylesheet/css'))
});

/* Precompile and minify Sass for frontend */
gulp.task('sass-frontend', function() {
    return gulp.src('comments/frontend/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(gulp.dest('comments/frontend/view/default/stylesheet/css'))
        .pipe(rename('stylesheet.min.css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('comments/frontend/view/default/stylesheet/css'))
});

/* Precompile and minify Sass for install */
gulp.task('sass-install', function() {
    return gulp.src('comments/install/view/default/stylesheet/sass/stylesheet.scss')
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(gulp.dest('comments/install/view/default/stylesheet/css'))
        .pipe(rename('stylesheet.min.css'))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('comments/install/view/default/stylesheet/css'))
});

var js_files = [
    'comments/3rdparty/highlight/highlight.js',
    'comments/frontend/view/default/javascript/common.js'
];

/* Concatenate and minify JS */
gulp.task('common', function() {
    return gulp.src(js_files)
        .pipe(concat('common.min.js'))
        .pipe(gulp.dest('comments/frontend/view/default/javascript'))
        .pipe(strip())
        .pipe(terser())
        .pipe(gulp.dest('comments/frontend/view/default/javascript'));
});

/* Auto precompile on save */
gulp.task('watch', function() {
    gulp.watch('comments/backend/view/default/stylesheet/sass/**/*.scss', gulp.series('sass-backend'));
    gulp.watch('comments/frontend/view/default/stylesheet/sass/**/*.scss', gulp.series('sass-frontend'));
    gulp.watch('comments/install/view/default/stylesheet/sass/**/*.scss', gulp.series('sass-install'));
    gulp.watch('comments/frontend/view/default/javascript/common.js', gulp.series('js'));
});

gulp.task('lint', gulp.series('lint-backend', 'lint-frontend', 'lint-install'));

gulp.task('sass', gulp.series('sass-backend', 'sass-frontend', 'sass-install'));

gulp.task('js', gulp.series('common'));

/* Default task when running gulp without a command */
gulp.task('default', gulp.series('watch'));