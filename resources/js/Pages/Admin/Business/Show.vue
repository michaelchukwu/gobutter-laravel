<template>
  <admin-layout :title="business.name">
    <div class="container grid px-6 mx-auto">
      <!-- With actions -->
      <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Businesses
      </h2>
      <!-- CTA -->
      <Link
        class="
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
        :href="route('kitchn.business.index')"
      >
        <span>&LeftArrow; All Businesses </span>
      </Link>
      <div class="flex gap-4">
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
          View {{ business.name }}
        </h4>
        <a
          class="text-white bg-red-400 rounded flex items-center mb-4 px-2 py-3"
          :href="route('pdf', { business: business })"
          >Export as PDF</a
        >
      </div>

      <div
        class="
          px-4
          py-3
          mb-8
          bg-white
          rounded-lg
          shadow-md
          dark:bg-gray-800
          w-full
          md:w-1/2
        "
      >
        <div class="mt-4">
          <jet-label for="name" value="Name" />
          <span>{{ business.name }}</span>
        </div>
        <div class="mt-4">
          <jet-label for="email" value="Email" />
          <span>{{ business.email }}</span>
        </div>
        <div class="mt-4">
          <jet-label for="Phone" value="Phone" />
          <span>{{ business.phone }}</span>
        </div>
        <div class="mt-4">
          <jet-label for="Business" value="Business" />
          <span>{{ business.business }}</span>
        </div>
        <div class="mt-4">
          <jet-label for="role" value="Role" />
          {{ business.roles[0].name }}
        </div>
        <div class="mt-4">
          <jet-label for="address" value="Address" />
          {{ business.address + ", " + business.state }}
        </div>
        <div class="mt-4">
          <jet-label for="category" value="Category" />
          {{ business.category }}
        </div>
        <div class="mt-4">
          <jet-label for="msme" value="MSME" />
          {{ business.msme }}
        </div>
      </div>
    </div>
  </admin-layout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import JetLabel from "@/Jetstream/Label.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
  props: {
    business: Object,
  },

  components: {
    AdminLayout,
    Link,
    JetLabel,
  },
};
</script>
