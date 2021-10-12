import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        pageOriApiLoaded: false,
        pageId: '',
        pageUrl: '',
        permissions: [
        ],
        online: false,
    },
    getters: {
        hasPermission: (state) => (permission) => {
            return state.permissions.find(pm => pm === permission) !== undefined;
        }
    },
    mutations: {
        setPageOriApiLoaded(state) {
            state.pageOriApiLoaded = true
        },
        setPageId(state, pageId) {
            state.pageId = pageId
        },
        setPageUrl(state, pageUrl) {
            state.pageUrl = pageUrl
        },
        setPermissions(state, permissions) {
            state.permissions = permissions
        },
        setOnline(state, bool) {
            state.online = bool
        }
    }
})

export default store
