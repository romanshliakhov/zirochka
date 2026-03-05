const { src, dest } = require('gulp');
const imagemin = require('gulp-imagemin');
const { plumber, size, plumberConfig } = require('../config/plugins');
const { isProd } = require('../config/env');
const paths = require('../config/paths');

const images = () => {
  return src(paths.src.img)
    .pipe(plumber(plumberConfig('Images')))
    .pipe(
      imagemin([
        imagemin.mozjpeg({ quality: 80, progressive: true }),
        imagemin.optipng({ optimizationLevel: 3 }),
        imagemin.svgo({
          plugins: [{ removeViewBox: false }]
        })
      ])
    )
    .pipe(size({ title: 'images' }))
    .pipe(dest(paths.build.img));
};

module.exports = images;