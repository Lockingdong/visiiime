<template>
    <div :class="$style['cp']" :style="{color: textColor, display: display ? 'block' : 'none'}">Supported by 
        <a :href="url" target="_blank"><b>VISIIIME.</b></a>
    </div>
</template>
<script>

import { baseUrl } from '../../../../helper/env'

export default {
    props: {
        textColor: {
            type: String,
            required: true
        },
        display: {
            type: Boolean,
            default: true
        }
    },
    computed: {
        url() {
            return baseUrl();
        }
    }
}
</script>

<style lang="scss" module>
.cp {
    text-align: center;
    font-size: 14px;
    opacity: 0.9;
    margin-bottom: 20px;
}
</style>