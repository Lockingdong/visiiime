<template>
    <!-- <component
        :is="dynamicIcon"
        :class="svgClass"
        aria-hidden="true"
        v-on="$listeners"
    /> -->
    <span
        :class="svgClass"
        aria-hidden="true"
        v-on="$listeners"
        v-html="require(`../../assets/icons/svg/${fileName}`)">
    </span>

</template>

<script>
export default {
    props: {
        iconName: {
            type: String,
            required: true,
        },
        className: {
            type: String,
            default: "",
        },
        size: {
            type: String,
            default: 'sm'
        }
    },
    computed: {
        iconNameId() {
            return `#icon-${this.iconName}`;
        },
        svgClass() {
            if (this.className) {
                return `${this.$style['svg-icon']} ${this.$style[this.size]} ${this.className}`;
            }
            return `${this.$style['svg-icon']} ${this.$style[this.size]}`;
        },
        fileName() {
            let iconNameArr = this.iconName.split('-');
            let fileName;
            switch (iconNameArr[0]) {
                case 'sb':
                    fileName = 'solid/brand'
                    break;
                case 'sr':
                    fileName = 'solid/regular'
                    break;
                case 'lb':
                    fileName = 'line/brand'
                    break;
                case 'lr':
                    fileName = 'line/regular'
                    break;
                default:
                    console.log('icon not found')
                    break;
            }
            fileName += `/${this.iconName}.svg`
            return fileName;
        }
    },
    created() {
    }
};
</script>

<style lang="scss" module>
.svg-icon {
    color: black;
    svg {
        width: 1em;
        height: 1em;
        vertical-align: -0.15em;
        fill: currentColor;
        overflow: hidden;
        font-size: 30px;
    }
}

.sm {
    svg {
        font-size: 25px;
    }
}

.lg {
    svg {
        font-size: 30px;
    }
}
</style>
