const linkType = {
    normal: 'NORMAL',
    main: 'MAIN',
    media: 'MEDIA',
    collector: 'COLLECT',
    social: 'SOCIAL',
    title: 'TITLE'
};

const mediaOpenType = {
    ext: 'EXT', // 外部連結
    inr: 'INR' // 內部開啟
}

const linkArea = {
    main: 'main',
    normal: 'normal',
    social: 'social'
}

const linkEvent = {
    click: 'LINK_CLICK',
    pageView: 'PAGE_VIEW'
}

const modelName = {
    vPage: 'V_PAGE',
    vlinkItem: 'V_LINK_ITEM',
    vlinkItemMain: 'V_LINK_ITEM_MAIN'
}

export {
    linkType,
    mediaOpenType,
    linkArea,
    linkEvent,
    modelName
}
