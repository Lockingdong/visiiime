<template>
    <modal
        :name="'ShareSelectModal'"
        :max-width="600"
        width="90%"
        height="auto"
        :adaptive="true"
    >

        <div @click="copyUrl()" class="card-body cursor-pointer">
            <div class="card-title">
                <fai :icon="['fa', 'copy']" class="mr-2" />    
                <span>複製連結 </span> 
                <div class="text-sm">{{ pageUrl }} </div>
                <span v-if="pageUrlCopied" class="badge badge-primary"> 已複製 !</span>
                <input id="pageUrl" type="hidden" :value="pageUrl" />
            </div>
            
        </div>
        <div @click="facebookShare()" class="card-body cursor-pointer">
            <h3 class="card-title">
                <fai :icon="['fab', 'facebook-f']" class="mr-2" />    
            Facebook 分享</h3>
        </div>
        <div @click="lineShare()" class="card-body cursor-pointer">
            <h3 class="card-title">
                <fai :icon="['fab', 'line']" class="mr-2" />
            Line 分享</h3>
        </div>
    </modal>
</template>


<script>
import { library } from '@fortawesome/fontawesome-svg-core'
import {
    faCopy,
} from '@fortawesome/free-solid-svg-icons'
import {
    faFacebookF,
    faLine
} from '@fortawesome/free-brands-svg-icons'

library.add(
    faCopy,
    faFacebookF,
    faLine
)
export default {
    props: {
        pageUrl: {
            type: String,
            required: true
        },
    },
    data() {
        return {
            pageUrlCopied: false
        }
    },
    methods: {
        facebookShare(){
            window.open('http://www.facebook.com/share.php?u=' + encodeURIComponent(this.pageUrl));
		},
		lineShare(){
            window.open('https://social-plugins.line.me/lineit/share?url=' + encodeURIComponent(this.pageUrl));
		},
        copyUrl () {
            let pageUrl = document.querySelector('#pageUrl')
            pageUrl.setAttribute('type', 'text')    // 不是 hidden 才能複製
            pageUrl.select()

            try {
                document.execCommand('copy');
                this.pageUrlCopied = true
            } catch (err) {
                this.pageUrlCopied = false
                console.log(err)
            }

            /* unselect the range */
            pageUrl.setAttribute('type', 'hidden')
            window.getSelection().removeAllRanges()
        },
    }
}
</script>
