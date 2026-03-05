const path = require('path');

const rootFolder = path.basename(path.resolve(__dirname, '../../'));
const srcFolder = './source';
const buildFolder = './assets';

module.exports = {
  root: {
    src: srcFolder,
    build: buildFolder,
    clean: [buildFolder]
  },
  src: {
    html: `${srcFolder}/*.html`,
    svg: `${srcFolder}/img/sprite/*.svg`,
    img: `${srcFolder}/img/**/*.{jpg,jpeg,png,svg,gif,ico,webp}`,
    scss: `${srcFolder}/scss/**/*.scss`,
    js: `${srcFolder}/js/main.js`,
    files: `${srcFolder}/files/**/*.*`,
    resources: `${srcFolder}/resources/**/*.*`
  },
  build: {
    html: buildFolder,
    svg: `${buildFolder}/img/sprite`,
    img: `${buildFolder}/img`,
    css: `${buildFolder}/css`,
    js: `${buildFolder}/js`,
    files: buildFolder,
    resources: buildFolder,
    manifest: `${buildFolder}/assets-manifest.json`
  },
  watch: {
    html: `${srcFolder}/**/*.html`,
    svg: `${srcFolder}/img/sprite/*.svg`,
    img: `${srcFolder}/img/**/*.{jpg,jpeg,png,svg,gif,ico,webp}`,
    scss: `${srcFolder}/scss/**/*.scss`,
    js: `${srcFolder}/js/**/*.js`,
    files: `${srcFolder}/files/**/*.*`,
    resources: `${srcFolder}/resources/**/*.*`
  }
};