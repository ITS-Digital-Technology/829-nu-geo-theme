const gulp = require('gulp');
const config = require('../gulp.config');

const iconfont = require('gulp-iconfont');
const runTimestamp = Math.round(Date.now()/1000);
const consolidate = require('gulp-consolidate');

const srcThemeDir = config.paths.srcRoot + config.paths.themes + config.paths.themeName + '/';
const webThemeDir = config.paths.webRoot + config.paths.themes + config.paths.themeName + '/';

gulp.task('iconfont', function(done) {
    var iconStream = gulp.src([config.paths.iconfont.src])
        .pipe(iconfont({
            fontName: 'iconfont-' + config.paths.themeName,
            normalize: true,
            fontHeight: 1001,
            //prependUnicode: true, // recommended option
            formats: ['ttf', 'eot', 'woff', 'woff2', 'svg'], // default, 'woff2' and 'svg' are available
            timestamp: runTimestamp, // recommended to get consistent builds when watching files
        }));

    gulp.parallel([
        function handleGlyphs (cb) {
            iconStream.on('glyphs', function(glyphs, options) {
                gulp.src(srcThemeDir +config.paths.iconfont.template)
                .pipe(consolidate('lodash', {
                    glyphs: glyphs,
                    fontCacheBuster: Math.random().toString(36).substring(7),
                    fontName: 'iconfont-' + config.paths.themeName,
                    themePath: '/' + config.paths.themes + config.paths.themeName + '/',
                    fontPath: config.paths.fonts.dist + '/iconfont-' + config.paths.themeName,
                    className: config.paths.iconfont.class
                }))
                .pipe(gulp.dest(srcThemeDir + config.paths.iconfont.scss))
                .on('finish', cb);
            });
        },
        function handleFonts (cb) {
            iconStream
                .pipe(gulp.dest((webThemeDir + config.paths.fonts.dist + '/iconfont-' + config.paths.themeName)))
                .on('finish', cb);
        }
    ]);

    done();
});
