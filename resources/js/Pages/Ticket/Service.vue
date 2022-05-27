<template>
  <front-layout :title="'Services'">
    <div class="w-full">
      <div
        class="max-w-6xl mx-auto py-0 lg:py-10 lg:flex gap-6 text-[0.875rem]"
      >
        <!-- sidebar  -->
        <side-bar></side-bar>
        <div class="w-full lg:w-3/4 px-6">
          <h2 class="text-2xl font-light">SON SMEs Services</h2>

          <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-5">
            <a
              :href="k.slug"
              v-for="k in services"
              :key="k.id"
              class="
                p-4
                w-full
                lg:w-auto
                hover:underline
                transition-all
                duration-100
                ease-linear
                rounded-lg
                shadow-lg
              "
            >
              <div class="text-left">
                <div class="mb-2">
                  <h3 class="font-bold text-lg">{{ k.title }}</h3>
                </div>
                <div class="mb-2">
                  <p>
                    {{ k.description }}
                  </p>
                </div>
                <div class="mb-2">
                  <button
                    class="text-white rounded-lg px-4 py-1 text-lg bg-o-green"
                  >
                    Buy Now
                  </button>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </front-layout>
</template>

<style scoped>
.bg-gray-100 {
  background-color: #f7fafc;
  background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
  border-color: #edf2f7;
  border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
  color: #cbd5e0;
  color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
  color: #a0aec0;
  color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
  color: #718096;
  color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
  color: #4a5568;
  color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
  color: #1a202c;
  color: rgba(26, 32, 44, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-gray-800 {
    background-color: #2d3748;
    background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
  }

  .dark\:bg-gray-900 {
    background-color: #1a202c;
    background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
  }

  .dark\:border-gray-700 {
    border-color: #4a5568;
    border-color: rgba(74, 85, 104, var(--tw-border-opacity));
  }

  .dark\:text-white {
    color: #fff;
    color: rgba(255, 255, 255, var(--tw-text-opacity));
  }

  .dark\:text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
  }
}
</style>

<script>
import { defineComponent } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import FrontLayout from "../../Layouts/FrontLayout.vue";
import SideBar from "@/Bits/SideBar.vue";
import Pagination from "@/Bits/Pagination.vue";

export default defineComponent({
  components: {
    Head,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
    FrontLayout,
    SideBar,
    Pagination,
  },
  props: ["services"],
});
</script>
