const path = require('path');

module.exports = () => {

    const isProd = process.env.NODE_ENV === 'production';

    if(isProd) {
        return {
            pages: {
                main: {
                    entry: 'src/main.js',
                    template: 'src/templates/main.ejs',
                    filename: path.resolve(__dirname, '../views/components/theme/main.blade.php'),
                    inject: false,
                    minify: false
                }
            },
            publicPath: '/visiiime-design-dashboard/',

            outputDir: '../../public/visiiime-design-dashboard',

            indexPath: path.resolve(__dirname, '../views/components/theme/design.blade.php')

        }

    }

    return {


    }

}

// module.exports = {
//   pages: {
//     main: {
//         entry: 'src/main.js',
//         template: 'src/templates/main.ejs',
//         filename: path.resolve(__dirname, '../views/components/theme/main.blade.php'),
//         inject: false,
//         minify: false
//     }
//   },
//   publicPath: process.env.NODE_ENV === 'production'
//     ? '/visiiime-design-dashboard/'
//     : '/',

//   outputDir: '../../public/visiiime-design-dashboard',

//   indexPath: process.env.NODE_ENV === 'production'
//     ? path.resolve(__dirname, '../views/components/theme/design.blade.php')
//     : 'index.html'

// }
