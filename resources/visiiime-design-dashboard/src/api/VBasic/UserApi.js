import request from "@/helper/request";

const logoutUser = () => {
    return request({
        url: `api/v1/user/logout`,
        method: "post",
    })
}

export default {
    logoutUser,
};
