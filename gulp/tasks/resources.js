const { src, dest } = require('gulp');
const { plumber, size, plumberConfig } = require('../config/plugins');
const paths = require('../config/paths');

const resources = () => {
    return src(paths.src.resources)
        .pipe(plumber(plumberConfig('Resources')))
        .pipe(size({ title: 'resources' }))
        .pipe(dest(paths.build.resources));
};

module.exports = resources;