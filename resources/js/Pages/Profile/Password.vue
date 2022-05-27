<template>
  <front-layout title="Profile">
    <div class="w-full">
      <div
        class="
          max-w-6xl
          mx-auto
          py-0
          pb-10
          lg:py-10 lg:flex
          gap-6
          text-[0.875rem]
        "
      >
        <side-bar></side-bar>
        <div class="w-full lg:w-3/4 px-6">
          <div class="w-full text-2xl py-4 px-3 bg-o-yellow">
            Change Password
          </div>
          <update-password-form class="mt-10 sm:mt-0" />
        </div>
      </div>
    </div>
  </front-layout>
</template>

<script>
import { defineComponent } from "vue";
import SideBar from "@/Bits/SideBar.vue";
import FrontLayout from "@/Layouts/FrontLayout.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";

export default defineComponent({
  props: ["sessions"],

  components: {
    FrontLayout,
    JetValidationErrors,
    UpdatePasswordForm,
    SideBar,
  },
});
</script>
