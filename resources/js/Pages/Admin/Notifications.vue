<template>
  <admin-layout title="Notifications">
    <div class="container grid px-6 mx-auto">
      <!-- With actions -->
      <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Notifications
      </h2>
      <!-- CTA -->
      <button
        class="
          hidden
          flex
          items-center
          justify-between
          p-4
          mb-8
          text-sm
          font-semibold
          text-purple-100
          bg-o-green
          rounded-lg
          shadow-md
          focus:outline-none focus:shadow-outline-purple
        "
        :href="route('kitchn.user.create')"
      >
        <span>Clear all notifications</span>
      </button>

      <div class="w-full rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
          <div
            v-for="notification in userNotifications.data"
            :key="notification"
          >
            <Link
              v-if="notification.type == 'App\\Notifications\\TicketCreated'"
              :href="
                route('kitchn.ticket.edit', {
                  ticket: notification.data.ticket.id,
                })
              "
            >
              <div class="shadow-sm shadow-green-400 rounded p-4 bg-white mb-2">
                <strong>{{ notification.data.user.name }}</strong> created
                ticket
                <strong>#{{ notification.data.ticket.number }}</strong>
              </div>
            </Link>
            <Link
              v-if="notification.type == 'App\\Notifications\\TicketClosed'"
              :href="
                route('kitchn.ticket.edit', {
                  ticket: notification.data.ticket.id,
                })
              "
            >
              <div class="shadow-sm shadow-red-400 rounded p-4 bg-white mb-2">
                <strong>{{ notification.data.user.name }}</strong> closed ticket
                <strong>#{{ notification.data.ticket.number }}</strong>
              </div>
            </Link>
            <Link
              v-if="notification.type == 'App\\Notifications\\TicketForwarded'"
              :href="
                route('kitchn.ticket.edit', {
                  ticket: notification.data.ticket.id,
                })
              "
            >
              <div
                class="shadow-sm shadow-yellow-400 rounded p-4 bg-white mb-2"
              >
                <strong>{{ notification.data.from.name }}</strong> has forwarded
                ticket
                <strong>#{{ notification.data.ticket.number }}</strong> to you.
                Left : {{ notification.data.comment }}
              </div>
            </Link>
            <Link
              v-if="notification.type == 'App\\Notifications\\UserResponded'"
              :href="
                route('kitchn.ticket.edit', {
                  ticket: notification.data.ticket.id,
                })
              "
            >
              <div
                class="shadow-sm shadow-yellow-400 rounded p-4 bg-white mb-2"
              >
                <strong>{{ notification.data.user.name }}</strong> responded to
                ticket
                <strong>#{{ notification.data.ticket.number }}</strong>
              </div>
            </Link>
          </div>
          <div
            v-if="userNotifications.next_page_url != null"
            class="border-b dark:border-gray-700 p-4"
          >
            <button class="text-o-green" @click="loadMore">Load More...</button>
          </div>
        </div>
      </div>
    </div>
  </admin-layout>
</template>
<script>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import moment from "moment";
import Swal from "sweetalert2";
import JetInput from "@/Jetstream/Input.vue";

import { debounce } from "lodash/function";
import axios from "axios";

export default {
  props: {
    notifications: Object,
  },
  data() {
    return {
      userNotifications: this.notifications,
    };
  },
  components: {
    AdminLayout,
    Link,
    Swal,
    JetInput,
  },
  methods: {
    moment(date) {
      // var myDate = new Date(date*1000);
      return moment(date).format("MMMM Do YYYY, h:mm:ss a");
    },
    loadMore() {
      axios.get(this.userNotifications.next_page_url).then((response) => {
        this.userNotifications = {
          ...response.data,
          data: [this.userNotifications.data, ...response.data.data],
        };
      });
    },
  },
};
</script>
