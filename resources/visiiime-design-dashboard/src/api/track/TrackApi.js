import request from "../../helper/request";

const getWeekData = data => {
    return request({
        url: `api/v1/v-event-track/get-week-data`,
        method: "post",
        data
    })
}

const eventCreate = data => {
    return request({
        url: `api/v1/v-event-track/event-create`,
        method: "post",
        data
    })
}

export default {
    getWeekData,
    eventCreate
};
