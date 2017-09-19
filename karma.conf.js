var files = [
            { pattern: 'specs/index.js',
              watched: true, included: true, served: true},
//            { pattern: 'resources/assets/js/**/*.js',
//              watched: false, included: false, served: false},
//            { pattern: 'resources/assets/js/**/*.vue',
//              watched: false, included: false, served: false},
//            { pattern: 'specs/**/*.js', 
//              watched: false, included: false, served: false},
          ];

var OLD_NODE_ENV = process.env.NODE_ENV;
process.env.NODE_ENV = 'temp-require'
var webpackConfig = require('./node_modules/laravel-mix/setup/webpack.config.js');
delete webpackConfig.entry

process.env.NODE_ENV = OLD_NODE_ENV;

// karma.conf.js
module.exports = function (config) {
  var browsers =  ['PhantomJS'];

  if(process.env.NODE_ENV !== "testing")
    browsers//.push('Chrome_custom');

  config.set({
    browsers: browsers,
    customLaunchers: {
      PhantomJS_custom: {
        'base': 'PhantomJS',
        'options': {
          'viewportSize': {
            'width': 1920,
            'height': 1080
          },
        }
      },
      Chrome_custom: {
        base: 'Chrome',
        flags: ['--disable-gpu']
      }
    },

    frameworks: ['jasmine'],
    // this is the entry file for all our tests.
    files: files,

    // we will pass the entry file to webpack for bundling.
    preprocessors: {
      'specs/index.js': ['webpack']
    },
    // use the webpack config
    webpack: webpackConfig,
    // avoid walls of useless text
    webpackMiddleware: {
      noInfo: true
    },
    colors: true,
    reporters: ['spec'],

    singleRun: process.env.NODE_ENV !== 'testing'
  })
}