import Vue from 'vue'
import VueRouter from 'vue-router'

import VBasicRoot from '../views/VBasic/VBasicRoot.vue'
import VBasicEdit from '../views/VBasic/VBasicEdit'
import VBasicLayout from '../views/VBasic/VBasicLayout'
import VBasicPreview from '../views/VBasic/VBasicPreview'

import Global from '../views/template/Global'
import VBasic from '../views/template/VBasic'




// import About from '@/views/About'

Vue.use(VueRouter)

// console.log(process.env)

let themeName = window.themeName || 'VBasic';

let routeComponent = {}
if(themeName === 'VBasic') {
  routeComponent.root = VBasicRoot;
  routeComponent.edit = VBasicEdit;
  routeComponent.layout = VBasicLayout;
  routeComponent.preview = VBasicPreview;
}


const routes = [
  {
    path: '/',
    name: '',
    component: routeComponent.root,
    redirect: '/edit',
    children: [
      {
        path: 'edit',
        name: 'VEdit',
        component: routeComponent.edit
      },
      {
        path: 'layout',
        name: 'VLayout',
        component: routeComponent.layout
      },
    ]
  },
  {
    path: '/VPreview',
    name: 'VPreview',
    component: routeComponent.preview
  },
  {
    path: '/template',
    name: 'template',
    component: Global,
    children: [
      {
        path: 'VBasic',
        name: 'VBasic',
        component: VBasic
      },
    ]
  }
]

const router = new VueRouter({
  routes
})

export default router
