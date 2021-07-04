import request from '@/helper/request'

const imageUpload = (data) => {
  return request({
    url: 'https://administrator.dongstudio.live/v1/upload_image/visiiime/visiiime',
    method: 'post',
    data
  })
}

export {
  imageUpload
}