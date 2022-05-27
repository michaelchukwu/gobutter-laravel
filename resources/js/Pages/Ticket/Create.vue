<template>
  <front-layout :title="'Create an enquiry'">
    <div class="w-full">
      <div
        class="
          max-w-6xl
          mx-auto
          py-0
          lg:py-10
          flex
          lg:flex-row
          flex-col-reverse
          gap-6
          text-[0.875rem]
        "
      >
        <!-- sidebar  -->
        <side-bar></side-bar>
        <div class="w-full lg:w-3/4 py-12 px-6">
          <div class="text-4xl">Your ticket details</div>
          <div class="text-lg mt-4 font-light">
            Please fill out all the fields with corresponding information
          </div>
          <div>
            <div class="flex gap-3 justify-items-center items-center my-10">
              <span class="text-medium font-extrabold w-1/5"
                >General Information</span
              >
              <hr class="w-4/5" />
            </div>
            <form @submit.prevent="submit">
              <jet-validation-errors class="mb-4" />
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
                  placeholder="+23480xxxxxxxx"
                  autocomplete="phone"
                />
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
              </div>
              <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
                <jet-label
                  for="address"
                  value="Business Address"
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
              </div>
              <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
                <jet-label
                  for="state"
                  value="State"
                  class="w-full lg:w-1/4"
                  required="required"
                />

                <v-select
                  v-model="form.state"
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
                  :options="states"
                  :clearable="false"
                ></v-select>
              </div>
              <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
                <jet-label
                  for="category"
                  value="Product/Services Category"
                  class="w-full lg:w-1/4"
                  required="required"
                />

                <v-select
                  v-model="form.category"
                  class="
                    mt-1
                    block
                    w-full
                    lg:w-1/2
                    border-gray-300
                    focus:border-green-300
                    focus:ring
                    focus:ring-green-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                    text-sm
                  "
                  label="title"
                  :options="categories"
                  :get-option-label="(option) => option.title"
                  :clearable="false"
                >
                  <template #option="{ description, title }">
                    <strong>{{ title }}</strong>
                    <br />
                    <i>{{ description }} </i>
                  </template>
                </v-select>
              </div>
              <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
                <jet-label
                  for="products"
                  value="Products or Services"
                  class="w-full lg:w-1/4"
                  required="required"
                />
                <v-select
                  v-model="form.products"
                  class="
                    mt-1
                    block
                    w-full
                    lg:w-1/2
                    border-gray-300
                    focus:border-green-300
                    focus:ring
                    focus:ring-green-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                    text-sm
                  "
                  taggable
                  multiple
                  push-tags
                  no-drop
                />
              </div>
              <div class="mt-4 lg:flex gap-3 justify-items-center items-center">
                <div class="lg:w-1/4">
                  <jet-label
                    for="msme"
                    value="Category of MSME"
                    class="w-full"
                    required="required"
                  />
                  <small>(No of employees)</small>
                </div>
                <div class="flex gap-2 lg:w-1/2">
                  <label class="flex" for="" v-for="sme in msme" :key="sme.id">
                    <div>
                      <input
                        class="mr-2"
                        type="radio"
                        name="msme"
                        :id="sme.value"
                        v-model="form.msme"
                        :value="sme.value"
                      />
                    </div>
                    <div>
                      <div class="text-sm">{{ sme.title }}</div>
                      <small class="italic font-extralight"
                        >({{ sme.description }})</small
                      >
                    </div>
                  </label>
                </div>
              </div>

              <div class="flex gap-3 justify-items-center items-center my-10">
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
                <v-select
                  v-model="form.service"
                  class="
                    mt-1
                    block
                    w-full
                    lg:w-1/2
                    border-gray-300
                    focus:border-green-300
                    focus:ring
                    focus:ring-green-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                    text-sm
                  "
                  label="title"
                  value="id"
                  :options="$page.props.services"
                  :clearable="false"
                />
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
import "vue-select/dist/vue-select.css";
import vSelect from "vue-select";
import Swal from "sweetalert2";
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
    vSelect,
  },

  data() {
    return {
      msme: [
        { id: 1, title: "Nano", description: "0-5", value: "nano" },
        { id: 2, title: "Micro", description: "5-10", value: "micro" },
        { id: 3, title: "Small", description: "10-49", value: "small" },
        { id: 4, title: "Medium", description: "50-199", value: "medium" },
      ],
      loga: this.$inertia.form({
        email: "",
        password: "",
      }),
      categories: [
        {
          title: "Food Technology",
          description:
            "(eg biscuits, bread, cereals, juices, milk vegetable oil etc)",
        },
        {
          title: "Chemical Technology",
          description:
            "(Air fresheners, disinfectants, bleach, creams/body lotions, engine oil, etc)",
        },
        {
          title: "Civil/Building Engineering",
          description:
            "(cement, burnt bricks, ceramic tiles, concrete blocks, concrete Poles, etc)",
        },
        {
          title: "Electrical/Electronics Engineering",
          description:
            "(Air conditioners, batteries, cables, computers, solar panels, electrical bulbs, sockets, switches, generators, etc.)",
        },
        {
          title: "Textile/Leather",
          description:
            "(baby diapers, baby wipes, bedsheets, belts, foam cover, bags, rugs, shirting materials, towels, umbrellas, etc.) ",
        },
        {
          title: "Mechanical Engineering",
          description:
            "(Aluminum roofing sheets, bicycles, cans/tins, cooking utensils, cylinders, steels bars, etc.) ",
        },
        {
          title: "Services",
          description: "(Laundry, hair dressing/Barbing, Catering, etc.)",
        },
        {
          title: "Others",
          description: "(Any other sector not listed above)",
        },
      ],
      states: [
        "Abia",
        "Adamawa",
        "Akwa Ibom",
        "Anambra",
        "Bauchi",
        "Bayelsa",
        "Benue",
        "Borno",
        "Cross River",
        "Delta",
        "Ebonyi",
        "Edo",
        "Ekiti",
        "Enugu",
        "FCT - Abuja",
        "Gombe",
        "Imo",
        "Jigawa",
        "Kaduna",
        "Kano",
        "Katsina",
        "Kebbi",
        "Kogi",
        "Kwara",
        "Lagos",
        "Nasarawa",
        "Niger",
        "Ogun",
        "Ondo",
        "Osun",
        "Oyo",
        "Plateau",
        "Rivers",
        "Sokoto",
        "Taraba",
        "Yobe",
        "Zamfara",
      ],
      form: this.$inertia.form({
        name: "",
        email: "",
        phone: "",
        address: "",
        business: "",
        service: null,
        subject: "",
        message: "",
        category: "",
        msme: "",
        state: "",
        products: [],
        password: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("ticket.store"), {
        onSuccess: () => {
          this.checkMessage();
          this.form.reset();
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
});
</script>
