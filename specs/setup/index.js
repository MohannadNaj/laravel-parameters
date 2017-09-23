require('../../resources/assets/js/core.js');
require('../../resources/assets/js/bootstrap.js');

require('./testUtils.js')
require('./fakeDataHelper.js')

TestData = require('./testData.json')

// require all test files using special Webpack feature
// https://webpack.github.io/docs/context.html#require-context
var testsContext = require.context('.', true, /\.spec$/)
testsContext.keys().forEach(testsContext)

