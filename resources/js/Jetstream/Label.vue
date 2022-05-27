<template>
  <label class="block text-sm text-gray-700">
    <span class="text-gray-700 dark:text-gray-400" v-if="value">{{
      value
    }}</span>
    <span class="text-gray-700 dark:text-gray-400" v-else><slot></slot></span>
    <span v-if="required" class="text-red-500 ml-1 text-lg">&ast;</span>
  </label>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: ["value", "required"],
});
</script>
