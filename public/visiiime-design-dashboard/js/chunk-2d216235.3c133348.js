(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d216235"],{c0d6:function(e,t,a){"use strict";a.r(t);var l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-ob",{ref:"vob",staticClass:"p-2",attrs:{tag:"div"}},[a("div",{staticClass:"mb-3 flex items-center text-gray-600"},[a("fai",{staticClass:"fill-current",attrs:{icon:["fa","photo-video"]}}),a("select",{directives:[{name:"model",rawName:"v-model",value:e.linkItem.mediaName,expression:"linkItem.mediaName"}],staticClass:"w-full p-2 text-sm",attrs:{disabled:e.linkItem.online},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){var t="_value"in e?e._value:e.value;return t}));e.$set(e.linkItem,"mediaName",t.target.multiple?a:a[0])}}},[a("option",{attrs:{value:"youtube"}},[e._v("youtube")]),a("option",{attrs:{value:"spotify"}},[e._v("spotify")]),a("option",{attrs:{value:"appleP"}},[e._v("apple podcasts")]),a("option",{attrs:{value:"soundCld"}},[e._v("soundcloud")])])],1),a("div",{staticClass:"flex justify-center align-middle"},[a("svg",{staticClass:"h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"}},[a("path",{attrs:{d:"M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"}})]),a("v-p",{staticClass:"w-full",attrs:{rules:"required",name:"連結名稱",tag:"div"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.errors;return[a("input",{directives:[{name:"model",rawName:"v-model",value:e.linkItem.linkName,expression:"linkItem.linkName"}],staticClass:"w-full text-xs p-2 focus:border-red-100 outline-none",attrs:{disabled:e.linkItem.online,type:"text",autocomplete:"off",placeholder:"連結名稱",required:""},domProps:{value:e.linkItem.linkName},on:{blur:e.validate,input:function(t){t.target.composing||e.$set(e.linkItem,"linkName",t.target.value)}}}),a("div",{staticClass:"mb-5 w-full text-red-500 text-xs"},[e._v(e._s(l[0]))])]}}])})],1),a("div",{staticClass:"flex justify-center align-middle mb-2"},[a("svg",{staticClass:"h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"}},[a("path",{attrs:{"fill-rule":"evenodd",d:"M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z","clip-rule":"evenodd"}})]),a("v-p",{staticClass:"w-full",attrs:{rules:"required|"+e.mediaRule,name:"網址",tag:"div"},scopedSlots:e._u([{key:"default",fn:function(t){var l=t.errors;return[a("input",{directives:[{name:"model",rawName:"v-model",value:e.linkItem.link,expression:"linkItem.link"}],staticClass:"mb-0 w-full text-xs p-2 focus:border-red-100 outline-none",attrs:{disabled:e.linkItem.online,type:"text",autocomplete:"off",placeholder:"https://www.example.com",required:""},domProps:{value:e.linkItem.link},on:{blur:e.validate,input:function(t){t.target.composing||e.$set(e.linkItem,"link",t.target.value)}}}),a("div",{staticClass:"w-full text-red-500 text-xs"},[e._v(e._s(l[0]))])]}}])})],1),a("label",{staticClass:"inline-flex items-center"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.linkItem.mediaOpenType,expression:"linkItem.mediaOpenType"}],staticClass:"form-radio",attrs:{value:"EXT",type:"radio"},domProps:{checked:e._q(e.linkItem.mediaOpenType,"EXT")},on:{change:function(t){return e.$set(e.linkItem,"mediaOpenType","EXT")}}}),a("span",{staticClass:"ml-2"},[e._v("外部連結")])]),a("label",{staticClass:"inline-flex items-center ml-6"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.linkItem.mediaOpenType,expression:"linkItem.mediaOpenType"}],staticClass:"form-radio",attrs:{value:"INR",type:"radio"},domProps:{checked:e._q(e.linkItem.mediaOpenType,"INR")},on:{change:function(t){return e.$set(e.linkItem,"mediaOpenType","INR")}}}),a("span",{staticClass:"ml-2"},[e._v("內部開啟")])])])},i=[],n=a("1da1"),s=(a("96cf"),a("a9e3"),a("881a")),r=a("7bb1"),o={components:{VP:r["b"]},props:{linkItem:{type:s["a"],required:!0},idx:{type:Number,required:!0}},computed:{modalName:function(){return"linkItem"+this.idx},mediaRule:function(){var e="";switch(this.linkItem.mediaName){case"spotify":e="spotifyUrl";break;case"appleP":e="applePUrl";break;case"soundCld":e="soundCldUrl";break;default:e="youtubeUrl";break}return e}},methods:{validate:function(){var e=this;return Object(n["a"])(regeneratorRuntime.mark((function t(){var a;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,e.$refs.vob.validate();case 2:a=t.sent,a?e.linkItem.valid=!0:(e.linkItem.online=!1,e.linkItem.valid=!1);case 4:case"end":return t.stop()}}),t)})))()},updateImage:function(e){this.linkItem.thumbnail=e},openUploadImageForm:function(){this.$modal.show(this.modalName)}},watch:{"linkItem.online":function(){this.validate()}},mounted:function(){this.validate()}},m=o,u=a("2877"),d=Object(u["a"])(m,l,i,!1,null,"5ceb4ddc",null);t["default"]=d.exports}}]);
//# sourceMappingURL=chunk-2d216235.3c133348.js.map