<template>
  <front-layout :title="'Ticket #' + ticket.ticket.number">
    <div class="w-full">
      <div
        class="
          max-w-6xl
          mx-auto
          pb-10
          py-0
          lg:pb-0 lg:py-10 lg:flex
          gap-6
          text-[0.875rem]
        "
      >
        <side-bar></side-bar>
        <div class="w-full lg:w-3/4 px-6">
          <div class="w-full text-2xl py-4 px-3 bg-o-yellow">
            View Your Tickets - #{{ ticket.ticket.number }}
          </div>
          <div class="border border-gray-100 p-6">
            <div class="text-lg font-bold">
              {{ ticket.messages[0].subject }}
            </div>
            <div class="gap-6">
              <span class="mr-6">
                Created: {{ moment(ticket.ticket.created_at) }}
              </span>
              <span> Updated: {{ moment(ticket.ticket.updated_at) }} </span>
            </div>
            <div class="lg:flex items-center mt-3">
              How satisfied are yu with the customer service you received from
              support today?
              <div class="flex">
                <vue3-star-ratings
                  :starSize="12"
                  :starColor="'#ff9800'"
                  :inactiveColor="'#999'"
                  :numberOfStars="5"
                  :step="0.5"
                  :showControl="false"
                  v-model="thisRating"
                  @click="setRating"
                ></vue3-star-ratings>
              </div>
              {{ thisRating }}
            </div>
            <div class="text-white bg-gray-700 px-5 py-2 my-6">
              Department:
              <span class="font-bold mr-4">{{ ticket.service.title }}</span>
              Status
              <span class="font-bold">{{ ticket.ticket.status }}</span>
            </div>
            <!-- button to add reply  -->
            <div>
              <button
                v-show="!showReply"
                @click="toggleReply"
                class="
                  text-gray-600
                  hover:bg-o-green hover:text-white
                  border border-gray-400
                  hover:border-green-400
                  transition-all
                  duration-100
                  ease-linear
                  py-2
                  px-5
                  rounded
                  font-bold
                "
              >
                Add Reply
              </button>
            </div>
            <!-- reply form  -->
            <div v-if="showReply">
              <form @submit.prevent="submit">
                <jet-validation-errors />
                <div class="mt-4">
                  <jet-label
                    for="message"
                    value="Your Message"
                    class="w-1/4"
                    required="required"
                  />
                  <textarea
                    id="message"
                    class="
                      mt-1
                      block
                      w-1/2
                      text-sm
                      border-gray-300
                      focus:border-green-300
                      focus:ring
                      focus:ring-green-200
                      focus:ring-opacity-50
                      rounded-md
                      shadow-sm
                    "
                    v-model="form.message"
                    required
                    rows="10"
                    autofocus
                    autocomplete="message"
                  ></textarea>
                </div>
                <div class="flex items-center justify-start mt-4">
                  <button
                    class="text-white bg-o-green py-2 px-5 rounded font-bold"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    Submit
                  </button>
                </div>
              </form>
            </div>
            <!-- show replies  -->
            <!-- {{ $page.props.user }} -->
            <div class="mt-6">
              <div
                class="flex gap-3 mt-6"
                v-for="m in ticket.messages"
                :key="m.id"
              >
                <div>
                  <img :src="m.user.profile_photo_url" alt="" />
                </div>
                <div>
                  <div>
                    <span class="font-bold text-medium">{{ m.user.name }}</span>
                    <span
                      v-for="r in m.user.roles"
                      :key="r.id"
                      class="
                        ml-3
                        border border-gray-200
                        py-1
                        px-2
                        text-xs
                        rounded-lg
                      "
                      >{{ r.name }}</span
                    >
                  </div>
                  <div class="font-lighter text-xs mt-2">
                    Posted on: {{ moment(m.created_at) }}
                  </div>
                  <div>
                    <p v-html="m.body"></p>
                  </div>
                </div>
              </div>
            </div>
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

/* .text-gray-600 {
  color: #718096;
  color: rgba(113, 128, 150, var(--tw-text-opacity));
} */
/* .text-white {
  color: white;
} */

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
    ticket: Object,
    rating: Object,
  },
  data() {
    return {
      showReply: false,
      thisRating: this.rating ? this.rating.rating : 0,
      form: this.$inertia.form({
        ticket: this.ticket.ticket.id,
        message: "",
      }),
    };
  },

  methods: {
    setRating() {
      this.$inertia.post(
        this.route("rating.set", {
          ticket: this.ticket,
          rating: this.thisRating,
        })
      );
    },
    submit() {
      this.form.post(this.route("reply"), {
        onSuccess: () => this.toggleReply(),
      });
    },
    moment(date) {
      return moment(date).format("MMMM Do YYYY, h:mm:ss a");
    },
    toggleReply() {
      this.showReply = !this.showReply;
    },
  },
});
</script>
