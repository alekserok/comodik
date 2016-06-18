'use strict';

var gulp = require('gulp'),
    watch = require('gulp-watch'),
    concat = require('gulp-concat'),
    concat_css = require('gulp-concat-css'),
    notify = require('gulp-notify'),
    ngAnnotate = require('gulp-ng-annotate'),
    livereload = require('gulp-livereload'),
    http = require('http'),
    st = require('st'),
    htmlmin = require('gulp-htmlmin'),
    sourcemaps = require('gulp-sourcemaps'),
    uglify = require('gulp-uglify'),
    minifyCss = require("gulp-minify-css"),
    autoTranslator = require('gulp-auto-translator');

var paths = {
    scripts: [
        'node_modules/angular/angular.min.js',
        "node_modules/angular-route/angular-route.js",
        "node_modules/angular-cookies/angular-cookies.min.js",
        "node_modules/angular-animate/angular-animate.min.js",
        "resources/comodik_web/js/*",
        "resources/comodik_web/controllers/*"
    ],
    css: [
        'resources/comodik_web/css/*',
        "node_modules/angularjs-toaster/toaster.min.css"
    ],
    html: [
        'resources/comodik_web/views/*.html'
    ]
};

gulp.task('scripts', function () {
    return gulp.src(paths.scripts)
        .pipe(sourcemaps.init())
        .pipe(concat('app.js'))
        .pipe(ngAnnotate())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public'))
        .pipe(livereload())
        .pipe(notify({message: 'Script task complete'}));
});

gulp.task('html', function() {
    return gulp.src(paths.html)
        .pipe(gulp.dest('public/views'))
        .pipe(livereload())
        .pipe(notify({message: 'HTML task complete'}));
});

gulp.task('css', function () {
    return gulp.src(paths.css)
        .pipe(concat_css('style.css'))
        .pipe(gulp.dest('public'))
        .pipe(livereload())
        .pipe(notify({message: 'Styles task complete'}));
});

gulp.task('default', ['scripts', 'css', 'html']);

gulp.task('watch', function () {
    gulp.watch(paths.scripts, ['scripts']);
    gulp.watch(paths.css, ['css']);
    gulp.watch(paths.html, ['html']);
    livereload.listen();
});

gulp.task('prod', function () {
    gulp.src(paths.html)
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest('public'));
    gulp.src(paths.css)
        .pipe(concat_css('style.css'))
        .pipe(minifyCss())
        .pipe(gulp.dest('public'));
    gulp.src(paths.scripts)
        .pipe(concat('app.js'))
        .pipe(ngAnnotate())
        .pipe(uglify())
        .pipe(gulp.dest('public'))
        .pipe(notify({message: 'Compile complete'}));
});