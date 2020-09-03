const getArguments = require('./env/getArguments');
getArguments.parse();
const envArgs = getArguments();

module.exports = {
    paths: {
        themeName: 'defaultTheme',
        srcRoot: 'src/app/',
        webRoot: 'web/app/',
        themes: 'themes/',
        iconfont: {
            src: 'src/app/themes/**/icons/**/*',
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