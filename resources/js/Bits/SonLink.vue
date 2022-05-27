<template>
  <div class="relative" @mouseover="show = true" @mouseleave="show = false">
    <span class="px-5 cursor-pointer">
      <slot name="title" />
    </span>
    <div
      v-show="show"
      class="absolute left-0 z-10 py-2 bg-white shadow-xl w-44"
    >
      <slot name="content" />
    </div>
  </div>
</template>

<script>
export default {
  props: ["title", "content"],
  data() {
    return {
      show: false,
    };
  },
};
</script>
