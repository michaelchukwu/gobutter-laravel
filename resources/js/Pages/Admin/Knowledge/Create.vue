<template>
  <admin-layout title="Create Knowledge">
    <div class="container grid px-6 mx-auto">
      <!-- some modal for section creation
         -->
      <Modal :show="showSectionModal" @close="showSectionModal = false">
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
            <h2>
              {{ sectionForm.edit ? "Edit Section" : "Create Section" }}
            </h2>
            <hr />
          </div>

          <form @submit.prevent="createSection">
            <div>
              <jet-label for="title" value="title" />
              <jet-input
                id="title"
                type="text"
                class="mt-1 block w-full"
                v-model="sectionForm.title"
                required
                autofocus
              />
            </div>
            <div class="mt-4">
              <jet-label for="description" value="Description" />
              <editor
                v-model="sectionForm.description"
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
            <div class="flex items-center justify-end mt-4">
              <jet-button
                class="ml-4 bg-blue-700"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Submit
              </jet-button>
            </div>
          </form>
        </div>
      </Modal>
      <!-- With actions -->
      <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Knowledge
      </h2>
      <!-- CTA -->
      <div
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
      >
        <Link :href="route('kitchn.knowledge.index')">
          <span>&LeftArrow; All Knowledge </span>
        </Link>
        <button @click="toggleSectionModal(false, '', '', '')">
          <span>Create Section &plus;</span>
        </button>
      </div>
      <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Create Knowledge
      </h4>
      <div class="md:grid md:grid-cols-2 md:gap-3">
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
          "
        >
          <form @submit.prevent="submit">
            <jet-validation-errors class="mb-4" />

            <div class="mt-4">
              <jet-label for="title" value="Sections" />
              <jet-input
                placeholder="Title"
                id="title"
                type="text"
                class="mt-1 block w-full"
                v-model="form.title"
                required
                autocomplete="title"
              />
            </div>
            <div class="mt-4">
              <jet-label for="body" value="Article" />
              <editor
                v-model="form.body"
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
            <div class="mt-4">
              <jet-label for="section" value="Section" />
              <select
                v-model="form.section"
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
                  class="p-4"
                  v-for="r in sections"
                  :key="r.id"
                  :value="r.id"
                >
                  {{ r.title }}
                </option>
              </select>
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
          "
        >
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="
                      text-xs
                      font-semibold
                      tracking-wide
                      text-left text-gray-500
                      uppercase
                      border-b
                      dark:border-gray-700
                      bg-gray-50
                      dark:text-gray-400 dark:bg-gray-800
                    "
                  >
                    <th class="px-4 py-3">
                      <span
                        class="inline-flex py-3 pr-6 w-full justify-between"
                        @click="sort('title')"
                        >Title
                        <svg
                          v-if="
                            params.field === 'title' &&
                            params.direction === 'asc'
                          "
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-3 w-3"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M4.293 15.707a1 1 0 010-1.414l5-5a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 0zm0-6a1 1 0 010-1.414l5-5a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L10 5.414 5.707 9.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"
                          />
                        </svg>
                        <svg
                          v-if="
                            params.field === 'title' &&
                            params.direction === 'desc'
                          "
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-3 w-3"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M15.707 4.293a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 011.414-1.414L10 8.586l4.293-4.293a1 1 0 011.414 0zm0 6a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L10 14.586l4.293-4.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </span>
                    </th>
                    <th class="px-4 py-3">Actions</th>
                  </tr>
                </thead>
                <tbody
                  class="
                    bg-white
                    divide-y
                    dark:divide-gray-700 dark:bg-gray-800
                  "
                >
                  <tr
                    v-for="user in sections"
                    :key="user.id"
                    class="text-gray-700 dark:text-gray-400"
                  >
                    <td class="px-4 py-3">
                      <button
                        @click="
                          toggleSectionModal(
                            true,
                            user.id,
                            user.title,
                            user.description
                          )
                        "
                      >
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->

                          <div>
                            <p class="font-semibold">{{ user.title }}</p>
                          </div>
                        </div>
                      </button>
                    </td>

                    <td class="px-4 py-3">
                      <div class="flex items-center space-x-4 text-sm">
                        <button
                          @click="
                            toggleSectionModal(
                              true,
                              user.id,
                              user.title,
                              user.description
                            )
                          "
                          class="
                            flex
                            items-center
                            justify-between
                            px-2
                            py-2
                            text-sm
                            font-medium
                            leading-5
                            text-o-green
                            rounded-lg
                            dark:text-gray-400
                            focus:outline-none focus:shadow-outline-gray
                          "
                          aria-label="Edit"
                        >
                          <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                            ></path>
                          </svg>
                        </button>
                        <button
                          @click="del(user.id)"
                          class="
                            flex
                            items-center
                            justify-between
                            px-2
                            py-2
                            text-sm
                            font-medium
                            leading-5
                            text-red-500
                            rounded-lg
                            dark:text-gray-400
                            focus:outline-none focus:shadow-outline-gray
                          "
                          aria-label="Delete"
                        >
                          <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                              clip-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div
              class="
                grid
                px-4
                py-3
                text-xs
                font-semibold
                tracking-wide
                text-gray-500
                uppercase
                border-t
                dark:border-gray-700
                bg-gray-50
                sm:grid-cols-9
                dark:text-gray-400 dark:bg-gray-800
              "
            >
              <span class="flex items-center col-span-3">
                <!-- Showing 21-30 of 100 -->
              </span>
              <span class="col-span-2"></span>
              <!-- Pagination -->
              <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <!-- <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                      <li>
                        <button
                          class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                          aria-label="Previous"
                        >
                          <svg
                            class="w-4 h-4 fill-current"
                            aria-hidden="true"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"
                              fill-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          1
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          2
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 text-white transition-colors duration-150 bg-o-green border border-r-0 border-o-green rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          3
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          4
                        </button>
                      </li>
                      <li>
                        <span class="px-3 py-1">...</span>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          8
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          9
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                          aria-label="Next"
                        >
                          <svg
                            class="w-4 h-4 fill-current"
                            aria-hidden="true"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              clip-rule="evenodd"
                              fill-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </li>
                    </ul>
                  </nav> -->
                <!-- <pagination class="mt-6" :links="users.links" /> -->
              </span>
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
import Modal from "@/Jetstream/Modal.vue";

export default {
  props: ["sections", "filters"],
  data() {
    return {
      showSectionModal: false,
      allShops: this.shops,
      form: this.$inertia.form({
        title: "",
        body: "",
        section: "",
      }),
      sectionForm: this.$inertia.form({
        id: "",
        title: "",
        description: "",
        edit: false,
      }),
      params: {
        search: this.filters.search,
        field: this.filters.field,
        direction: this.filters.direction,
      },
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
    submit() {
      this.form.post(this.route("kitchn.knowledge.store"), {
        onSuccess: () => this.checkMessage(),
      });
    },
    createSection() {
      if (this.sectionForm.edit) {
        this.sectionForm.put(
          this.route("kitchn.section.update", { id: this.sectionForm.id }),
          {
            onSuccess: () => {
              this.checkMessage(), this.toggleSectionModal();
            },
          }
        );
      } else {
        this.sectionForm.post(this.route("kitchn.section.store"), {
          onSuccess: () => {
            this.checkMessage(), this.toggleSectionModal();
          },
        });
      }
    },
    toggleSectionModal(edit = false, id = "", title = "", description = "") {
      if (edit) {
        this.sectionForm.edit = true;
        this.sectionForm.title = title;
        this.sectionForm.description = description;
        this.sectionForm.id = id;
      } else {
        this.sectionForm.edit = false;
        this.sectionForm.title = "";
        this.sectionForm.description = "";
        this.sectionForm.id = "";
      }
      this.showSectionModal = !this.showSectionModal;
    },
    del(user) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$inertia.delete(route("kitchn.section.destroy", { id: user }), {
            onSuccess: (response) => {
              //   console.log(response.props.users);
              //   this.allUsers = response.props.users;
              Swal.fire("Deleted!", "Info deleted.", "success");
            },
          });
        }
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
