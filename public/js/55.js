(self.webpackChunk=self.webpackChunk||[]).push([[55],{3115:(a,t,e)=>{"use strict";e.d(t,{tG:()=>i,YM:()=>n});var i=function(a,t){var e=!1;"#"==a[0]&&(a=a.slice(1),e=!0);var i=parseInt(a,16),n=(i>>16)+t;n>255?n=255:n<0&&(n=0);var o=(i>>8&255)+t;o>255?o=255:o<0&&(o=0);var r=(255&i)+t;return r>255?r=255:r<0&&(r=0),(e?"#":"")+(r|o<<8|n<<16).toString(16)};function n(a){var t=0,e=0,i=0;4==a.length?(t="0x"+a[1]+a[1],e="0x"+a[2]+a[2],i="0x"+a[3]+a[3]):7==a.length&&(t="0x"+a[1]+a[2],e="0x"+a[3]+a[4],i="0x"+a[5]+a[6]),t/=255,e/=255,i/=255;var n=Math.min(t,e,i),o=Math.max(t,e,i),r=o-n,l=0,s=0;return l=0==r?0:o==t?(e-i)/r%6:o==e?(i-t)/r+2:(t-e)/r+4,(l=Math.round(60*l))<0&&(l+=360),s=(o+n)/2,"hsl("+l+","+ +(100*(0==r?0:r/(1-Math.abs(2*s-1)))).toFixed(1)+"%,"+(s=+(100*s).toFixed(1))+"%)"}},5412:(a,t,e)=>{"use strict";e.d(t,{Z:()=>o});var i=e(3645),n=e.n(i)()((function(a){return a[1]}));n.push([a.id,'.bg1[data-v-3a74ae91]{background-color:#171717;color:#000;display:table;font-family:sans-serif;height:100%;line-height:1.6;overflow:hidden;position:absolute;width:100%;z-index:-1}.lines[data-v-3a74ae91]{left:0;margin:auto;right:0;width:90%}.line[data-v-3a74ae91],.lines[data-v-3a74ae91]{height:100%;position:absolute;top:0}.line[data-v-3a74ae91]{background:hsla(0,0%,100%,.1);left:50%;overflow:hidden;width:1px}.line[data-v-3a74ae91]:after{-webkit-animation:drop-data-v-3a74ae91 7s 0s infinite;animation:drop-data-v-3a74ae91 7s 0s infinite;-webkit-animation-fill-mode:forwards;animation-fill-mode:forwards;-webkit-animation-timing-function:cubic-bezier(.4,.26,0,.97);animation-timing-function:cubic-bezier(.4,.26,0,.97);background:linear-gradient(180deg,hsla(0,0%,100%,0) 0,#fff 75%,#fff);content:"";display:block;height:15%;left:0;position:absolute;top:-50%;width:100%}.line[data-v-3a74ae91]:first-child{margin-left:-25%}.line[data-v-3a74ae91]:first-child:after{-webkit-animation-delay:2s;animation-delay:2s}.line[data-v-3a74ae91]:nth-child(3){margin-left:25%}.line[data-v-3a74ae91]:nth-child(3):after{-webkit-animation-delay:2.5s;animation-delay:2.5s}@-webkit-keyframes drop-data-v-3a74ae91{0%{top:-50%}to{top:110%}}@keyframes drop-data-v-3a74ae91{0%{top:-50%}to{top:110%}}',""]);const o=n},4210:(a,t,e)=>{"use strict";e.r(t),e.d(t,{default:()=>d});var i=e(3115);const n={data:function(){return{uuid:"123"}},props:{mainColor:{type:String,default:"#666666"}},computed:{bgStyle:function(){return{"--bg-main-color":(0,i.tG)(this.mainColor,50)}}},created:function(){var a;this.uuid=(a=Date.now(),"undefined"!=typeof performance&&"function"==typeof performance.now&&(a+=performance.now()),"xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g,(function(t){var e=(a+16*Math.random())%16|0;return a=Math.floor(a/16),("x"===t?e:3&e|8).toString(16)})))}};var o=e(3379),r=e.n(o),l=e(5412),s={insert:"head",singleton:!1};r()(l.Z,s);l.Z.locals;const d=(0,e(1900).Z)(n,(function(){var a=this,t=a.$createElement;return(a._self._c||t)("div",{staticClass:"bg1",style:a.bgStyle},[a._m(0)])}),[function(){var a=this,t=a.$createElement,e=a._self._c||t;return e("div",{staticClass:"lines"},[e("div",{staticClass:"line"}),a._v(" "),e("div",{staticClass:"line"}),a._v(" "),e("div",{staticClass:"line"})])}],!1,null,"3a74ae91",null).exports}}]);