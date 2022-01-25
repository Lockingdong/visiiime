import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        pageOriApiLoaded: false,
        pageId: '',
        pageUrl: '',
        permissions: {},
        online: false,
        userVerified: false,
        isAdmin: false,
        userRole: 'VIP',
        pageDefault: 'Y'
    },
    getters: {
        hasPermission: (state) => (permission) => {
            return Object.keys(state.permissions).find(pm => pm === permission) !== undefined;
        },
        getPermission: (state) => (permission) => {
            return state.permissions[permission];
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
        setPageDefault(state, pageDefault) {
            state.pageDefault = pageDefault
        },
        setPermissions(state, permissions) {
            state.permissions = permissions
        },
        setOnline(state, bool) {
            state.online = bool
        },
        setUserVerified(state, bool) {
            state.userVerified = bool
        },
        setIsAdmin(state, bool) {
            state.isAdmin = bool
        },
        setUserRole(state, role) {
            state.userRole = role
        }

    }
})

export default store
