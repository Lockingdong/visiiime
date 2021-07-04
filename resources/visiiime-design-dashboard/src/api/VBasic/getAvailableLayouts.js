import request from '@/helper/request'

async function getAvailableLayouts(data) {

  let baseUrl = process.env.VUE_APP_URL;

  return {
    data: [
      {
        layoutId: 'layout1',
        layoutName: 'leaf',
        layoutImage: baseUrl + '/VBasic/leaf.png',
      },
      {
        layoutId: 'layout2',
        layoutName: 'snow',
        layoutImage: baseUrl + '/VBasic/snow.png',
      },
       {
        layoutId: 'layout3',
        layoutName: 'fantastic',
        layoutImage: baseUrl + '/VBasic/gradient-1.png',
      },
      {
        layoutId: 'layout4',
        layoutName: 'lemon',
        layoutImage: baseUrl + '/VBasic/gradient-2.png',
      },
      {
        layoutId: 'layout5',
        layoutName: 'sunset',
        layoutImage: baseUrl + '/VBasic/gradient-3.png',
      },
        {
        layoutId: 'layout6',
        layoutName: 'purple',
        layoutImage: baseUrl + '/VBasic/purple.png',
      },
       {
        layoutId: 'layout7',
        layoutName: 'gray',
        layoutImage: baseUrl + '/VBasic/gray.png',
      },
       {
        layoutId: 'layout8',
        layoutName: 'young',
        layoutImage: baseUrl + '/VBasic/greenBg.png',
      },
      {
        layoutId: 'layout9',
        layoutName: 'ocean',
        layoutImage: baseUrl + '/VBasic/blueBtn.png',
      },
       {
        layoutId: 'layout10',
        layoutName: 'violet',
        layoutImage: baseUrl + '/VBasic/purpleBtn.png',
      },
    ]
  }
}

export default getAvailableLayouts
