(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0d05f7"],{6865:function(e,t,n){"use strict";n.r(t);var i=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-ob",{ref:"vob",staticClass:"p-2",attrs:{tag:"div"}},[n("span",{directives:[{name:"show",rawName:"v-show",value:null!==e.linkItem.mediaName&&""!==e.linkItem.mediaName,expression:"linkItem.mediaName !== null && linkItem.mediaName !== ''"}],staticClass:"badge badge-success text-xs mt-1 mr-1 mb-1"},[e._v("偵測為 "+e._s(e.linkItem.mediaName)+" 連結")]),n("div",{staticClass:"flex justify-center align-middle mb-3"},[n("svg",{staticClass:"mr-1 h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"}},[n("path",{attrs:{d:"M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"}})]),n("v-p",{staticClass:"form-control w-full",attrs:{rules:"required",name:"連結名稱",tag:"div"},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.errors;return[n("input",{directives:[{name:"model",rawName:"v-model",value:e.linkItem.linkName,expression:"linkItem.linkName"}],staticClass:"input input-sm input-bordered",class:{"input-error":0!==i.length},attrs:{disabled:e.linkItem.online,type:"text",autocomplete:"off",placeholder:"連結名稱"},domProps:{value:e.linkItem.linkName},on:{input:function(t){t.target.composing||e.$set(e.linkItem,"linkName",t.target.value)}}}),n("div",[n("span",{directives:[{name:"show",rawName:"v-show",value:i.length,expression:"errors.length"}],staticClass:"badge badge-error mt-1 mr-1"},[e._v(e._s(i[0]))])])]}}])})],1),n("div",{staticClass:"flex justify-center align-middle mb-3"},[n("svg",{staticClass:"mr-1 h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor"}},[n("path",{attrs:{"fill-rule":"evenodd",d:"M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z","clip-rule":"evenodd"}})]),n("v-p",{staticClass:"form-control w-full",attrs:{rules:"required|url",name:"網址",tag:"div"},scopedSlots:e._u([{key:"default",fn:function(t){var i=t.errors;return[n("input",{directives:[{name:"model",rawName:"v-model.lazy",value:e.linkItem.link,expression:"linkItem.link",modifiers:{lazy:!0}}],staticClass:"input input-sm input-bordered",class:{"input-error":0!==i.length},attrs:{disabled:e.linkItem.online,type:"text",autocomplete:"off",placeholder:"https://www.example.com",required:""},domProps:{value:e.linkItem.link},on:{blur:function(t){return e.updateLink()},change:function(t){return e.$set(e.linkItem,"link",t.target.value)}}}),n("div",[n("span",{directives:[{name:"show",rawName:"v-show",value:i.length,expression:"errors.length"}],staticClass:"badge badge-error mt-1 mr-1"},[e._v(e._s(i[0]))])])]}}])})],1),e.linkItem.linkType===e.linkTypeEnum.media?n("div",[n("label",{staticClass:"inline-flex items-center"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.linkItem.mediaOpenType,expression:"linkItem.mediaOpenType"}],staticClass:"form-radio radio-xs radio radio-primary",attrs:{disabled:e.linkItem.online,value:"EXT",type:"radio"},domProps:{checked:e._q(e.linkItem.mediaOpenType,"EXT")},on:{change:function(t){return e.$set(e.linkItem,"mediaOpenType","EXT")}}}),n("span",{staticClass:"ml-2 text-xs"},[e._v("外部連結")])]),n("label",{staticClass:"inline-flex items-center ml-6"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.linkItem.mediaOpenType,expression:"linkItem.mediaOpenType"}],staticClass:"form-radio radio-xs radio radio-primary",attrs:{disabled:e.linkItem.online,value:"INR",type:"radio"},domProps:{checked:e._q(e.linkItem.mediaOpenType,"INR")},on:{change:function(t){return e.$set(e.linkItem,"mediaOpenType","INR")}}}),n("span",{staticClass:"ml-2 text-xs"},[e._v("內嵌式開啟")])])]):e._e()])},a=[],l=n("1da1"),r=(n("96cf"),n("a9e3"),n("9911"),n("caad"),n("2532"),n("881a")),s=n("4409"),m=n("7bb1"),o=n("2f2a"),d=n("5aea"),u={components:{VP:m["b"]},data:function(){return{linkTypeEnum:d["b"],linkAreaEnum:d["a"],mediaOpenTypeEnum:d["c"],allowedMedia:["YouTube","SoundCloud","Spotify"]}},props:{linkItem:{type:r["a"],required:!0},idx:{type:Number,required:!0},online:{type:Boolean,required:!0}},computed:{modalName:function(){return"linkItem"+this.idx}},methods:{validate:function(){var e=this;return Object(l["a"])(regeneratorRuntime.mark((function t(){var n,i;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,e.$store.getters.hasPermission(s["i"]);case 2:if(n=t.sent,n){t.next=7;break}return e.linkItem.online=!1,e.$emit("setParentOnline",!1),t.abrupt("return");case 7:return t.next=9,e.$refs.vob.validate();case 9:i=t.sent,i?(e.linkItem.valid=!0,e.linkItem.online=!0,e.$emit("setParentOnline",!0)):(e.linkItem.online=!1,e.linkItem.valid=!1,e.$emit("setParentOnline",!1));case 11:case"end":return t.stop()}}),t)})))()},updateLink:function(){var e=this;return Object(l["a"])(regeneratorRuntime.mark((function t(){var n;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,Object(o["a"])(e.linkItem.link);case 2:n=t.sent,console.log(n),null!==n&&e.allowedMedia.includes(n.provider_name)?(e.linkItem.linkType=e.linkTypeEnum.media,e.linkItem.mediaName=n.provider_name):(e.linkItem.linkType=e.linkTypeEnum.normal,e.linkItem.mediaOpenType=d["c"].ext,e.linkItem.mediaName=null);case 5:case"end":return t.stop()}}),t)})))()},updateImage:function(e){this.linkItem.thumbnail=e}},watch:{online:function(e,t){e?this.validate():this.linkItem.online=!1}},mounted:function(){this.linkItem.online&&this.validate()}},c=u,p=n("2877"),k=Object(p["a"])(c,i,a,!1,null,"6fd2c052",null);t["default"]=k.exports}}]);
//# sourceMappingURL=chunk-2d0d05f7.c010b6fd.js.map