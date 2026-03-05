const { src, dest } = require('gulp');
const { plumber, size, plumberConfig } = require('../config/plugins');
const paths = require('../config/paths');

const vendor = () => {
  const sources = Object.values(paths.src.vendor);
  
  if (sources.length === 0) {
    return Promise.resolve();
  }

  return src(sources)
    .pipe(plumber(plumberConfig('Vendor')))
    .pipe(size({ title: 'vendor' }))
    .pipe(dest(paths.build.vendor));
};

module.exports = vendor;