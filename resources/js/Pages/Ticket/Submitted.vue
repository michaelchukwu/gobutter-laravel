<template>
  <front-layout :title="'Ticket Created'">
    <div class="w-full">
      <div
        class="
          max-w-6xl
          mx-auto
          pb-10
          py-0
          lg:pb-0 lg:py-10 lg:flex
          gap-6
          text-[0.875rem]
        "
      >
        <side-bar></side-bar>
        <!-- <div class="w-3/4 py-12 px-6"> -->
        <div v-if="$page.props.temp" class="w-full lg:w-3/4 lg:py-12 px-6">
          <div class="text-4xl">Your request has been received</div>
          <div class="text-lg mt-4 font-light">
            We have received your request and our team will get back to you
            shortly. You can log in to SON SME's helpdesk to review the status
            of your request, or check your email for further updates.
          </div>
          <div>
            <div class="flex gap-3 justify-items-center items-center my-5">
              <span class="text-medium font-extrabold w-1/5"
                >General Information</span
              >
              <hr class="w-4/5" />
            </div>
            <jet-validation-errors class="mb-4" />
            <div class="mt-2 flex gap-3 justify-items-center items-center">
              <span class="w-1/4">
                <jet-label for="name" value="Ticket ID" />
              </span>
              <span class="w-1/2 text-gray-700">
                #{{ $page.props.temp.ticket.number }}
              </span>
            </div>
            <div class="mt-2 flex gap-3 justify-items-center items-center">
              <span class="w-1/4">
                <jet-label for="name" value="First and Last Name" />
              </span>
              <span class="w-1/2 text-gray-700">
                {{ $page.props.temp.user.name }}
              </span>
            </div>
            <div class="mt-2 flex gap-3 justify-items-center items-center">
              <jet-label for="business" value="Business Name" class="w-1/4" />
              <span class="w-1/2 text-gray-700">
                {{ $page.props.temp.user.business }}
              </span>
            </div>
            <div class="mt-2 flex gap-3 justify-items-center items-center">
              <jet-label
                for="category"
                value="Business Category"
                class="w-1/4"
              />
              <span class="w-1/2 text-gray-700">
                {{ $page.props.temp.user.category }}
              </span>
            </div>
            <div class="mt-2 flex gap-3 justify-items-center items-center">
              <jet-label for="phone" value="Phone Number" class="w-1/4" />
              <span class="w-1/2 text-gray-700">
                {{ $page.props.temp.user.phone }}
              </span>
            </div>
            <div class="mt-2 flex gap-3 justify-items-center items-center">
              <jet-label for="email" value="Email Address" class="w-1/4" />
              <span class="w-1/2 text-gray-700">
                {{ $page.props.temp.user.email }}
              </span>
            </div>
            <div class="mt-2 flex gap-3 justify-items-center items-center">
              <jet-label for="address" value="Contact Address" class="w-1/4" />
              <span class="w-1/2 text-gray-700">
                {{ $page.props.temp.user.address
                }}{{ ", " + $page.props.temp.user.state }}
              </span>
            </div>
            <div class="flex gap-3 justify-items-center items-center my-5">
              <span class="text-medium font-extrabold w-1/5"
                >Service Information</span
              >
              <hr class="w-4/5" />
            </div>
            <div class="flex gap-3 justify-items-center items-center">
              <jet-label for="service" value="Required Service" class="w-1/4" />
              <span class="w-1/2 text-gray-700">
                {{ $page.props.temp.service.title }}
              </span>
            </div>
            <div class="flex gap-3 justify-items-center items-center my-5">
              <span class="text-medium font-extrabold w-1/5">Your Message</span>
              <hr class="w-4/5" />
            </div>
            <div class="flex gap-3 justify-items-center items-center">
              <jet-label for="subject" value="Subject" class="w-1/4" />
              <span class="w-1/2 text-gray-700">
                {{ $page.props.temp.message.subject }}
              </span>
            </div>
            <div class="flex gap-3 justify-items-center mt-2">
              <jet-label for="message" value="Message Body" class="w-1/4" />
              <span class="w-1/2 text-gray-700">
                {{ $page.props.temp.message.body }}
              </span>
            </div>
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
    FrontLayout,
    SideBar,
  },

  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        phone: "",
        address: "",
        business: "",
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
