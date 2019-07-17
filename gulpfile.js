const fs = require('fs');
const path = require('path');
const gulp = require('gulp');
const gulpSass = require('gulp-sass');
const through = require('through2');
const webpack = require('webpack');
const zip = require('gulp-zip');
const browserSync = require('browser-sync');
const runSequence = require('run-sequence');

const wpcli = require('./env/wpcli');
const getArguments = require('./env/getArguments');

require('dotenv').config();
getArguments.parse();

const source = 'src';
const dist = 'web';
const appArguments = getArguments();
const production = !!appArguments.production;

/*
 * Compile styles - *.scss and *.sass files.
 */
gulp.task('styles', () => {
    return gulp.src([`${source}/**/*.{sass,scss}`])
        .pipe(gulpSass({
            outputStyle: production ? 'compressed' : 'expanded',
            precision: 8
        }).on('error', gulpSass.logError))
        .pipe(gulp.dest('web'));
});

gulp.task('styles:watch', () => {
    const watcher = gulp.watch(`${source}/**/*`, {
        delay: 500,
    });

    watcher.on('change', (filePath) => {
        const extension = path.extname(filePath.path);
        if (['.scss', '.sass'].indexOf(extension) > -1) {
            gulp.start('styles');
        }
    });
});

/*
 * Remove all generated JS bundles.
 * If webpack is configured to add hash to bundles they will not be overriden,
 * so multiple builds just keep adding new files. This task will remove
 * the generated bundles to have fresh build every time.
 */
gulp.task('clean-bundles', () => {
    return gulp.src(`${dist}/**/*bundle*.js`)
        .pipe(through.obj((chunk, enc, cb) => {
            fs.unlinkSync(chunk.path);
            cb(null, chunk);
        }));
});

/*
 * Compile scripts using webpack.
 */

/**
 * @param {string} configName Name of the config file to import.
 * @param {string} name Printed in console to identify the build, for devs convenience.
 * @param {function} cb Gulp callback, passes from task.
 */
const compileWebpack = (configName, name, cb) => {
    if (!fs.existsSync(`${configName}.js`)) {
        cb();
        return;
    }

    const config = require(configName);
    if (production) {
        config.mode = 'production';
    }

    console.info(`\n[webpack][${name}]\n`);

    webpack(config, (err, stats) => {
        console.info(stats.toString({
            chunks: false, // Makes the build much quieter
            colors: true
        }))

        cb();
    });
};

gulp.task('scripts:default', cb => {
    compileWebpack('./webpack.config', 'default', cb);
});

gulp.task('scripts:ie', cb => {
    compileWebpack('./webpack.config.ie', 'IE', cb);
});

gulp.task('scripts', cb => {
    runSequence(
        'scripts:default',
        'scripts:ie',
        cb
    );
});

gulp.task('scripts:watch', () => {
    const config = require('./webpack.config');
    webpack(config).watch({
        aggregateTimeout: 300,
        poll: undefined
    }, () => {});
});

/*
 * Launch browsersync for live reload and browser testing.
 */
gulp.task('browsersync', () => {
    return browserSync({
        files: [{
            match: `${dist}/**/*.*`
        }],
        ignore: [`${dist}/app/uploads/*`],
        watchEvents: [ 'change', 'add' ],
        codeSync: true,
        proxy: process.env.APP_URL,
        snippetOptions: {
            ignorePaths: ['*/wp/wp-admin/**']
        }
    });
});

/*
 * Watch changes to files, and recompile.
 */
gulp.task('watch', () => {
    runSequence(
        'styles:watch',
        'scripts:watch',
        'browsersync'
    );
});

/*
 * Build the project.
 */
gulp.task('build', cb => {
    runSequence(
        'styles',
        'clean-bundles',
        'scripts',
        cb
    );
});

/*
 * Filepack
 */
gulp.task('filepack', () => {
    return gulp.src([
        'web/app/**',
        '!web/app/mu-plugins/**',
        '!web/app/mu-plugins',
        'db/db.sql',
        'resources/theme-installation-instructions.pdf'
    ])
        .pipe(zip('filepack.zip'))
        .pipe(gulp.dest(dist))
});

/*
 * WordPress / database tasks
 */
gulp.task('db:export', cb => {
    // Output file name.
    let exportName = appArguments['file'] || 'db';

    // Add timestamp if requested by a parameter.
    const dateSuffix = !!appArguments['timestamp'];
    if (dateSuffix) {
        exportName = `${exportName}-${Date.now()}`;
    }

    // We add an option to remove the "/wp" part from the URL in case
    // the page is to be installed without bedrock.
    const removeWp = !!appArguments['no-wp'];

    // What to replace the site URL with?
    const replaceWith = appArguments['url'] || '<-- REPLACE_ADDRESS -->';

    // Target location with filename for our database dump
    const filePath = `db/${exportName}.sql`;

    if (removeWp) {
        // Remove "/wp" from the URL.
        // Some URLs have "/wp" at the end, and some don't. We need to replace
        // both with the same target URL. In that case we need to use
        // a --regex flag which will tell `search-replace` to treat
        // first argument as an regex expression (without delimiters).

        const replace = `${process.env.APP_URL}(/wp)?`;

        wpcli('search-replace', [
            `"${replace}"`,
            `"${replaceWith}"`,
            `--export=${filePath}`,
            `--regex`,
            `--all-tables-with-prefix`
        ]);
    } else {
        // Do not remove "/wp" from the URL.
        // This is used when we want to create an SQL dump for environments
        // that use Bedrock. Just replace the main address, nothing more.
        const replace = process.env.APP_URL;
        wpcli('search-replace', [
            `"${replace}"`,
            `"${replaceWith}"`,
            `--export=${filePath}`,
            `--all-tables-with-prefix`
        ]);
    }

    // Wordpress tables have "zero" value as an default for datetime columns
    // which are treated as an error when SQL_MODE
    // contain `NO_ZERO_IN_DATE, NO_ZERO_DATE` flags
    // (like it is on some mysql configurations).
    // This fix writes to sql dump file 2 lines that will
    // temporairly change the SQL_MODE to more liberal one
    // so our dump can be successfully imported.
    const sqlContent = fs.readFileSync(filePath);
    const prependSql = "/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;";
    const appendSql = "/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;";
    fs.writeFileSync(filePath, `${prependSql}\n${sqlContent}\n${appendSql}`);

    cb();
});

gulp.task('db:import', cb => {
    const fileName = appArguments['file'] || 'db';
    if (!fs.existsSync(path.resolve(__dirname, `db/${fileName}.sql`))) {
        cb();
        return;
    }

    wpcli('db', [
        'import',
        `db/${fileName}.sql`
    ]);

    wpcli('search-replace', [
        '"<-- REPLACE_ADDRESS -->"',
        `"${process.env.APP_URL}"`,
        `--all-tables-with-prefix`
    ]);

    cb();
});

/*
 * Insallation
 */
gulp.task('wp-install', cb => {
    wpcli('db', [ 'create' ]);

    wpcli('core', [
        'install',
        `--url="${process.env.APP_URL}"`,
        `--title="WP Title Example"`,
        '--admin_user=wpdev',
        '--admin_email="example@example.com"',
        '--admin_password="qwe123EWQ#@!"'
    ]);

    wpcli('rewrite', [ 'flush' ]);

    cb();
});

gulp.task('install', cb => {
    runSequence(
        'wp-install',
        cb
    );
});

/*
 * This runs when you just type "gulp".
 */
gulp.task('default', () => {
    gulp.start('build');
    gulp.start('watch');
});
