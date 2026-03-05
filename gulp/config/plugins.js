const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const size = require('gulp-size');

const plumberConfig = (title) => ({
  errorHandler: notify.onError({
    title: title,
    message: 'Error: <%= error.message %>'
  })
});

module.exports = {
  plumber,
  notify,
  size,
  plumberConfig
};