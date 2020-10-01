const gulp = require('gulp');
const config = require('../gulp.config')

const fs = require('fs');
const path = require('path');
const wpcli = require('../env/wpcli');

/*
 * WordPress / database tasks
 */
gulp.task('db:export', cb => {
    // Output file name.
    let exportName = config.envArgs['file'] || 'db';

    // Add timestamp if requested by a parameter.
    const dateSuffix = !!config.envArgs['timestamp'];
    if (dateSuffix) {
        exportName = `${exportName}-${Date.now()}`;
    }

    // We add an option to remove the "/wp" part from the URL in case
    // the page is to be installed without bedrock.
    const removeWp = !!config.envArgs['no-wp'];

    // What to replace the site URL with?
    const replaceWith = config.envArgs['url'] || '<-- REPLACE_ADDRESS -->';

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
    const fileName = config.envArgs['file'] || 'db';
    if (!fs.existsSync(path.resolve(__dirname, `../db/${fileName}.sql`))) {
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
    wpcli('db', [ 'create || true' ]);

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

/**
 * Flush permalinks
 */
gulp.task('wp-flush', cb => {
    
    wpcli('rewrite', [ 'flush', '--hard' ]);

    cb();
});

/**
 * Regenerate thumbnails
 */
gulp.task('wp-regen', cb => {
    
    wpcli('media', [ 'regenerate', '--yes' ]);

    cb();
});

gulp.task( 'install', gulp.series('wp-install') );
