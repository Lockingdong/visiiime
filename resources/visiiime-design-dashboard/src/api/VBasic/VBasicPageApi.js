import request from '@/helper/request'

const getPageContent = (data) => {
  return request({
    url: '/VBasic/VBasicPage1.json',
    method: 'get',
    data
  })
}

export default {
  getPageContent
}
