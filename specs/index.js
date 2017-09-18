// specs/index.js

_ = require('lodash');
$ = jQuery = require('jquery');
require('bootstrap-sass')

// require all test files using special Webpack feature
// https://webpack.github.io/docs/context.html#require-context
var testsContext = require.context('.', true, /\.spec$/)
testsContext.keys().forEach(testsContext)

