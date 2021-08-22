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

const pageUriUpdate = data => {
    return request({
        url: 'api/v1/v-page/page-uri-update',
        method: "post",
        data
    })
}

const pageAnalysticUpdate = data => {
    return request({
        url: 'api/v1/v-page/page-analystic-update',
        method: "post",
        data
    })
}

const pageSeoUpdate = data => {
    return request({
        url: 'api/v1/v-page/page-seo-update',
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

const socialLinksUpdate = data => {
    return request({
        url: 'api/v1/v-page/social-links-update',
        method: "post",
        data
    })
}

const customDataUpdate = data => {
    return request({
        url: 'api/v1/v-page/custom-data-update',
        method: "post",
        data
    })
}

const layoutUpdate = data => {
    return request({
        url: 'api/v1/v-page/layout-update',
        method: "post",
        data
    })
}

export default {
    getPageContent,
    getPageDataOri,
    updatePageData,
    profileUpdate,
    socialLinksUpdate,
    layoutUpdate,
    customDataUpdate,
    pageUriUpdate,
    pageAnalysticUpdate,
    pageSeoUpdate
};
