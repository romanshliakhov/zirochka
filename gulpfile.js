const { series, parallel, watch } = require('gulp');
const browserSync = require('browser-sync').create();

// Конфигурация
const paths = require('./gulp/config/paths');
const { isProd } = require('./gulp/config/env');

// Задачи
const clean = require('./gulp/tasks/clean');
const styles = require('./gulp/tasks/styles');
const scripts = require('./gulp/tasks/scripts');
const images = require('./gulp/tasks/images');
const sprites = require('./gulp/tasks/sprites');
const resources = require('./gulp/tasks/resources');
const generateManifest = require('./gulp/tasks/manifest');
const path = require("path");
const rootFolder = path.basename(path.resolve(__dirname));
const hostName = `${rootFolder}`;

// Сервер

const timestamp = new Date().getTime();
const server = () => {
  browserSync.init({
    proxy: hostName,
    notify: false,
    port: 3000,
    // middleware: [
    //   function (req, res, next) {
    //     if (req.url.includes('.css') || req.url.includes('.js')) {
    //       req.url = req.url + '?v=' + timestamp;
    //     }
    //     next();
    //   }
    // ]
  });
};

// Наблюдение
const watcher = () => {
  watch(paths.watch.scss, styles).on('change', browserSync.reload);
  watch(paths.watch.js, series(scripts, generateManifest)).on('change', browserSync.reload);
  watch(paths.watch.img, images).on('change', browserSync.reload);
  watch(paths.watch.svg, sprites).on('change', browserSync.reload);
  watch(paths.watch.resources, resources).on('change', browserSync.reload);
};

// Сборка
const mainTasks = series(
    parallel(styles, scripts, images, sprites, resources),
    generateManifest
);

const dev = series(clean, mainTasks, parallel(watcher, server));
const build = series(clean, mainTasks);

// Экспорт задач
exports.default = dev;
exports.build = build;
exports.clean = clean;