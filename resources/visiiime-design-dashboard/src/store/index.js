import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        pageOriApiLoaded: false,
        pageId: ''
    },
    mutations: {
        setPageOriApiLoaded(state) {
            state.pageOriApiLoaded = true
        },
        setPageId(state, pageId) {
            state.pageId = pageId
        }
    }
})

export default store
