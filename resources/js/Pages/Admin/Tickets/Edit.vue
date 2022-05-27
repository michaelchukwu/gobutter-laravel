<template>
  <admin-layout title="Ticket">
    <div class="container grid px-6 mx-auto">
      <Modal :show="forwardOpen" @close="forwardOpen = false">
        <div
          class="
            w-full
            mx-auto
            sm:max-w-md
            mt-6
            px-6
            py-4
            bg-white
            overflow-hidden
          "
        >
          <div class="text-xl font-bold mb-6">
            <h2>Forward Ticket</h2>
            <hr />
            <form @submit.prevent="goForward">
              <div>
                <jet-label for="department" value="Department" />
                <select
                  @change="getAgents($event)"
                  v-model="forward.department"
                  class="
                    mt-1
                    block
                    w-full
                    text-sm
                    border-gray-300
                    focus:border-indigo-300
                    focus:ring
                    focus:ring-indigo-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                  "
                >
                  <option
                    v-for="r in $page.props.services"
                    :key="r.id"
                    :value="r.id"
                  >
                    {{ r.title }}
                  </option>
                </select>
              </div>
              <div class="mt-4">
                <jet-label for="agent" value="Agent" />
                <select
                  v-model="forward.agent"
                  class="
                    mt-1
                    block
                    w-full
                    text-sm
                    border-gray-300
                    focus:border-indigo-300
                    focus:ring
                    focus:ring-indigo-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                  "
                >
                  <option v-for="r in agents" :key="r.id" :value="r.id">
                    {{ r.name }}
                  </option>
                </select>
              </div>
              <div class="mt-4">
                <jet-label for="comment" value="Comment" />
                <textarea
                  v-model="forward.comment"
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

              <div class="flex items-center justify-end mt-4">
                <jet-button
                  class="ml-4 bg-red-700"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Forward
                </jet-button>
              </div>
            </form>
          </div>
        </div>
      </Modal>
      <!-- With actions -->
      <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Ticket
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
        :href="route('kitchn.ticket.index')"
      >
        <span>&LeftArrow; All Tickets </span>
      </Link>
      <div class="flex gap-2">
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
          Ticket #{{ ticket.ticket.number }}
        </h4>
        <span
          v-if="ticket.ticket.status === 'Closed'"
          class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
        >
          Closed
        </span>
        <button
          v-else
          class="
            rounded
            border border-red-700
            text-red-700
            hover:bg-red-700 hover:text-white
            transition-all
            duration-150
            text-lg
            px-3
            mb-4
          "
          @click="close(ticket.ticket)"
        >
          Close
        </button>
        <button
          v-if="ticket.ticket.status != 'Closed'"
          class="
            rounded
            bg-red-700
            text-white
            hover:border-red-700 hover:border hover:text-red-700 hover:bg-white
            transition-all
            duration-150
            text-lg
            px-3
            mb-4
          "
          @click="toggleForward()"
        >
          Forward
        </button>
        <div v-if="ticket.rating">User rating: {{ ticket.rating.rating }}</div>
      </div>
      <div class="text-white bg-gray-700 px-5 py-2 my-6">
        Department:
        <span class="font-bold mr-4">{{ ticket.service.title }}</span>
        Status
        <span class="font-bold">{{ ticket.ticket.status }}</span>
      </div>
      <div class="lg:flex block gap-3">
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
          <form
            @submit.prevent="submit"
            v-if="ticket.ticket.status != 'Closed'"
          >
            <jet-validation-errors class="mb-4" />

            <div class="mt-4">
              <jet-label for="meassge" value="Message" />
              <editor
                v-model="form.message"
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
              Reply
            </jet-button>
          </form>
        </div>
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
          <div class="text-lg border-b border-gray-400 text-gray-600 pb-1 mb-4">
            Quick Responses
          </div>
          <div class="overflow-auto h-full w-full">
            <span
              class="p-3 cursor-pointer shadow rounded ml-2"
              @click="populate(quickie.article)"
              v-for="quickie in ticket.quicks"
              :key="quickie.id"
              v-html="quickie.article"
            ></span>
          </div>
        </div>
      </div>
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
        <div class="mt-6">
          <div class="flex gap-3 mt-6" v-for="m in ticket.messages" :key="m.id">
            <div>
              <img :src="m.user.profile_photo_url" alt="" />
            </div>
            <div>
              <div>
                <span class="font-bold text-medium">{{ m.user.name }}</span>
                <span
                  v-for="r in m.user.roles"
                  :key="r.id"
                  class="
                    ml-3
                    border border-gray-200
                    py-1
                    px-2
                    text-xs
                    rounded-lg
                  "
                  >{{ r.name }}</span
                >
              </div>
              <div class="font-lighter text-xs mt-2">
                Posted on: {{ moment(m.created_at) }}
              </div>
              <div>
                <p v-html="m.body"></p>
              </div>
            </div>
          </div>
        </div>
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
import moment from "moment";
import Modal from "@/Jetstream/Modal.vue";
import axios from "axios";
export default {
  props: {
    ticket: Object,
  },
  data() {
    return {
      forwardOpen: false,
      agents: [],
      form: this.$inertia.form({
        message: "",
      }),
      forward: this.$inertia.form({
        department: "",
        agent: "",
        comment: "",
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
    Modal,
  },
  methods: {
    toggleForward() {
      this.forwardOpen = !this.forwardOpen;
    },
    getAgents(event) {
      axios
        .get(this.route("kitchn.get.agents", { dept: event.target.value }))
        .then((res) => {
          this.agents = [...res.data];
        });
    },
    populate(article) {
      this.form.message = article;
    },
    close(ticket) {
      this.$inertia.get(this.route("kitchn.ticket.close", { ticket: ticket }), {
        onSuccess: () => this.checkMessage(),
      });
    },
    submit() {
      this.form.put(
        this.route("kitchn.ticket.update", { id: this.ticket.ticket.id }),
        {
          onFinish: () => this.form.reset(),
          onSuccess: () => this.checkMessage(),
        }
      );
    },
    goForward() {
      this.forward.post(
        this.route("kitchn.ticket.forward", { id: this.ticket.ticket.id }),
        {
          onFinish: () => this.forward.reset(),
          onSuccess: () => this.checkMessage(),
        }
      );
    },
    moment(date) {
      return moment(date).format("MMMM Do YYYY, h:mm:ss a");
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
