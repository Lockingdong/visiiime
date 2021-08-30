import request from "@/helper/request";

const imageUpload = (data) => {
    return request({
        url: "/api/v1/v-file/image-upload",
        method: "post",
        data,
    });
};

export { imageUpload };
