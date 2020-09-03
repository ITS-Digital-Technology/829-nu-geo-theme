const gulp = require('gulp');
const config = require('../gulp.config');

const gulpSass = require('gulp-sass');
const path = require('path');

const srcThemeDir = path.resolve( config.paths.srcRoot + config.paths.themes + config.paths.themeName + '/' );
const iconfontScss = `${srcThemeDir}${config.paths.iconfont.scss}/_iconfont.scss`;

gulp.task('styles', () => {
    return gulp.src([`${config.srcRoot}/**/*.{sass,scss}`])
        .pipe(gulpSass({
            outputStyle: config.isProduction ? 'compressed' : 'expanded',
            precision: 8
        }).on('error', gulpSass.logError))
        .pipe(gulp.dest('web'));
});

gulp.task('styles:watch', () => {
    gulp.watch(
        [`${srcThemeDir}/**/*.scss`, `${srcThemeDir}/**/*.sass`, `!${iconfontScss}`], 
        gulp.series('styles')
    );
});