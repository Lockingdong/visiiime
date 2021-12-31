const req = require.context('./', false, /\.js$/)
const requireAll = requireContext => requireContext.keys()

const re = /\.\/(.*)\.js/

const layouts = requireAll(req).map(item => {
  return item.match(re)[1]
})

const filteredLayouts = layouts.filter(file => file !== 'index')


export default filteredLayouts