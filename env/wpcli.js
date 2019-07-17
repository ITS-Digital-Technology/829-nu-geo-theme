const path = require('path');
const runProcess = require('./runProcess');

module.exports = (command, commandArgs = []) => {
    runProcess(path.resolve('vendor', 'bin', 'wp') + ' ' + [ command, ...commandArgs ].join(' '));
};
