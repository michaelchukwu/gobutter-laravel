<template>
  <front-layout :title="'Sign up'">
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
        <side-bar class="w-full"></side-bar>
      </div>
    </div>
  </front-layout>
</template>

<style scoped>
.style-chooser .vs__search::placeholder,
.style-chooser .vs__dropdown-toggle,
.style-chooser .vs__dropdown-menu {
  background: #dfe5fb;
  border: none;
  color: #394066;
  text-transform: lowercase;
  font-variant: small-caps;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
  fill: #394066;
}
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
import { Link } from "@inertiajs/inertia-vue3";
import FrontLayout from "../Layouts/FrontLayout.vue";
import SideBar from "@/Bits/SideBar.vue";
import "vue-select/dist/vue-select.css";
import vSelect from "vue-select";
import Swal from "sweetalert2";

export default defineComponent({
  components: {
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
        msme: "",
        category: "",
        state: "",
        products: [],
        password: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("signup.store"), {
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
