const gulp = require('gulp');
const config = require('../gulp.config');

const gulpSass = require('gulp-sass');
const path = require('path');

const srcThemeDir = path.resolve( config.paths.srcRoot + config.paths.themes + config.paths.themeName + '/' );
const srcRoot = path.resolve( config.paths.srcRoot );
const iconfontScss = `${srcThemeDir}${config.paths.iconfont.scss}/_iconfont.scss`;

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
        [`${srcThemeDir}/**/*.scss`, `${srcThemeDir}/**/*.sass`, `!${iconfontScss}`], 
        gulp.series('styles')
    );
});