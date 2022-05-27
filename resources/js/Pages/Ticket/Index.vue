<template>
  <front-layout :title="'Dashboard'">
    <div class="w-full">
      <div
        class="max-w-6xl mx-auto py-0 lg:py-10 lg:flex gap-6 text-[0.875rem]"
      >
        <!-- sidebar  -->
        <side-bar></side-bar>
        <div class="w-full lg:w-3/4 py-12 px-6">
          <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 mb-4">
            <Link
              :href="route('ticket.create')"
              class="
                shadow
                flex
                justify-center justify-items-center
                items-center
                p-6
                w-full
                lg:w-auto
              "
            >
              <div class="text-center">
                <div>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 mx-auto"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                    />
                  </svg>
                </div>
                <div>Enquiry Form</div>
              </div>
            </Link>
            <Link
              :href="route('knowledgebase.index')"
              class="
                shadow
                flex
                justify-center justify-items-center
                items-center
                p-6
                w-full
                lg:w-auto
              "
            >
              <div class="text-center">
                <div>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 mx-auto"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"
                    />
                  </svg>
                </div>
                <div>Knowledgebase</div>
              </div>
            </Link>
            <Link
              :href="route('ticket.create')"
              class="
                shadow
                flex
                justify-center justify-items-center
                items-center
                p-6
                w-full
                lg:w-auto
              "
            >
              <div class="text-center">
                <div>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 mx-auto"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>
                </div>
                <div>FAQs</div>
              </div>
            </Link>
            <Link
              :href="route('ticket.create')"
              class="
                shadow
                flex
                justify-center justify-items-center
                items-center
                p-6
                w-full
                lg:w-auto
              "
            >
              <div class="text-center">
                <div>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 mx-auto"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"
                    />
                  </svg>
                </div>
                <div>News</div>
              </div>
            </Link>
          </div>
          <div class="w-full overflow-x-scroll">
            <table class="w-full">
              <thead class="bg-o-green text-white font-bold">
                <tr>
                  <th scope="col" class="font-bold text-white px-6 py-4">
                    Ticket ID
                  </th>
                  <th scope="col" class="font-bold text-white px-6 py-4">
                    Last Update
                  </th>
                  <!-- <th scope="col" class="font-bold text-white px-6 py-4">
                    Last Replier
                  </th> -->
                  <th scope="col" class="font-bold text-white px-6 py-4">
                    Department
                  </th>
                  <th scope="col" class="font-bold text-white px-6 py-4">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody v-if="tickets.length > 0">
                <tr v-for="t in tickets" :key="t.id" class="shadow mb-1">
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-8
                      whitespace-nowrap
                    "
                  >
                    <div class="z-10 absolute -mt-5">
                      <Link
                        :href="route('ticket.show', { ticket: t.number })"
                        class="font-bold"
                        >{{ t.messages[0].subject }}</Link
                      >
                    </div>

                    #{{ t.number }}
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    {{ moment(t.messages[t.messages.length - 1].updated_at) }}
                  </td>

                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    {{ t.service.title }}
                  </td>

                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    <span
                      v-if="t.status === 'Resolved'"
                      class="bg-green-50 py-2 px-30"
                      >{{ t.status }}</span
                    >
                    <span
                      v-if="t.status === 'Closed'"
                      class="bg-red-500 py-2 px-3 text-white"
                      >{{ t.status }}</span
                    >
                    <span
                      v-if="t.status === 'Awaiting Response'"
                      class="bg-gray-300 py-2 px-3"
                      >{{ t.status }}</span
                    >
                    <span
                      v-if="t.status === 'In Progress'"
                      class="bg-yellow-500 py-2 px-3"
                      >Agent Responded</span
                    >
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  No Tickets yet
                </tr>
              </tbody>
            </table>
          </div>
          <div class="flex justify-between items-center mt-4">
            <div>
              <a
                href="/interest.doc"
                class="
                  text-o-green
                  no-underline
                  hover:underline
                  transition-all
                  ease-linear
                  duration-0
                  hover:duration-150
                "
                >Join the certification board</a
              >
            </div>
            <div>
              <Link
                :href="route('view')"
                class="
                  text-white
                  bg-o-green
                  border border-o-green
                  hover:text-o-green hover:bg-white
                  rounded
                  transition-all
                  duration-150
                  ease-linear
                  py-2
                  px-3
                  mt-4
                "
                >View More</Link
              >
            </div>
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
import moment from "moment";
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
  },
  props: ["tickets"],
  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        phone: "",
        address: "",
        business: "",
        service: null,
        subject: "",
        message: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("ticket.store"));
    },
    moment(date) {
      return moment(date).format("MMMM Do YYYY, h:mm:ss a");
    },
  },
});
</script>
