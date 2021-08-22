<template>
  <modal
    :name="modalName"
    :max-width="600"
    width="90%"
    height="auto"
    :adaptive="true"
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
        <button @click="close" class="btn">確定</button>
      </div>
    </div>
  </modal>
</template>
<script>
  export default {
    props: {
        modalName: {
            type: String,
            required: true,
        },
        header: {
            type: String,
            required: true,
        },
        content: {
            required: true,
        }
    },
    computed: {
        isContentArray() {
            return Array.isArray(this.content)
        }
    },
    methods: {
        close() {
            this.$modal.hide(this.modalName);
        }
    }
  };
</script>
