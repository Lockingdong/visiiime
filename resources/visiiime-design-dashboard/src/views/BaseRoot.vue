<template>
  <div class="flex md:my-h-screen bg-gray-100">
    <div class="flex flex-grow md:overflow-hidden w-full">
      <div id="edit-container" class="px-4 py-4 md:overflow-y-scroll mx-auto w-full">
        <slot name="router"></slot>
      </div>
    </div>
    <div class="flex-grow-0">
      <div
        class="
          hidden
          md:flex
          md:p-10
          lg:p-20
          border-t
          md:border-t-0
          border-l
          justify-center
          items-center
          h-full
          relative
        "
      >
        <mobile-phone :camera-on="true">
          <template #screen>
            <slot name="theme"></slot>

          </template>
        </mobile-phone>
      </div>
      <div
        v-show="!mbPhone"
        class="
          md:hidden
          fixed
          top-100
          right-0
          -ml-8
          pt-4
          pr-2
          flex
          sm:-ml-10
          sm:pr-4
        "
      >
        <button
          @click="mbPhone = !mbPhone"
          class="
            p-1
            bg-gray-700
            rounded-md
            text-gray-100
            hover:text-white
            focus:outline-none
            focus:ring-2 focus:ring-white
          "
        >
          <span class="sr-only">Close panel</span>
          <!-- Heroicon name: outline/x -->
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"
            />
          </svg>
        </button>
      </div>
      <div
        v-show="mbPhone"
        class="md:hidden fixed inset-0 overflow-hidden z-10"
        aria-labelledby="slide-over-title"
        role="dialog"
        aria-modal="true"
      >
        <div class="absolute inset-0 overflow-hidden">
          <div
            v-show="mbPhone"
            class="
              absolute
              inset-0
              bg-gray-500 bg-opacity-75
              transition-opacity
            "
            aria-hidden="true"
          ></div>
          <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div v-show="mbPhone" class="relative w-screen max-w-md">
              <div
                v-show="mbPhone"
                class="
                  absolute
                  top-0
                  left-0
                  -ml-8
                  pt-4
                  pr-2
                  flex
                  sm:-ml-10
                  sm:pr-4
                "
              >
                <button
                  @click="mbPhone = !mbPhone"
                  class="
                    rounded-md
                    text-gray-300
                    hover:text-white
                    focus:outline-none
                    focus:ring-2 focus:ring-white
                  "
                >
                  <span class="sr-only">Close panel</span>
                  <svg
                    class="h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    aria-hidden="true"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </div>
              <div
                class="
                  h-full
                  flex flex-col
                  py-6
                  bg-white
                  shadow-xl
                  overflow-y-scroll
                  bg-gray-800
                "
              >
                <div class="relative flex-1 px-4 sm:px-6">
                  <div class="absolute inset-0 px-4 sm:px-6">
                    <div
                      class="
                        h-full
                        flex
                        justify-center
                        items-center
                      "
                      aria-hidden="true"
                    >
                      <mobile-phone
                        :camera-on="true"
                      >
                        <template #screen>
                          <slot name="theme"></slot>

                        </template>
                      </mobile-phone>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MobilePhone from "@/components/widgets/MobilePhone";
export default {
  data() {
    return {
      mbPhone: false
    }
  },
  components: {
    MobilePhone,
  },

}

</script>
<style lang="scss">
.md\:my-h-screen {
    @media (min-width: 768px) {
        height: calc(100vh - 4rem);
    }
}

</style>
