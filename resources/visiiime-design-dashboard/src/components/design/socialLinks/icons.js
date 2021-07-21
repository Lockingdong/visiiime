const req = require.context('../../../assets/icons/svg/solid/brand', false, /\.svg$/)
const requireAll = requireContext => requireContext.keys()

const re = /\.\/(.*)\.svg/

const svgIcons = requireAll(req).map(item => {
  return item.match(re)[1]
})

export default svgIcons
