<template>
    <div @click.prevent="click">
        <label class="cursor-pointer label">
            <input :checked="value" type="checkbox" class="toggle toggle-accent" :class="`toggle-${size}`">
        </label>
        <confirm-modal
            :modal-name="modalName"
            @confirm="confirm"
        />
    </div>
</template>

<script>
import ConfirmModal from "@/components/widgets/upload/ConfirmModal";
import uuid from "@/helper/uuid"

export default {
    components: {
        ConfirmModal,
    },
    data() {
        return {
            modalName: '',
        }
    },
    props: {
        value: {
            type: Boolean,
            required: true
        },
        size: {
            type: String,
            default: 'md'
        },
        customClick: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        click() {
            if(!this.customClick) {
                this.showModal()
            }

            this.$emit('switch-clicked')
            
        },
        showModal() {
            let header = this.value ? '確定要關閉嗎?' : '確定要發佈嗎?'
            this.$modal.show(this.modalName, {
                header
            })
        },
        confirm() {
            this.$emit('confirm', !this.value)
        }
    },
    mounted() {
        this.modalName = uuid();
    }
}

</script>