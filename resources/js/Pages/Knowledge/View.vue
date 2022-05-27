<template>
  <front-layout>
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
        <div class="w-full lg:w-3/4 py-0 px-6 overflow-scroll lg:overflow-auto">
          <div class="w-full text-2xl py-4 px-3 bg-o-yellow">
            View Your Tickets
          </div>
          <div>
            <table class="w-full">
              <thead class="bg-o-green text-white font-bold">
                <tr>
                  <th scope="col" class="font-bold text-white px-6 py-4">
                    Ticket ID
                  </th>
                  <th scope="col" class="font-bold text-white px-6 py-4">
                    Last Update
                  </th>
                  <th scope="col" class="font-bold text-white px-6 py-4">
                    Last Replier
                  </th>
                  <th scope="col" class="font-bold text-white px-6 py-4">
                    Department
                  </th>
                  <th scope="col" class="font-bold text-white px-6 py-4">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody v-if="tickets.data.length > 0">
                <tr v-for="t in tickets.data" :key="t.id" class="shadow mb-1">
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
                    {{ t.messages[t.messages.length - 1].user.name }}
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
                      class="bg-red-500 py-2 px-3 font-white"
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
                      >{{ t.status }}</span
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
import moment from "moment";
import SideBar from "@/Bits/SideBar.vue";
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
    moment,
    SideBar,
  },
  props: {
    tickets: Object,
  },
  data() {
    return {
      loga: this.$inertia.form({
        email: "",
        password: "",
      }),
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
    logout() {
      this.$inertia.post(route("logout"));
    },
    moment(date) {
      return moment(date).format("MMMM Do YYYY, h:mm:ss a");
    },
  },
});
</script>
