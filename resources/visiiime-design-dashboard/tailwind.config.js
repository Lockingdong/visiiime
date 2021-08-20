const colors = require('tailwindcss/colors');
module.exports = {
  purge: {
    mode: 'layers',
    content: [
      './public/**/*.html',
      './src/**/*.vue'
    ]
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        emarald: colors.emarald,
        gray: colors.trueGray
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('daisyui'),
  ],
  daisyui: {
    styled: true,
    themes: [
        'light'
    ],
    base: true,
    utils: true,
    logs: true,
    rtl: false,
  },
  css: {
    requireModuleExtension: false,
    loaderOptions: {
      css: {
        // 注意：以下配置在 Vue CLI v4 与 v3 之间存在差异。
        // Vue CLI v3 用户可参考 css-loader v1 文档
        // https://github.com/webpack-contrib/css-loader/tree/v1.0.1
        modules: {
          localIdentName: '[name]__[local]__[hash:base64:5]'
        },

      }
    }
  },
}
