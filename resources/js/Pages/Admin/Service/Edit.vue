<template>
  <admin-layout title="Edit Services">
    <div class="container grid px-6 mx-auto">
      <!-- With actions -->
      <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Services
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
        :href="route('kitchn.service.index')"
      >
        <span>&LeftArrow; All Services </span>
      </Link>
      <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Edit Service
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
            <jet-label for="title" value="Title" />
            <jet-input
              placeholder="Title"
              id="title"
              type="text"
              class="mt-1 block w-full"
              v-model="form.title"
              required
              autocomplete="title"
            />
          </div>
          <div class="mt-4">
            <jet-label for="slug" value="Slug" />
            <jet-input
              placeholder="Slug"
              id="slug"
              type="text"
              class="mt-1 block w-full"
              v-model="form.slug"
              required
              autocomplete="slug"
            />
          </div>
          <div class="mt-4">
            <jet-label for="description" value="Description" />

            <textarea
              v-model="form.description"
              required
              class="
                text-sm
                border-gray-300
                focus:border-green-300
                focus:ring
                focus:ring-green-200
                focus:ring-opacity-50
                rounded-md
                shadow-sm
                w-full
              "
              id="description"
              cols="30"
              rows="10"
            ></textarea>
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
    service: Object,
    roles: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        title: this.service.title,
        description: this.service.description,
        slug: this.service.slug,
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
        this.route("kitchn.service.update", { id: this.service.id }),
        {
          onSuccess: () => this.checkMessage(),
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
};
</script>
