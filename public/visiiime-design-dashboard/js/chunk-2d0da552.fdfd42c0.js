(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0da552"],{"6ac4":function(e,t,i){"use strict";i.r(t);var n=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"mb-3"},[i("div",{staticClass:"text-center bg-gray-500 text-white py-1"},[e._v("連結圖片")]),e.hasPermission?i("div",{staticClass:"p-5"},[""===e.linkItem.thumbnail||null===e.linkItem.thumbnail?[i("div",{staticClass:"flex text-center items-center justify-center"},[i("div",{staticClass:"btn btn-primary",on:{click:e.openUploadImageForm}},[e._v("上傳圖片")])])]:[i("div",{staticClass:"flex"},[i("div",{staticClass:"flex-grow pr-3 text-center flex flex-col justify-around items-stretch"},[i("div",{staticClass:"btn btn-primary",on:{click:e.openUploadImageForm}},[e._v("更換")]),i("div",{staticClass:"btn",on:{click:e.openRemoveConfirmForm}},[e._v("移除")])]),i("div",{},[i("div",{staticClass:"w-28 h-28 flex items-center justify-center"},[e.checkIsIcon(e.linkItem.thumbnail)?i("div",[i("vs-icon",{attrs:{"icon-name":""+(["",null].includes(e.linkItem.thumbnail)?"sr-link":e.linkItem.thumbnail),"svg-size":70}})],1):i("img",{attrs:{src:e.linkItem.thumbnail}})])])])]],2):i("div",{staticClass:"p-5"},[e._v(" You don't have the permission. ")]),i("upload-image-modal",{attrs:{"modal-name":e.modalName,"modal-title":"請上傳圖片",size:e.size,"model-id":e.$store.state.pageId,"model-name":"VPage","field-name":"linkItemImage",shape:"BIG"===e.linkItem.linkImgMode?"rect":"square"},on:{"update-image":e.updateImage}}),i("confirm-modal",{attrs:{"modal-name":e.confirmModalName},on:{confirm:e.removeImage}})],1)},a=[],l=(i("a9e3"),i("9c85")),m=i("1153"),o=i("4749"),s=i("e2d4"),d=i("881a"),c=i("4409"),r=i("b9ba"),u={components:{uploadImageModal:o["a"],ConfirmModal:s["a"],VsIcon:m["default"]},props:{linkItem:{type:d["a"],required:!0},idx:{type:Number,required:!0}},computed:{modalName:function(){return"linkItem"+this.linkItem.id},confirmModalName:function(){return"linkItemConfirm"+this.linkItem.id},hasPermission:function(){return this.$store.getters.hasPermission(c["d"])},linkItemThumbnail:function(){return-1!==this.linkItem.thumbnail.indexOf("cb-")?i("1c66")("./".concat(this.linkItem.thumbnail,".png")):this.linkItem.thumbnail},size:function(){return"BIG"===this.linkItem.linkImgMode?500:65}},methods:{openUploadImageForm:function(){this.$modal.show("ImageTypeSelectModal",{linkItemId:this.linkItem.id,svgType:"BIG"!==this.linkItem.linkImgMode,iconType:"BIG"!==this.linkItem.linkImgMode})},updateImage:function(e){var t=this;l["a"].linkItemUpdate({id:this.linkItem.id,field:"thumbnail",data:e}).then((function(i){t.$modal.show("result-modal",{header:"上傳成功"}),t.linkItem.thumbnail=e})).catch((function(e){console.log(e),t.$modal.show("result-modal",{header:"發生錯誤"})}))},openRemoveConfirmForm:function(){this.$modal.show(this.confirmModalName,{header:"刪除圖片",content:"您確定要刪除嗎？ 此動作無法復原。"})},removeImage:function(){var e=this;l["a"].linkItemUpdate({id:this.linkItem.id,field:"thumbnail",data:""}).then((function(t){e.$modal.show("result-modal",{header:"刪除成功"}),e.linkItem.thumbnail=""})).catch((function(t){console.log(t),e.$modal.show("result-modal",{header:"發生錯誤"})}))},checkIsIcon:function(e){return Object(r["a"])(e)}}},h=u,I=i("2877"),f=Object(I["a"])(h,n,a,!1,null,"3225a34d",null);t["default"]=f.exports}}]);
//# sourceMappingURL=chunk-2d0da552.fdfd42c0.js.map