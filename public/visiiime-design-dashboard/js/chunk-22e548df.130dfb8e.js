(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-22e548df"],{"56bd":function(t,n,i){"use strict";var s=i("5a2c"),e=i.n(s);i.d(n,"default",(function(){return e.a}))},"5a2c":function(t,n,i){t.exports={shake:"LinkDashboardStar_shake_3_GM7",bounce:"LinkDashboardStar_bounce_287-F",rubberBand:"LinkDashboardStar_rubberBand_2s6QC",pulse:"LinkDashboardStar_pulse_2B5TS",wobble:"LinkDashboardStar_wobble_1EfBZ","link-animation":"LinkDashboardStar_link-animation_jf1wX"}},b95b:function(t,n,i){"use strict";i.r(n);var s=function(){var t=this,n=t.$createElement,i=t._self._c||n;return i("div",{staticClass:"mb-3"},[i("div",{staticClass:"text-center bg-gray-500 text-white py-1"},[t._v("連結特效")]),i("div",{staticClass:"px-3 pt-6 pb-3 flex content-between"},[i("v-button",{staticClass:"rounded mr-2 border-2 px-4 py-2 text-center",class:t.noneBtnClass,attrs:{variant:"secondary"},on:{click:function(n){return t.setAnimation("")}}},[t._v("none")]),i("v-button",{staticClass:"rounded mr-2 border-2 px-4 py-2 text-center",class:t.bounceBtnClass,attrs:{variant:"secondary"},on:{click:function(n){return t.setAnimation("bounce")}}},[t._v("bounce")]),i("v-button",{staticClass:"rounded mr-2 border-2 px-4 py-2 text-center",class:t.shakeBtnClass,attrs:{variant:"secondary"},on:{click:function(n){return t.setAnimation("shake")}}},[t._v("shake")])],1),i("div",{staticClass:"px-3 pb-6 flex content-between"},[i("v-button",{staticClass:"rounded mr-2 border-2 px-4 py-2 text-center",class:t.pulseBtnClass,attrs:{variant:"secondary"},on:{click:function(n){return t.setAnimation("pulse")}}},[t._v("pulse")]),i("v-button",{staticClass:"rounded mr-2 border-2 px-4 py-2 text-center",class:t.rubberBandBtnClass,attrs:{variant:"secondary"},on:{click:function(n){return t.setAnimation("rubberBand")}}},[t._v("rubberBand")]),i("v-button",{staticClass:"rounded mr-2 border-2 px-4 py-2 text-center",class:t.wobbleBtnClass,attrs:{variant:"secondary"},on:{click:function(n){return t.setAnimation("wobble")}}},[t._v("wobble")])],1)])},e=[],a=(i("a9e3"),i("881a")),r={data:function(){return{}},props:{linkItem:{type:a["a"],required:!0},idx:{type:Number,required:!0}},computed:{linkAnimation:function(){return this.linkItem.linkCustomData.linkAnimation},noneBtnClass:function(){return[this.$style["link-animation"]]},bounceBtnClass:function(){return"bounce"===this.linkAnimation?[this.$style["link-animation"],this.$style["bounce"]]:[this.$style["link-animation"]]},shakeBtnClass:function(){return"shake"===this.linkAnimation?[this.$style["link-animation"],this.$style["shake"]]:[this.$style["link-animation"]]},pulseBtnClass:function(){return"pulse"===this.linkAnimation?[this.$style["link-animation"],this.$style["pulse"]]:[this.$style["link-animation"]]},rubberBandBtnClass:function(){return"rubberBand"===this.linkAnimation?[this.$style["link-animation"],this.$style["rubberBand"]]:[this.$style["link-animation"]]},wobbleBtnClass:function(){return"wobble"===this.linkAnimation?[this.$style["link-animation"],this.$style["wobble"]]:[this.$style["link-animation"]]}},methods:{setAnimation:function(t){this.linkItem.linkCustomData.linkAnimation=t}}},o=r,l=i("56bd"),u=i("2877");function c(t){this["$style"]=l["default"].locals||l["default"]}var b=Object(u["a"])(o,s,e,!1,c,null,null);n["default"]=b.exports}}]);
//# sourceMappingURL=chunk-22e548df.130dfb8e.js.map