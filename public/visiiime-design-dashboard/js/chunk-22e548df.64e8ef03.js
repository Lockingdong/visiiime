(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-22e548df"],{"56bd":function(n,t,i){"use strict";var e=i("5a2c"),a=i.n(e);i.d(t,"default",(function(){return a.a}))},"5a2c":function(n,t,i){n.exports={shake:"LinkDashboardStar_shake_3_GM7",bounce:"LinkDashboardStar_bounce_287-F","link-animation":"LinkDashboardStar_link-animation_jf1wX"}},b95b:function(n,t,i){"use strict";i.r(t);var e=function(){var n=this,t=n.$createElement,i=n._self._c||t;return i("div",{staticClass:"mb-3"},[i("div",{staticClass:"text-center bg-gray-500 text-white py-1"},[n._v("star")]),i("div",{staticClass:"px-3 py-6 flex flex-wrap"},[i("div",{staticClass:"rounded mr-2 border-2 px-4 py-2 text-center",class:n.noneBtnClass,on:{click:function(t){return n.setAnimation("")}}},[n._v("none")]),i("div",{staticClass:"rounded mr-2 border-2 px-4 py-2 text-center",class:n.bounceBtnClass,on:{click:function(t){return n.setAnimation("bounce")}}},[n._v("bounce")]),i("div",{staticClass:"rounded mr-2 border-2 px-4 py-2 text-center",class:n.shakeBtnClass,on:{click:function(t){return n.setAnimation("shake")}}},[n._v("shake")])])])},a=[],s=(i("a9e3"),i("881a")),o={data:function(){return{}},props:{linkItem:{type:s["a"],required:!0},idx:{type:Number,required:!0}},computed:{linkAnimation:function(){return this.linkItem.linkCustomData.linkAnimation},noneBtnClass:function(){return[this.$style["link-animation"]]},bounceBtnClass:function(){return"bounce"===this.linkAnimation?[this.$style["link-animation"],this.$style["bounce"]]:[this.$style["link-animation"]]},shakeBtnClass:function(){return"shake"===this.linkAnimation?[this.$style["link-animation"],this.$style["shake"]]:[this.$style["link-animation"]]}},methods:{setAnimation:function(n){this.linkItem.linkCustomData.linkAnimation=n}}},r=o,l=i("56bd"),c=i("2877");function u(n){this["$style"]=l["default"].locals||l["default"]}var d=Object(c["a"])(r,e,a,!1,u,null,null);t["default"]=d.exports}}]);
//# sourceMappingURL=chunk-22e548df.64e8ef03.js.map