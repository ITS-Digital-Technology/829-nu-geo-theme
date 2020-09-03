const gulp = require('gulp');
const config = require('../gulp.config');

const browserSync = require('browser-sync');

/*
 * Launch browsersync for live reload and browser testing.
 */

gulp.task('browsersync', () => {
    return browserSync({
        files: [{
            match: `${config.paths.webRoot}/**/*.*`
        }],
        ignore: [`${config.paths.webRoot}/uploads/*`],
        watchEvents: [ 'change', 'add' ],
        codeSync: true,
        proxy: process.env.APP_URL,
        snippetOptions: {
            ignorePaths: ['*/wp/wp-admin/**']
        }
    });
});