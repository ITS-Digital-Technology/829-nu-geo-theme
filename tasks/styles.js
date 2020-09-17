const gulp = require('gulp');
const config = require('../gulp.config');

const gulpSass = require('gulp-sass');
const path = require('path');

const srcRoot = path.resolve( config.paths.srcRoot );

gulp.task('styles', (done) => {
    gulp.src([`${srcRoot}/**/*.{sass,scss}`])
        .pipe(gulpSass({
            outputStyle: config.isProduction ? 'compressed' : 'expanded',
            precision: 8
        }).on('error', gulpSass.logError))
        .pipe(gulp.dest('web/app'))
        .on('finish', done);
});

gulp.task('styles:watch', () => {
    gulp.watch(
        [`${srcRoot}/**/*.{scss, sass}`], 
        gulp.series('styles')
    );
});