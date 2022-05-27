<template>
  <admin-layout title="Edit Business">
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
      <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Edit {{ user.name }}
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
        <form @submit="submit">
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
              <option v-for="r in roles" :key="r.id" :value="r.name">
                {{ r.name }}
              </option>
            </select>
            <small>current role: {{ form.role }}</small>
          </div>
          <jet-button
            class=""
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Update
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
  props: {
    user: Object,
    roles: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.user.name,
        email: this.user.email,
        password: null,
        role: this.roles[0].name,
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
      this.form.put(
        this.route("kitchn.business.update", { id: this.user.id }),
        {
          onFinish: () => this.form.reset(),
        }
      );
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
  mounted() {
    this.checkMessage();
  },
};
</script>
