<template>
    <div
        :class="$style['main-link-svg']"
        :style="{
            height: svgSize + 'px', 
            width: svgSize + 'px'
        }" 
    >
        <div
            :style="{
                height: (svgSize * 0.8) + 'px', 
                width: (svgSize * 0.8) + 'px'
            }" 
            v-if="fileType === 'svg'"
            :class="svgClass"
            aria-hidden="true"
            v-on="$listeners"
            v-html="require(`../../assets/icons/svg/${fileName}`)">
        </div>
        <div 
            v-if="fileType === 'png'"
        >
            <img 
                style="width: 100%"
                :src="require(`../../assets/icons/png/color/brand/${iconName}.png`)" 
            />
        </div>
    </div>
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
        svgSize: {
            type: Number,
            default: 38
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
                return `${this.$style['svg-icon']} ${this.className}`;
            }
            return `${this.$style['svg-icon']}`;
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
        },
        fileType() {
            let iconNameArr = this.iconName.split('-');
            if(['sb', 'sr', 'lb', 'lr'].includes(iconNameArr[0])) {
                return 'svg'
            }

            if(['cb'].includes(iconNameArr[0])) {
                return 'png'
            }

            return 'none';
        }
    },
    created() {
    }
};
</script>

<style lang="scss" module>
.svg-icon {
    color: inherit;
    width: inherit;
    height: inherit;
    svg {
        width: 1em;
        height: 1em;
        vertical-align: -0.15em;
        fill: currentColor;
        overflow: hidden;
        font-size: 30px;
        width: inherit;
        height: inherit;
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

.xl {
    svg {
        font-size: 38px;
    }
}

.main-link-svg {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;

}
</style>
