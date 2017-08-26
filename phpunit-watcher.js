var files = ['src/**/*.php',
            'tests/**/*.php',
            'app/**/*.php'];

var cmd = '"./vendor/bin/phpunit"';

var chokidar = require('chokidar');

let handleOutput = (error, stdout, stderr) => {
	    if (error) {
	        console.error(`exec error: ${error}`);
	    }
	    console.log(`${stdout}`);
	    console.log(`${stderr}`);
	};
 
 let eventInfoStructure = (path) => { return [
    ['\x1b[92m','____________________'],
    ['\x1b[39m','------------'],
    ['\x1b[39m','|', '\x1b[34m',
      new Date().toISOString().replace(/T/, ' ').replace(/\..+/, '')
      ],
    ['\x1b[39m' , '| File: ', '\x1b[32m', path],
    ['\x1b[39m' , '------------'],
    ['\x1b[92m','____________________'],
 ];
};

let eventInfo = (path) => {
    eventInfoStructure(path).forEach((line) => {
      console.log.apply(console, line);
    })
};

let handleChange = (path) => {
    eventInfo(path);
    exec(cmd, handleOutput);
};

const exec = require('child_process').exec;

var watcher = chokidar.watch(files, {atomic: 300});

// Event listeners.
watcher
  .on('change', handleChange);
