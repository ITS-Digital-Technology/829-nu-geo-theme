const path = require('path');

const themeAt = 'app/themes/northeasternUniversity/js';
const settings = {
    entry: path.resolve(__dirname, 'src', themeAt, 'script.js'),
    output: {
        path: path.resolve(__dirname, 'web', themeAt),
        filename: 'bundle.js'
    },

    mode: 'development'
};

module.exports = settings;
