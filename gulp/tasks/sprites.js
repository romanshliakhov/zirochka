const { src, dest } = require('gulp');
const svgstore = require('gulp-svgstore');
const rename = require('gulp-rename');
const { plumber, size, plumberConfig } = require('../config/plugins');
const paths = require('../config/paths');

const sprites = () => {
  return src(paths.src.svg)
    .pipe(plumber(plumberConfig('SVG Sprites')))
    .pipe(svgstore({ inlineSvg: true }))
    .pipe(rename('sprite.svg'))
    .pipe(size({ title: 'sprites' }))
    .pipe(dest(paths.build.svg));
};

module.exports = sprites;