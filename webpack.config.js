const Encore = require('@symfony/webpack-encore');

Encore.disableSingleRuntimeChunk()
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .addStyleEntry('style', './assets/css/app.css')
    .enablePostCssLoader(function(options) {
        options.config = {
        path: 'config/postcss.config.js'
        }
    })
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVueLoader();

module.exports = Encore.getWebpackConfig();
