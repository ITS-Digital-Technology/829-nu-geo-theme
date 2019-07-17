const bestzip = require('bestzip');
const path = require('path');
const fs = require('fs');

const source = [
    'themes/*',
    'plugins/*',
    'uploads/*'
];

// Add database dump if it exists.
if (fs.existsSync(path.resolve(__dirname, '../db/db.sql'))) {
    source.push('../../db/db.sql');
}

bestzip({
    cwd: 'web/app',
    source,
    destination: '../filepack.zip'
});
