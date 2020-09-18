const path = require('path');
const runProcess = require('./runProcess');

module.exports = (command, commandArgs = []) => {
    let wpcli = path.resolve('vendor', 'bin', 'wp').replace(/(\s+)/g, '\\$1')
    runProcess(wpcli + ' ' + [ command, ...commandArgs ].join(' '));
};
