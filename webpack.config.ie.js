const baseSettings = require('./webpack.config');

// If you need to use any polyfills that can be installed from
// NPM repository, add them here.
const polyfills = [
    'core-js'
];

// Emit it under a different file name, so regular browsers
// don't have to receive the same (much larger) bundle as IE.
baseSettings.output.filename = 'bundle.ie.js';

baseSettings.module = {
    rules: [{
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
            // https://webpack.js.org/loaders/babel-loader/
            loader: 'babel-loader',
            options: {
                presets: [
                    [
                        // This preset picks which things to inject and polyfill
                        // automatically based on what browsers we want to support.
                        // https://babeljs.io/docs/en/babel-preset-env
                        '@babel/preset-env',
                        {
                            useBuiltIns: 'entry',
                            targets: {
                                ie: 11
                            }
                        }
                    ]
                ]
            }
        }
    }]
};

baseSettings.entry = [...polyfills, baseSettings.entry];

module.exports = baseSettings;
