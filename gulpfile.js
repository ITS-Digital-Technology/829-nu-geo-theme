const gulp = require('gulp');
const gulpConfig = require('./gulp.config')

require('dotenv').config();
require( './tasks/iconfont' )
require( './tasks/styles' )
require( './tasks/scripts' )
require( './tasks/browsersync' )
require( './tasks/wp-cli' )

gulp.task('default', gulp.series(
    // TODO: 'clean',
    'iconfont',
    gulp.parallel(
        'styles',
        'scripts'
    )
))

gulp.task('build', gulp.series('default'))

gulp.task(
    'watch', 
    gulp.parallel(
        'styles:watch',
        'scripts:watch',
        'browsersync'
    )
)
