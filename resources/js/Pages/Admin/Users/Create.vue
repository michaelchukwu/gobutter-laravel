<template>
  <admin-layout title="Create Staff">
    <div class="container grid px-6 mx-auto">
      <!-- With actions -->
      <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Staff
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
        :href="route('kitchn.user.index')"
      >
        <span>&LeftArrow; All Staff </span>
      </Link>
      <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Create Staff
      </h4>
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
        <form @submit.prevent="submit">
          <jet-validation-errors class="mb-4" />

          <div class="mt-4">
            <jet-label for="name" value="Name" />
            <jet-input
              placeholder="Name"
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              required
              autocomplete="name"
            />
          </div>
          <div class="mt-4">
            <jet-label for="email" value="Email" />
            <jet-input
              placeholder="Email"
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
              required
              autocomplete="email"
            />
          </div>
          <div class="mt-4">
            <jet-label for="password" value="Password" />
            <jet-input
              placeholder="Password"
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password"
              required
              autocomplete="password"
            />
          </div>
          <div class="mt-4">
            <jet-label for="role" value="Role" />
            <select
              v-model="form.role"
              class="
                mt-1
                block
                w-full
                text-sm
                border-gray-300
                focus:border-indigo-300
                focus:ring
                focus:ring-indigo-200
                focus:ring-opacity-50
                rounded-md
                shadow-sm
              "
            >
              <option
                v-for="r in $page.props.roles"
                :key="r.id"
                :value="r.name"
              >
                {{ r.name }}
              </option>
            </select>
          </div>
          <div class="mt-4">
            <jet-label for="department" value="Department" />
            <select
              v-model="form.department"
              class="
                mt-1
                block
                w-full
                text-sm
                border-gray-300
                focus:border-indigo-300
                focus:ring
                focus:ring-indigo-200
                focus:ring-opacity-50
                rounded-md
                shadow-sm
              "
            >
              <option
                v-for="r in $page.props.services"
                :key="r.id"
                :value="r.id"
              >
                {{ r.title }}
              </option>
            </select>
          </div>
          <jet-button
            class=""
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Create
          </jet-button>
        </form>
      </div>
    </div>
  </admin-layout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";
export default {
  data() {
    return {
      allShops: this.shops,
      form: this.$inertia.form({
        name: "",
        email: "",
        password: "",
        role: "",
        department: "",
      }),
    };
  },
  components: {
    AdminLayout,
    Link,
    JetInput,
    JetLabel,
    JetButton,
    JetCheckbox,
    JetValidationErrors,
  },
  methods: {
    submit() {
      this.form.post(this.route("kitchn.user.store"), {
        onSuccess: () => {
          this.form.reset();
          this.checkMessage();
        },
      });
    },
    checkMessage() {
      if (this.$page.props.flash.success) {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        });

        Toast.fire({
          icon: "success",
          title: this.$page.props.flash.success,
        });
      }
      if (this.$page.props.flash.error) {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        });

        Toast.fire({
          icon: "error",
          title: this.$page.props.flash.error,
        });
      }
    },
  },
};
</script>
