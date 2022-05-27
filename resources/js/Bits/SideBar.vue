<template>
  <div v-if="$page.props.user" class="w-full lg:w-1/4">
    <div class="bg-gray-100 py-12 px-6">
      <div
        class="
          border-b-4
          w-full
          border-o-green
          text-
          black
          font-bold
          text-lg
          mb-5
        "
      >
        Account
      </div>
      <div class="my-5">
        <div class="flex justify-items-center items-center mb-4">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 mr-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
          <Link :href="route('dashboard')">Dashboard</Link>
        </div>
        <div class="flex justify-items-center items-center mb-4">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 mr-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
            />
          </svg>
          <Link :href="route('profile.show')">My Profile</Link>
        </div>
        <div class="flex justify-items-center items-center mb-4">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 mr-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
            />
          </svg>
          <Link :href="route('services')">Services</Link>
        </div>

        <div class="flex justify-items-center items-center mb-4">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 mr-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
            />
          </svg>
          <Link :href="route('password.update')">Change Password</Link>
        </div>
        <div class="flex justify-items-center items-center mb-4">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 mr-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
            />
          </svg>
          <form @submit.prevent="logout">
            <button>Log Out</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="w-full lg:w-1/4">
    <div v-if="showLogin" class="bg-gray-100 py-12 px-6">
      <div
        class="
          border-b-4
          w-full
          border-o-green
          text-
          black
          font-bold
          text-lg
          mb-10
        "
      >
        Log in
      </div>
      <div class="my-10">
        <form @submit.prevent="login">
          <jet-validation-errors class="mb-4" />

          <div>
            <jet-input
              id="email"
              placeholder="Your Email"
              type="email"
              class="mt-1 block w-full py-3"
              v-model="loga.email"
              required
              autofocus
            />
          </div>

          <div class="mt-6">
            <jet-input
              id="password"
              placeholder="Password"
              type="password"
              class="mt-1 block w-full py-3"
              v-model="loga.password"
              required
              autocomplete="current-password"
            />
          </div>

          <div class="block mt-4">
            <label class="flex items-center">
              <jet-checkbox name="remember" v-model:checked="loga.remember" />
              <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
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
              :class="{ 'opacity-25': loga.processing }"
              :disabled="loga.processing"
            >
              Log in
            </button>
          </div>
          <div>
            <button
              class="text-o-green hover:underline transition-all"
              @click="toggleShowForgotPassword"
            >
              Forgot your password?
            </button>
            <div>or</div>
            <Link
              :href="route('signup')"
              class="text-o-green hover:underline transition-all"
            >
              Sign Up
            </Link>
          </div>
        </form>
      </div>
      <div class="text-gray-700 text-sm">
        If you already have a SON SMEs support account, please use the username
        and password for your account to log into the helpdesck. If this is your
        first time, it is not necessary to have a SON SMEs support account to
        login, simply use 'Submit a Ticket' link. Once your ticket is received
        you will receive an email with your ticket details along with the
        password to access it
      </div>
    </div>
    <div v-if="showForgotPassword" class="bg-gray-100 py-12 px-6">
      <div
        class="
          border-b-4
          w-full
          border-o-green
          text-
          black
          font-bold
          text-lg
          mb-10
        "
      >
        Recover Password
      </div>
      <div class="my-10">
        <form @submit.prevent="recover">
          <jet-validation-errors class="mb-4" />

          <div>
            <jet-input
              id="email"
              placeholder="Your Email"
              type="email"
              class="mt-1 block w-full py-3"
              v-model="loga.email"
              required
              autofocus
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
              :class="{ 'opacity-25': loga.processing }"
              :disabled="loga.processing"
            >
              Recover
            </button>
          </div>
        </form>
      </div>
      <div class="text-gray-700 text-sm">
        If you already have a SON SMEs support account, please use the username
        and password for your account to log into the helpdesck. If this is your
        first time, it is not necessary to have a SON SMEs support account to
        login, simply use 'Submit a Ticket' link. Once your ticket is received
        you will receive an email with your ticket details along with the
        password to access it
      </div>
    </div>
  </div>
</template>
<script>
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";

export default {
  name: "SideBar",
  components: {
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },
  data() {
    return {
      showLogin: true,
      showForgotPassword: false,
      loga: this.$inertia.form({
        email: "",
        password: "",
      }),
    };
  },
  methods: {
    toggleLogin() {
      this.showLogin = true;
      this.showForgotPassword = false;
      this.showInputCode = false;
    },
    toggleShowForgotPassword() {
      this.showLogin = false;
      this.showForgotPassword = true;
      this.showInputCode = false;
    },
    logout() {
      this.$inertia.post(route("logout"));
    },
    login() {
      this.loga
        .transform((data) => ({
          ...data,
          remember: this.loga.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.loga.reset("password"),
        });
    },
    recover() {
      this.loga.post(this.route("password.email"), {
        onSuccess: () => {
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
            title: "An email has been sent to you",
          });
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
};
</script>
