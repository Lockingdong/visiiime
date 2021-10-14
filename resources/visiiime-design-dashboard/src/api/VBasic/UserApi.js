import request from "@/helper/request";

const logoutUser = () => {
    return request({
        url: `api/v1/user/logout`,
        method: "post",
    })
}

const verifyEmail = data => {
    return request({
        url: `api/v1/user/verify-email`,
        method: "post",
        data
    })
}

export default {
    logoutUser,
    verifyEmail
};
