<template>
  <front-layout :title="'Knowledge'">
    <div class="w-full">
      <div
        class="
          max-w-6xl
          mx-auto
          pb-10
          py-0
          lg:pb-0 lg:py-10
          flex
          lg:flex-row
          flex-col-reverse
          gap-6
          text-[0.875rem]
        "
      >
        <side-bar></side-bar>
        <div class="w-full lg:w-3/4 px-6">
          <div class="w-full text-2xl py-4 px-3 bg-o-yellow">
            {{ knowledge.title }}
          </div>
          <div class="border border-gray-100 p-6">
            <div class="text-lg w-full overflow-clip">
              <p class="break-all" v-html="knowledge.body"></p>
            </div>
            <div class="gap-6">
              <span class="mr-6">
                Created: {{ moment(knowledge.created_at) }}
              </span>
              <span> Updated: {{ moment(knowledge.updated_at) }} </span>
            </div>

            <div class="text-white bg-gray-700 px-5 py-2 my-6">
              Author:
              <span class="font-bold mr-4">{{ knowledge.author.name }}</span>
              Section
              <span class="font-bold">{{ knowledge.section.title }}</span>
            </div>

            <!-- show replies  -->
            <!-- {{ $page.props.user }} -->
          </div>
        </div>
      </div>
    </div>
  </front-layout>
</template>

<style scoped>
.vue3-star-ratings__wrapper[data-v-76dea496] {
  display: block;
  margin: 0 10px !important;
  text-align: center;
  padding: 0px !important;
}
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
import moment from "moment";
import vue3StarRatings from "vue3-star-ratings";
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
    vue3StarRatings,
  },
  props: {
    knowledge: Object,
  },
  data() {
    return {
      showReply: false,
      form: this.$inertia.form({
        message: "",
      }),
    };
  },

  methods: {
    // submit() {
    //   this.form.post(this.route("reply"), {
    //     onSuccess: () => this.toggleReply(),
    //   });
    // },
    moment(date) {
      return moment(date).format("MMMM Do YYYY, h:mm:ss a");
    },
    // toggleReply() {
    //   this.showReply = !this.showReply;
    // },
  },
});
</script>
