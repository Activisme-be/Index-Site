var gulp = require('gulp');

var JsFiles = [];

var CssFiles = [
    './node_modules/admin-lte/dist/css/AdminLTE.css',
    './node_modules/admin-lte/dist/css/skins/skin-blue.css'
];

gulp.task('copy-css', function () {
    return gulp.src(CssFiles).pipe(gulp.dest('./assets/css'));
});

gulp.task('copy-js', function () {
    return gulp.src(JsFiles).pipe(gulp.dest('./assets/js'));
});