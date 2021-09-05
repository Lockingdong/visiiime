<template>
  <modal
    :name="modalName"
    :max-width="600"
    width="90%"
    height="auto"
    :adaptive="true"
    @before-open="beforeOpen"
  >
    <div class="card-body">
      <h2 class="my-2 text-xl font-bold card-title text-center">{{ header }}</h2>
      <div class="text-center" v-if="isContentArray">
        <ul>
            <li v-for="(item, idx) in content" :key="idx"> {{item}} </li>
        </ul>
      </div>
      <div class="text-center" v-else v-html="content">
      </div>
      <div class="justify-center space-x-2 card-actions">
        <button @click="cancel" class="btn btn-outline">取消</button>
        <button @click="confirm" class="btn">確定</button>
      </div>
    </div>
  </modal>
</template>
<script>
  export default {
    data() {
        return {
            header: {
                type: String,
                required: true,
            },
            content: {
                required: true,
            }
        }
    },
    props: {
        modalName: {
            type: String,
            required: true,
        },
    },
    computed: {
        isContentArray() {
            return Array.isArray(this.content)
        }
    },
    methods: {
        close() {
            this.$modal.hide(this.modalName);
        },
        beforeOpen({ params }) {
            this.header = params.header || ''
            this.content = params.content || ''
        },
        confirm() {
            this.$emit('confirm');
            this.close();
        },
        cancel() {
            this.$emit('cancel');
            this.close();
        }
    }
  };
</script>
