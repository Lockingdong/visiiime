import request from "@/helper/request";

const linkItemCreate = data => {
    return request({
        url: 'api/v1/v-basic-link-item/link-item-create',
        method: "post",
        data
    })
}

const linkItemDelete = data => {
    return request({
        url: 'api/v1/v-basic-link-item/link-item-delete',
        method: "post",
        data
    })
}

const linkItemUpdate = data => {
    return request({
        url: 'api/v1/v-basic-link-item/link-item-update',
        method: "post",
        data
    })
}

const linkItemStartEndTimeUpdate = data => {
    return request({
        url: 'api/v1/v-basic-link-item/link-item-start-end-time-update',
        method: "post",
        data
    })
}

const linkItemDisplayUpdate = data => {
    return request({
        url: 'api/v1/v-basic-link-item/link-item-display-update',
        method: "post",
        data
    })
}

const linkItemsUpdate = data => {
    return request({
        url: 'api/v1/v-basic-link-item/link-items-update',
        method: "post",
        data
    })
}

export default {
    linkItemCreate,
    linkItemDelete,
    linkItemUpdate,
    linkItemsUpdate,
    linkItemStartEndTimeUpdate,
    linkItemDisplayUpdate
};
