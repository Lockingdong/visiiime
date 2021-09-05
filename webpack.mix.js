const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/Theme/VBasic.js', 'public/js/Theme').vue({ version: 2 })
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer')
    ]).override(config => {
        config.module.rules.find(
            rule => rule.test.test('.svg')
        ).exclude = /\.svg$/;

        config.module.rules.push({
            test: /\.svg$/,
            use: [
                {
                    loader: 'html-loader'
                }
            ]
        })

        config.module.rules.forEach(rule => {
            if (rule.test.toString() === '/(\\.(png|jpe?g|gif|webp)$|^((?!font).)*\\.svg$)/') {
                if (Array.isArray(rule.use)) {
                        rule.use.forEach(ruleUse => {
                            if (ruleUse.loader === 'file-loader') {
                                ruleUse.options.esModule = false;
                            }
                    });
                }
            }
        });
        // console.log(webpackConfig)
    });
