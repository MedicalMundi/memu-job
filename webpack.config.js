const Encore = require('@symfony/webpack-encore');
const path = require('path');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

// define the webpack configuration for front application
Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build-front/')
    // public path used by the web server to access the output path
    .setPublicPath('/build-front')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app_front', './core/publishing/assets/app_front.js')
    // enables the Symfony UX Stimulus bridge (used in core/publishing/assets/bootstrap.js)
    .enableStimulusBridge('./core/publishing/assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()
    //.disableSingleRuntimeChunk()

    /*
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    .enableSassLoader()

    .enablePostCssLoader()

    .copyFiles({
        from: './core/publishing/assets/images',
        to: 'images/[path][name].[hash:8].[ext]',
    })

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    // Load bootstrap-icons
    // .addLoader({
    //     test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
    //     include: path.resolve(__dirname, './node_modules/bootstrap-icons/font/fonts'),
    //     use: {
    //         loader: 'file-loader',
    //         options: {
    //             name: '[name].[ext]',
    //             outputPath: 'webfonts',
    //             publicPath: '../webfonts',
    //         },
    //     }
    // })
;

// build the webpack configuration for front application
const frontAppConfig = Encore.getWebpackConfig();
// Set a unique name for front application
frontAppConfig.name = 'frontAppConfig';


// reset Encore to build the second config
Encore.reset();

// define the webpack configuration for backoffice application
Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build-backoffice/')
    // public path used by the web server to access the output path
    .setPublicPath('/build-backoffice')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app_backoffice', './core/backoffice/assets/app_backoffice.js')
    //enables the Symfony UX Stimulus bridge (used in core/publishing/assets/bootstrap.js)
    .enableStimulusBridge('./core/backoffice/assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()
    //.disableSingleRuntimeChunk()

    /*
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    .enableSassLoader()

    .enablePostCssLoader()

    .copyFiles({
        from: './core/backoffice/assets/images',
        to: 'images/[path][name].[hash:8].[ext]',
    })

;

// build the webpack configuration for backoffice application
const backofficeAppConfig = Encore.getWebpackConfig();
// Set a unique name for backoffice application
backofficeAppConfig.name = 'backofficeAppConfig';




// export both configuration (front,backoffice) as an array of multiple configurations
module.exports = [frontAppConfig, backofficeAppConfig];
