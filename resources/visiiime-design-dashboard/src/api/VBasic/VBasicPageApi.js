import request from "@/helper/request";




const getPageContent = data => {
    return request({
        url: "/VBasic/VBasicPage1.json",
        method: "get",
        data
    });
};

const getPageDataOri = pageId => {
    return request({
        url: `api/v1/v-page/ori/${pageId}`,
        method: "get",
    })
}

const updatePageData = data => {
    return request({
        url: 'api/v1/v-page/update-page-data',
        method: "post",
        data
    })
}

const profileUpdate = data => {
    return request({
        url: 'api/v1/v-page/profile-update',
        method: "post",
        data
    })
}

export default {
    getPageContent,
    getPageDataOri,
    updatePageData,
    profileUpdate
};
