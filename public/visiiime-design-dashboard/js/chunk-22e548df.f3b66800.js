(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-22e548df"],{"56bd":function(t,n,i){"use strict";var s=i("5a2c"),a=i.n(s);i.d(n,"default",(function(){return a.a}))},"5a2c":function(t,n,i){t.exports={shake:"LinkDashboardStar_shake_3_GM7",bounce:"LinkDashboardStar_bounce_287-F",rubberBand:"LinkDashboardStar_rubberBand_2s6QC",pulse:"LinkDashboardStar_pulse_2B5TS",wobble:"LinkDashboardStar_wobble_1EfBZ","link-animation":"LinkDashboardStar_link-animation_jf1wX"}},b95b:function(t,n,i){"use strict";i.r(n);var s=function(){var t=this,n=t.$createElement,i=t._self._c||n;return i("div",{staticClass:"mb-3"},[i("div",{staticClass:"text-center bg-gray-500 text-white py-1"},[t._v("連結特效")]),t.hasPermission?i("div",{staticClass:"p-5"},[i("div",{staticClass:"grid grid-cols-3 gap-4"},[i("button",{staticClass:"btn",class:t.noneBtnClass,on:{click:function(n){return t.setAnimation("")}}},[t._v("無")]),i("button",{staticClass:"btn",class:t.bounceBtnClass,on:{click:function(n){return t.setAnimation("bounce")}}},[t._v("bounce")]),i("button",{staticClass:"btn",class:t.shakeBtnClass,on:{click:function(n){return t.setAnimation("shake")}}},[t._v("shake")]),i("button",{staticClass:"btn",class:t.pulseBtnClass,on:{click:function(n){return t.setAnimation("pulse")}}},[t._v("pulse")]),i("button",{staticClass:"btn",class:t.rubberBandBtnClass,on:{click:function(n){return t.setAnimation("rubberBand")}}},[t._v("rubberBand")]),i("button",{staticClass:"btn",class:t.wobbleBtnClass,on:{click:function(n){return t.setAnimation("wobble")}}},[t._v("wobble")])]),i("div",{staticClass:"flex justify-center mt-3"},[i("button",{directives:[{name:"show",rawName:"v-show",value:t.showSaveBtn,expression:"showSaveBtn"}],staticClass:"btn btn-primary",on:{click:t.updateAnimation}},[t._v("儲存")])])]):i("div",{staticClass:"p-5"},[t._v(" You don't have the permission. ")])])},a=[],e=(i("a9e3"),i("881a")),o=i("9c85"),l=i("4409"),u={data:function(){return{showSaveBtn:!1}},props:{linkItem:{type:e["a"],required:!0},idx:{type:Number,required:!0}},computed:{hasPermission:function(){return this.$store.getters.hasPermission(l["f"])},linkAnimation:function(){return this.linkItem.linkCustomData.linkAnimation},noneBtnClass:function(){return""===this.linkAnimation?[this.$style["link-animation"]]:[this.$style["link-animation"],"btn-outline"]},bounceBtnClass:function(){return"bounce"===this.linkAnimation?[this.$style["link-animation"],this.$style["bounce"]]:[this.$style["link-animation"],"btn-outline"]},shakeBtnClass:function(){return"shake"===this.linkAnimation?[this.$style["link-animation"],this.$style["shake"]]:[this.$style["link-animation"],"btn-outline"]},pulseBtnClass:function(){return"pulse"===this.linkAnimation?[this.$style["link-animation"],this.$style["pulse"]]:[this.$style["link-animation"],"btn-outline"]},rubberBandBtnClass:function(){return"rubberBand"===this.linkAnimation?[this.$style["link-animation"],this.$style["rubberBand"]]:[this.$style["link-animation"],"btn-outline"]},wobbleBtnClass:function(){return"wobble"===this.linkAnimation?[this.$style["link-animation"],this.$style["wobble"]]:[this.$style["link-animation"],"btn-outline"]}},methods:{setAnimation:function(t){this.linkItem.linkCustomData.linkAnimation=t},updateAnimation:function(){var t=this;o["a"].linkItemUpdate({id:this.linkItem.id,field:"link_custom_data",data:this.linkItem.linkCustomData}).then((function(n){t.$modal.show("result-modal",{header:"更新成功"}),t.showSaveBtn=!1})).catch((function(n){console.log(n),t.$modal.show("result-modal",{header:"發生錯誤"})}))}},mounted:function(){var t=this;this.$watch("linkAnimation",(function(){t.showSaveBtn=!0}))}},r=u,c=i("56bd"),b=i("2877");function h(t){this["$style"]=c["default"].locals||c["default"]}var m=Object(b["a"])(r,s,a,!1,h,null,null);n["default"]=m.exports}}]);
//# sourceMappingURL=chunk-22e548df.f3b66800.js.map