<template>
  <div>
    <div
      v-if="$page.props.flash.success"
      class="bg-o-green text-white w-1/3 rounded-lg flex gap-4 mt-4 py-3 px-3"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
        />
      </svg>
      Your Password has been updated
    </div>
    <div class="my-10"></div>
    <!-- <div class="flex gap-3 justify-items-center items-center my-10">
      <span class="text-medium font-extrabold w-1/5">General Information</span>
      <hr class="w-4/5" />
    </div> -->
    <form @submit="updatePassword">
      <jet-validation-errors class="mb-4" />

      <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
        <jet-label
          class="w-full lg:w-1/4"
          for="current_password"
          value="Current Password"
        />
        <jet-input
          id="current_password"
          type="password"
          class="mt-1 block w-full lg:w-1/2"
          v-model="form.current_password"
          ref="current_password"
          autocomplete="current-password"
        />
        <jet-input-error :message="form.errors.current_password" class="mt-2" />
      </div>
      <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
        <jet-label for="password" value="New Password" class="w-1/4" />
        <jet-input
          id="password"
          type="password"
          class="mt-1 block w-full lg:w-1/2"
          v-model="form.password"
          ref="password"
          autocomplete="new-password"
        />
        <jet-input-error :message="form.errors.password" class="mt-2" />
      </div>
      <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
        <jet-label
          for="password_confirmation"
          value="Confirm Password"
          class="w-full lg:w-1/4"
        />
        <jet-input
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full lg:w-1/2"
          v-model="form.password_confirmation"
          autocomplete="new-password"
        />
        <jet-input-error
          :message="form.errors.password_confirmation"
          class="mt-2"
        />
      </div>

      <div class="flex items-center justify-start mt-4">
        <button
          class="
            text-white
            bg-o-green
            py-2
            px-5
            w-full
            lg:w-auto
            rounded
            font-bold
          "
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Update Password
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";

export default defineComponent({
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
  },

  data() {
    return {
      form: this.$inertia.form({
        current_password: "",
        password: "",
        password_confirmation: "",
      }),
    };
  },

  methods: {
    updatePassword() {
      this.form.put(route("user-password.update"), {
        errorBag: "updatePassword",
        preserveScroll: true,
        onSuccess: () => this.form.reset(),
        onError: () => {
          if (this.form.errors.password) {
            this.form.reset("password", "password_confirmation");
            this.$refs.password.focus();
          }

          if (this.form.errors.current_password) {
            this.form.reset("current_password");
            this.$refs.current_password.focus();
          }
        },
      });
    },
  },
});
</script>
