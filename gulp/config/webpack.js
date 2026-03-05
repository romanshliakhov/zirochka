const path = require('path');
const paths = require('./paths');

module.exports = (isProd) => ({
  mode: isProd ? 'production' : 'development',
  entry: {
    main: paths.src.js
  },
  output: {
    filename: '[name].bundle.js',
    chunkFilename: 'vendor/[name].chunk.js'
  },
  optimization: {
    splitChunks: {
      chunks: 'all',
      minSize: 20000,
      minChunks: 1,
      cacheGroups: {
        defaultVendors: {
          test: /[\\/]node_modules[\\/]|[\\/]vendor[\\/]/,
          name: 'vendors',
          chunks: 'all',
          priority: -10
        },
        default: {
          minChunks: 2,
          priority: -20,
          reuseExistingChunk: true
        }
      }
    }
  },
  module: {
    rules: [{
      test: /\.m?js$/,
      exclude: /node_modules/,
      use: {
        loader: 'babel-loader',
        options: {
          presets: [
            ['@babel/preset-env', {
              targets: "defaults"
            }]
          ]
        }
      }
    }]
  },
  devtool: !isProd ? 'source-map' : false,
  resolve: {
    fallback: {
      "path": require.resolve("path-browserify")
    }
  }
});