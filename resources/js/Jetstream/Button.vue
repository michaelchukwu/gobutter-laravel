<template>
  <button
    :type="type"
    class="
      block
      w-full
      px-4
      py-2
      mt-4
      text-sm
      font-medium
      leading-5
      text-center text-white
      transition-colors
      duration-150
      bg-o-green
      border border-transparent
      rounded-lg
      active:bg-o-green
      hover:bg-green-600
      focus:outline-none focus:shadow-outline-purple
    "
  >
    <!-- <button :type="type" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"> -->
    <slot></slot>
  </button>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    type: {
      type: String,
      default: "submit",
    },
  },
});
</script>
