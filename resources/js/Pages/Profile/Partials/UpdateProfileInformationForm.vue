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
      Your profile has been updated
    </div>
    <div class="flex gap-3 justify-items-center items-center my-10">
      <span class="text-medium font-extrabold w-1/5">General Information</span>
      <hr class="w-4/5" />
    </div>
    <form @submit="updateProfileInformation">
      <jet-validation-errors class="mb-4" />

      <!-- Profile Photo -->
      <div
        class="col-span-6 sm:col-span-4"
        v-if="$page.props.jetstream.managesProfilePhotos"
      >
        <!-- Profile Photo File Input -->
        <input
          type="file"
          class="hidden"
          ref="photo"
          @change="updatePhotoPreview"
        />

        <jet-label for="photo" value="Photo" />

        <!-- Current Profile Photo -->
        <div class="mt-2" v-show="!photoPreview">
          <img
            :src="user.profile_photo_url"
            :alt="user.name"
            class="rounded-full h-20 w-20 object-cover"
          />
        </div>

        <!-- New Profile Photo Preview -->
        <div class="mt-2" v-show="photoPreview">
          <span
            class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
            :style="'background-image: url(\'' + photoPreview + '\');'"
          >
          </span>
        </div>

        <jet-secondary-button
          class="mt-2 mr-2"
          type="button"
          @click.prevent="selectNewPhoto"
        >
          Select A New Photo
        </jet-secondary-button>

        <jet-secondary-button
          type="button"
          class="mt-2"
          @click.prevent="deletePhoto"
          v-if="user.profile_photo_path"
        >
          Remove Photo
        </jet-secondary-button>

        <jet-input-error :message="form.errors.photo" class="mt-2" />
      </div>

      <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
        <span class="w-full lg:w-1/4">
          <jet-label
            for="name"
            value="First and Last Name"
            required="required"
          />
        </span>

        <jet-input
          id="name"
          type="text"
          class="mt-1 block w-full lg:w-1/2"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />
        <jet-input-error :message="form.errors.name" class="mt-2" />
      </div>
      <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
        <jet-label
          for="business"
          value="Business Name"
          class="w-full lg:w-1/4"
          required="required"
        />
        <jet-input
          id="business"
          type="text"
          class="mt-1 block w-full lg:w-1/2"
          v-model="form.business"
          required
          autofocus
          autocomplete="business"
        />
        <jet-input-error :message="form.errors.email" class="mt-2" />
      </div>
      <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
        <jet-label
          for="phone"
          value="Phone Number"
          class="w-full lg:w-1/4"
          required="required"
        />
        <jet-input
          id="phone"
          type="text"
          class="mt-1 block w-full lg:w-1/2"
          v-model="form.phone"
          required
          autofocus
          autocomplete="phone"
        />
        <jet-input-error :message="form.errors.phone" class="mt-2" />
      </div>
      <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
        <jet-label
          for="email"
          value="Email Address"
          class="w-full lg:w-1/4"
          required="required"
        />
        <jet-input
          id="email"
          type="email"
          class="mt-1 block w-full lg:w-1/2"
          v-model="form.email"
          required
          autofocus
        />
        <jet-input-error :message="form.errors.email" class="mt-2" />
      </div>
      <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
        <jet-label
          for="address"
          value="Contact Address"
          class="w-full lg:w-1/4"
          required="required"
        />
        <jet-input
          id="address"
          type="text"
          class="mt-1 block w-full lg:w-1/2"
          v-model="form.address"
          required
          autofocus
          autocomplete="address"
        />
        <jet-input-error :message="form.errors.address" class="mt-2" />
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
          Update
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default defineComponent({
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
  },

  props: ["user"],

  data() {
    return {
      showSuccess: false,
      form: this.$inertia.form({
        _method: "PUT",
        name: this.user.name,
        email: this.user.email,
        business: this.user.business,
        phone: this.user.phone,
        address: this.user.address,
        photo: null,
      }),

      photoPreview: null,
    };
  },

  methods: {
    updateProfileInformation() {
      if (this.$refs.photo) {
        this.form.photo = this.$refs.photo.files[0];
      }

      this.form.post(route("user-profile-information.update"), {
        errorBag: "updateProfileInformation",
        preserveScroll: true,
        onSuccess: () => {
          (this.showSuccess = true), this.clearPhotoFileInput();
        },
      });
    },

    selectNewPhoto() {
      this.$refs.photo.click();
    },

    updatePhotoPreview() {
      const photo = this.$refs.photo.files[0];

      if (!photo) return;

      const reader = new FileReader();

      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(photo);
    },

    deletePhoto() {
      this.$inertia.delete(route("current-user-photo.destroy"), {
        preserveScroll: true,
        onSuccess: () => {
          this.photoPreview = null;
          this.clearPhotoFileInput();
        },
      });
    },

    clearPhotoFileInput() {
      if (this.$refs.photo?.value) {
        this.$refs.photo.value = null;
      }
    },
  },
});
</script>
