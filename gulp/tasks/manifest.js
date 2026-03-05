const fs = require('fs');
const path = require('path');
const paths = require('../config/paths');

const generateManifest = () => {
    return new Promise((resolve, reject) => {
        const jsDir = paths.build.js;
        const manifest = {
            js: {}
        };

        fs.readdir(jsDir, (err, files) => {
            if (err) {
                reject(err);
                return;
            }

            files.forEach(file => {
                if (path.extname(file) === '.js' && file.includes('vendors')) {
                    manifest.js.vendors = {
                        file: `js/${file}`,
                        dependencies: ['jquery']
                    };
                }
            });

            files.forEach(file => {
                if (path.extname(file) === '.js' && !file.includes('vendors')) {
                    const name = path.basename(file, '.js').replace('.bundle', '');
                    manifest.js[name] = {
                        file: `js/${file}`,
                        dependencies: ['jquery', 'vendors']
                    };
                }
            });

            fs.writeFile(
                paths.build.manifest,
                JSON.stringify(manifest, null, 2),
                err => {
                    if (err) {
                        reject(err);
                        return;
                    }
                    resolve();
                }
            );
        });
    });
};

module.exports = generateManifest;