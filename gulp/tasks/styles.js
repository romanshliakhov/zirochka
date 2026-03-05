const sass = require('sass');
const path = require('path');
const fs = require('fs').promises;
const Vinyl = require('vinyl');
const glob = require('glob');
const CleanCSS = require('clean-css');
const postcss = require('postcss');
const autoprefixer = require('autoprefixer');
const sortMedia = require('postcss-sort-media-queries');
const { isProd } = require('../config/env');
const paths = require('../config/paths');

const scssEntries = glob.sync('source/scss/**/!(_)*.scss', { nodir: true });

const compileSassFile = async (filePath) => {
    const result = await sass.compileAsync(filePath, {
        style: 'expanded',
        sourceMap: !isProd,
        sourceMapIncludeSources: !isProd,
        silenceDeprecations: ['legacy-js-api'],
        loadPaths: ['node_modules', 'source/scss']
    });

    const relativePath = path.relative('source/scss', filePath);
    const outFilePath = relativePath.replace(/\.scss$/, '.css');
    const outMapPath = outFilePath + '.map';

    // 📦 PostCSS: Autoprefixer + sortMediaQueries
    const postcssResult = await postcss([
        autoprefixer,
        sortMedia
    ]).process(result.css, {
        from: undefined,
        map: !isProd ? { prev: result.sourceMap, inline: false } : false
    });

    let cssContent = postcssResult.css;
    let mapContent = postcssResult.map ? postcssResult.map.toString() : null;

    if (isProd) {
        const minified = new CleanCSS().minify(cssContent);
        cssContent = minified.styles;
        mapContent = null;
    }

    return {
        css: cssContent,
        map: mapContent,
        relativePath: outFilePath,
        mapPath: outMapPath
    };
};

const styles = async function () {
    const compiledFiles = await Promise.all(scssEntries.map(compileSassFile));

    for (const file of compiledFiles) {
        await fs.mkdir(path.join(paths.build.css, path.dirname(file.relativePath)), { recursive: true });

        await fs.writeFile(
            path.join(paths.build.css, file.relativePath),
            Buffer.from(
                file.css +
                (!isProd && file.mapPath
                    ? `\n/*# sourceMappingURL=${path.basename(file.mapPath)} */`
                    : '')
            )
        );

        if (!isProd && file.map) {
            await fs.writeFile(path.join(paths.build.css, file.mapPath), Buffer.from(file.map));
        }
    }
};

module.exports = styles;
