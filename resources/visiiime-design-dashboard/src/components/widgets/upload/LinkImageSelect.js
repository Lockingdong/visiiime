const req = require.context('../../../assets/icons/png/color/brand', false, /\.png$/)
const requireAll = requireContext => requireContext.keys()

const re = /\.\/(.*)\.png/

const pngIcons = requireAll(req).map(item => {
  return item.match(re)[1]
})

export default pngIcons
