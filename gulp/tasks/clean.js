const del = require('del');
const paths = require('../config/paths');

const clean = () => {
  return del(paths.root.clean);
};

module.exports = clean;