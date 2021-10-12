<template>
    <div @click.prevent="click">
        <label class="cursor-pointer label">
            <input :checked="value" type="checkbox" class="toggle toggle-accent toggle-md">
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
        }
    },
    methods: {
        click() {
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