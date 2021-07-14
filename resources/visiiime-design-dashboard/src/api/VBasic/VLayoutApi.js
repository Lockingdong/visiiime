import request from "@/helper/request";

const getAvailableLayouts = themeName => {
    return request({
        url: `api/v1/v-layouts/${themeName}`,
        method: "get",
    })
}

export default {
    getAvailableLayouts,
};
