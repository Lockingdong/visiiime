import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        pageId: ''
    },
    mutations: {
        setPageId(state, pageId) {
            state.pageId = pageId
        }
    }
})

export default store
