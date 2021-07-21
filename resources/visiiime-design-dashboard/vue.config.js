const path = require("path");

function resolve(dir) {
    return path.join(__dirname, dir);
}

const isProd = process.env.NODE_ENV === "production";

let webpackConfig;
if (isProd) {
    webpackConfig = {
        pages: {
            main: {
                entry: "src/main.js",
                template: "src/templates/main.ejs",
                filename: path.resolve(
                    __dirname,
                    "../views/components/vPage/main.blade.php"
                ),
                inject: false,
                minify: false
            }
        },
        publicPath: "/visiiime-design-dashboard/",

        outputDir: "../../public/visiiime-design-dashboard",

        indexPath: path.resolve(
            __dirname,
            "../views/components/vPage/design.blade.php"
        )
    };
} else {
    webpackConfig = {};
}

module.exports = {
    ...webpackConfig,
    chainWebpack(config) {
        const svgRule = config.module.rule('svg')
        svgRule.uses.clear()
        config.module
            .rule('svg')
            .test(/\.svg$/)
            .use('html-loader')
            .loader('html-loader')
            .end()


    }
};
