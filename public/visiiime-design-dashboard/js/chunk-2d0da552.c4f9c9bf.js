(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0da552"],{"6ac4":function(e,t,a){"use strict";a.r(t);var i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"mb-3"},[a("div",{staticClass:"text-center bg-gray-500 text-white py-1"},[e._v("add thumbnail")]),a("div",{staticClass:"p-5"},[""===e.linkItem.thumbnail||null===e.linkItem.thumbnail?[a("div",{staticClass:"flex text-center items-center justify-center"},[a("div",{staticClass:"px-8 py-3 bg-indigo-500 text-white rounded-lg cursor-pointer",on:{click:e.openUploadImageForm}},[e._v("add picture")])])]:[a("div",{staticClass:"flex"},[a("div",{staticClass:"flex-grow pr-3 text-center flex flex-col justify-around items-stretch"},[a("div",{staticClass:"px-8 py-2 bg-indigo-500 text-white rounded-lg cursor-pointer",on:{click:e.openUploadImageForm}},[e._v("replace")]),a("div",{staticClass:"px-8 py-2 bg-gray-400 text-white rounded-lg cursor-pointer",on:{click:e.removeImage}},[e._v("remove")])]),a("div",{staticClass:"bg-cover bg-center w-28 h-28",style:{backgroundImage:"url("+e.linkItem.thumbnail+")"}})])]],2),a("upload-image-modal",{attrs:{"modal-name":e.modalName,"modal-title":"請上傳圖片","emit-function":"update-image"},on:{"update-image":e.updateImage}})],1)},n=[],l=(a("a9e3"),a("4749")),o=a("881a"),s={components:{uploadImageModal:l["a"]},props:{linkItem:{type:o["a"],required:!0},idx:{type:Number,required:!0}},computed:{modalName:function(){return"linkItem"+this.idx}},methods:{openUploadImageForm:function(){this.$modal.show(this.modalName)},updateImage:function(e){this.linkItem.thumbnail=e},removeImage:function(){this.linkItem.thumbnail=""}}},d=s,r=a("2877"),m=Object(r["a"])(d,i,n,!1,null,"8d650c52",null);t["default"]=m.exports}}]);
//# sourceMappingURL=chunk-2d0da552.c4f9c9bf.js.map