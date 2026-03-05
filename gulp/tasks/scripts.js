const { src, dest } = require('gulp');
const webpack = require('webpack-stream');
const { plumber, size, plumberConfig } = require('../config/plugins');
const webpackConfig = require('../config/webpack');
const { isProd } = require('../config/env');
const paths = require('../config/paths');

const scripts = () => {
  return src(paths.src.js)
    .pipe(plumber(plumberConfig('JavaScript')))
    .pipe(webpack(webpackConfig(isProd)))
    .pipe(size({ title: 'scripts' }))
    .pipe(dest(paths.build.js));
};

module.exports = scripts;