import request from '@/helper/request'

async function getAvailableLayouts(data) {
  return {
    data: [
      {
        layoutId: 'layout1',
        layoutName: 'leaf',
        layoutImage: '/VBasic/leaf.png',
      },
      {
        layoutId: 'layout2',
        layoutName: 'snow',
        layoutImage: '/VBasic/snow.png',
      },
       {
        layoutId: 'layout3',
        layoutName: 'fantastic',
        layoutImage: '/VBasic/gradient-1.png',
      },
      {
        layoutId: 'layout4',
        layoutName: 'lemon',
        layoutImage: '/VBasic/gradient-2.png',
      },
      {
        layoutId: 'layout5',
        layoutName: 'sunset',
        layoutImage: '/VBasic/gradient-3.png',
      },
        {
        layoutId: 'layout6',
        layoutName: 'purple',
        layoutImage: '/VBasic/purple.png',
      },
       {
        layoutId: 'layout7',
        layoutName: 'gray',
        layoutImage: '/VBasic/gray.png',
      },
       {
        layoutId: 'layout8',
        layoutName: 'young',
        layoutImage: '/VBasic/greenBg.png',
      },
      {
        layoutId: 'layout9',
        layoutName: 'ocean',
        layoutImage: '/VBasic/blueBtn.png',
      },
       {
        layoutId: 'layout10',
        layoutName: 'violet',
        layoutImage: '/VBasic/purpleBtn.png',
      },
    ]
  }
}

export default getAvailableLayouts