const getArguments = require('./env/getArguments');
getArguments.parse();
const envArgs = getArguments();

module.exports = {
    paths: {
        themeName: 'northeasternUniversity',
        srcRoot: 'src/app/',
        webRoot: 'web/app/',
        themes: 'themes/',
        iconfont: {
            iconSrc: '/icons/**/*', //Path inside theme
            scss: 'css/__styles/',
            template: 'css/templates/_iconfont.scss',
            class: 'icon'
        },
        fonts: {
            src: 'src/app/themes/**/fonts/**/*',
            dist: 'fonts'
        }
    },
    envArgs: envArgs,
    isProduction: !! envArgs.production,
}