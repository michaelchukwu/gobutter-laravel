<template>
  <front-layout :title="'Enquiry Form'">
    <div class="w-full">
      <div
        class="max-w-6xl mx-auto py-0 lg:py-10 lg:flex gap-6 text-[0.875rem]"
      >
        <!-- sidebar  -->
        <side-bar></side-bar>
        <div class="w-full lg:w-3/4 py-12 px-6">
          <div class="text-4xl">Your ticket details</div>
          <div class="text-lg mt-4 font-light">
            Please fill out all the fields with corresponding information
          </div>
          <div>
            <div class="flex gap-3 justify-items-center items-center my-5">
              <span class="text-medium font-extrabold w-1/5"
                >General Information</span
              >
              <hr class="w-4/5" />
            </div>
            <form @submit.prevent="submit">
              <jet-validation-errors class="mb-4" />

              <div class="mt-2 flex gap-3 justify-items-center items-center">
                <span class="w-1/4">
                  <jet-label for="name" value="First and Last Name" />
                </span>
                <span class="w-1/2 text-gray-700">
                  {{ form.name }}
                </span>
              </div>
              <div class="mt-2 flex gap-3 justify-items-center items-center">
                <jet-label for="business" value="Business Name" class="w-1/4" />
                <span class="w-1/2 text-gray-700">
                  {{ form.business }}
                </span>
              </div>
              <div class="mt-2 flex gap-3 justify-items-center items-center">
                <jet-label for="phone" value="Phone Number" class="w-1/4" />
                <span class="w-1/2 text-gray-700">
                  {{ form.phone }}
                </span>
              </div>
              <div class="mt-2 flex gap-3 justify-items-center items-center">
                <jet-label for="email" value="Email Address" class="w-1/4" />
                <span class="w-1/2 text-gray-700">
                  {{ form.email }}
                </span>
              </div>
              <div class="mt-2 flex gap-3 justify-items-center items-center">
                <jet-label
                  for="address"
                  value="Contact Address"
                  class="w-1/4"
                />
                <span class="w-1/2 text-gray-700">
                  {{ form.address }}
                </span>
              </div>
              <div class="flex gap-3 justify-items-center items-center my-5">
                <span class="text-medium font-extrabold w-1/5"
                  >Service Information</span
                >
                <hr class="w-4/5" />
              </div>
              <div class="lg:flex gap-3 justify-items-center items-center">
                <jet-label
                  for="service"
                  value="Required Service"
                  class="w-full lg:w-1/4"
                  required="required"
                />
                <select
                  v-model="form.service"
                  id="service"
                  class="
                    mt-1
                    block
                    w-full
                    lg:w-1/2
                    text-sm
                    border-gray-300
                    focus:border-green-300
                    focus:ring
                    focus:ring-green-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                  "
                >
                  <option
                    :value="service.id"
                    v-for="service in $page.props.services"
                    :key="service"
                  >
                    {{ service.title }}
                  </option>
                </select>
              </div>
              <div class="flex gap-3 justify-items-center items-center my-10">
                <span class="text-medium font-extrabold w-1/5"
                  >Your Message</span
                >
                <hr class="w-4/5" />
              </div>
              <div class="lg:flex gap-3 justify-items-center items-center">
                <jet-label
                  for="subject"
                  value="Subject"
                  class="w-full lg:w-1/4"
                  required="required"
                />
                <jet-input
                  id="subject"
                  type="text"
                  class="mt-1 block w-full lg:w-1/2"
                  v-model="form.subject"
                  required
                  autofocus
                  autocomplete="subject"
                />
              </div>
              <div class="lg:flex gap-3 justify-items-center mt-4">
                <jet-label
                  for="message"
                  value="Message Body"
                  class="w-full lg:w-1/4"
                  required="required"
                />
                <textarea
                  id="message"
                  class="
                    mt-1
                    block
                    w-full
                    lg:w-1/2
                    text-sm
                    border-gray-300
                    focus:border-green-300
                    focus:ring
                    focus:ring-green-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                  "
                  v-model="form.message"
                  required
                  rows="10"
                  autofocus
                  autocomplete="message"
                ></textarea>
              </div>

              <div
                class="mt-4"
                v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
              >
                <jet-label for="terms">
                  <div class="flex items-center">
                    <jet-checkbox
                      name="terms"
                      id="terms"
                      v-model:checked="form.terms"
                    />

                    <div class="ml-2">
                      I agree to the
                      <a
                        target="_blank"
                        :href="route('terms.show')"
                        class="
                          underline
                          text-sm text-gray-600
                          hover:text-gray-900
                        "
                        >Terms of Service</a
                      >
                      and
                      <a
                        target="_blank"
                        :href="route('policy.show')"
                        class="
                          underline
                          text-sm text-gray-600
                          hover:text-gray-900
                        "
                        >Privacy Policy</a
                      >
                    </div>
                  </div>
                </jet-label>
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
                  Submit ticket
                </button>
              </div>
            </form>
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
export default defineComponent({
  components: {
    Head,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
    SideBar,
    FrontLayout,
  },

  data() {
    return {
      loga: this.$inertia.form({
        email: "",
        password: "",
      }),
      form: this.$inertia.form({
        name: this.$page.props.user.name,
        email: this.$page.props.user.email,
        phone: this.$page.props.user.phone,
        address: this.$page.props.user.address,
        business: this.$page.props.user.business,
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
  },
});
</script>
