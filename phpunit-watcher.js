let files = ['src/**/*.php',
            'tests/**/*.php',
            'app/**/*.php'];

let cmd = '"./vendor/bin/phpunit"';

let chokidarOptions = {};

let chokidar = require('chokidar');

// debounce from: https://stackoverflow.com/a/24004942/4330182
let debounce = (func, wait, immediate) => {
    var timeout;           

    return function() {
        var context = this, 
            args = arguments;

        var callNow = immediate && !timeout;

        clearTimeout(timeout);   

        timeout = setTimeout(function() {

             timeout = null;

             if (!immediate) {
               func.apply(context, args);
             }
        }, wait);

        if (callNow) func.apply(context, args);  
     }; 
};

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
 ];
};

let eventInfo = (path) => {
    eventInfoStructure(path).forEach((line) => {
      console.log.apply(console, line);
    })
};

let execute = debounce(() => {
  console.log('running phpunit..');
  exec(cmd, handleOutput);
}, 1000);

let handleChange = (path) => {
    eventInfo(path);
    execute();
};

const exec = require('child_process').exec;

const watcher = chokidar.watch(files, chokidarOptions);

// Event listeners.
watcher
  .on('change', handleChange);
