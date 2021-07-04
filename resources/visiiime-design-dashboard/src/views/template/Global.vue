<template>
  <div class="p-5 container mx-auto">
    <label class="block">
      <span class="text-gray-700">Full name</span>
      <input
        type="text"
        class="
          mt-0
          block
          w-full
          px-0.5
          border-0 border-b-2 border-gray-200
          focus:ring-0
          outline-none
          focus:border-black
        "
        placeholder=""
      />
      <div
        class="
          bg-red-100
          border-t border-b border-red-500
          text-red-700
          px-4
          py-3
        "
        role="alert"
      >
        <!-- <p class="font-bold">Informational message</p> -->
        <p class="text-sm">Some additional text to explain said message.</p>
      </div>
    </label>
    <div class="">123</div>
  </div>
</template>
<style lang="scss" scoped>
.container{
  color: #888888;
}

</style>