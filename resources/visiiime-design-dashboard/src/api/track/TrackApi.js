import request from "../../helper/request";
import { baseTrackerUrl } from '../../helper/env';

const getWeekData = data => {
    return request({
        url: `api/v1/v-event-track/get-week-data`,
        method: "post",
        data,
        baseURL: baseTrackerUrl()
    })
}

const getEventData = data => {
    return request({
        url: `api/v1/v-event-track/event-get`,
        method: 'post',
        data,
        baseURL: baseTrackerUrl()
    })
}

const eventCreate = data => {
    return request({
        url: `api/v1/v-event-track/event-create`,
        method: "post",
        data,
        baseURL: baseTrackerUrl()
    })
}

export default {
    getWeekData,
    eventCreate,
    getEventData
};
