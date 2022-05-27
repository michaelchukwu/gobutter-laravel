<template>
  <admin-layout title="Create FAQs">
    <div class="container grid px-6 mx-auto">
      <!-- With actions -->
      <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        FAQs
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
        :href="route('kitchn.faq.index')"
      >
        <span>&LeftArrow; All FAQs </span>
      </Link>
      <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Create FAQ
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
            <jet-label for="question" value="Question" />
            <jet-input
              placeholder="Question"
              id="question"
              type="text"
              class="mt-1 block w-full"
              v-model="form.question"
              required
              autocomplete="question"
            />
          </div>
          <div class="mt-4">
            <jet-label for="answer" value="Answer" />
            <editor
              v-model="form.answer"
              api-key="pxgt6rab2kw87reh2mxmvfw8azbfv9cb3vsjttv3ktlcbs2k"
              :init="{
                height: 400,
                menubar: true,
                plugins: [
                  'advlist autolink lists link image charmap print preview anchor',
                  'searchreplace visualblocks code fullscreen',
                  'insertdatetime media table paste code help wordcount',
                ],
                toolbar:
                  'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help',
              }"
            />
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
import Editor from "@tinymce/tinymce-vue";

export default {
  props: {
    roles: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        question: "",
        answer: "",
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
    Editor,
  },
  methods: {
    submit() {
      this.form.post(this.route("kitchn.faq.store"), {
        onSuccess: () => this.checkMessage(),
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
  mounted() {
    this.checkMessage();
  },
};
</script>
