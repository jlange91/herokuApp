const Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
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
    .enableVueLoader()
;

module.exports = Encore.getWebpackConfig();
