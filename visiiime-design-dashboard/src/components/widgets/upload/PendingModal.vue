<template>
  <div>
    <modal
      name="uploadModal"
      :max-width="600"
      width="90%"
      height="auto"
      :adaptive="true"
    >
      <div>
        <div
          class="
            mx-auto
            bg-white
            rounded-2xl
            overflow-hidden
          "
        >
          
        </div>
      </div>
    </modal>
  </div>
</template>

<script>

export default {
  data() {
    return {
      uploadType: "",
      fileUpload: {
        files: [],
        previewImage: ''
      }
    };
  },
  props: {
    emitFunction: {
      type: String
    }
  },
  methods: {
    
  }
};
</script>

<style lang="scss" scoped>
.file-uploads-html5 {
  width: 100%;
  height: 100%;
  display: inline-block;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
