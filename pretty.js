// use prettier on vue files along with js, modified from:
// https://medium.com/@jackysee/prettier-vue-file-with-sublime-text-475062375956

// Prettier options
const formatOptions = {
  useTabs: false,
  semi: false,
  bracketSpacing: true,
  singleQuote: true,
  jsxBracketSameLine: false,
  trailingComma: 'none',
  parser: 'babylon'
}

const glob = require('glob')
const prettier = require('prettier')
const fs = require('fs')
const parser = require('html-script-hook')
const jsBeautify = require('js-beautify').js_beautify

const files = process.argv[2] || 'resources/assets/js/**/*.{vue,js}'

glob(files, function(er, files) {
  files.forEach(file => {
    let source = fs.readFileSync(file, 'utf8')
    let result

    if (file.endsWith('vue')) {
      result = jsBeautify(source)
      result = parser(result, {
        scriptCallback: function(code) {
          return `\n\n${prettier.format(code, formatOptions)}\n`
        },
        padLineNo: true
      })
    } else {
      result = prettier.format(source, formatOptions)
    }

    fs.writeFileSync(file, result, { encoding: 'utf8' })
    console.log(`run prettier on ${file}`)
  })
})
