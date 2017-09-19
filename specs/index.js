// specs/index.js
console.error('specs/index.js | specs/index.js | specs/index.js | specs/index.js | specs/index.js | specs/index.js | specs/index.js | specs/index.js | ')
/*_ = require('lodash');
$ = jQuery = require('jquery');
require('bootstrap-sass')

require('../resources/assets/js/core.js');
require('../resources/assets/js/utils/EventBus')
*/
require('../resources/assets/js/core.js');
require('../resources/assets/js/bootstrap.js');

// require all test files using special Webpack feature
// https://webpack.github.io/docs/context.html#require-context

var testsContext = require.context('.', true, /\.spec$/)
testsContext.keys().forEach(testsContext)

