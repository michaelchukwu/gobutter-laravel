<template>
  <admin-layout title="FAQs">
    <div class="container grid px-6 mx-auto">
      <!-- With actions -->
      <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        FAQs
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
        :href="route('kitchn.faq.create')"
      >
        <span>Create FAQ &plus;</span>
      </Link>
      <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        All FAQs
      </h4>
      <div class="mb-10 flex gap-4">
        <jet-input
          id="search"
          type="search"
          class="mt-1 block w-full md:w-1/2"
          v-model="params.search"
          required
          autofocus
          autocomplete="search"
          placeholder="Search Questions and Answers"
        />
        <span class="flex gap-3"
          ><jet-input
            type="date"
            id="start_date"
            @change="changeStart"
            v-model="params.start_date"
            class="mt-1 block w-full md:w-1/2"
          />
          <jet-input
            type="date"
            id="end_date"
            v-model="params.end_date"
            class="mt-1 block w-full md:w-1/2"
            readonly
          />
        </span>
      </div>
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
                    @click="sort('question')"
                    >Question
                    <svg
                      v-if="
                        params.field === 'question' &&
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
                        params.field === 'question' &&
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
                <th class="px-4 py-3">
                  <span
                    class="inline-flex py-3 pr-6 w-full justify-between"
                    @click="sort('answer')"
                    >Answer
                    <svg
                      v-if="
                        params.field === 'answer' && params.direction === 'asc'
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
                        params.field === 'answer' && params.direction === 'desc'
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
                <th class="px-4 py-3">
                  <span
                    class="inline-flex py-3 pr-6 w-full justify-between"
                    @click="sort('created_at')"
                    >Creation Date
                    <svg
                      v-if="
                        params.field === 'created_at' &&
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
                        params.field === 'created_at' &&
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
              class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
            >
              <tr
                v-for="user in users.data"
                :key="user.id"
                class="text-gray-700 dark:text-gray-400"
              >
                <td class="px-4 py-3">
                  <Link :href="route('kitchn.faq.edit', { faq: user })">
                    <div class="flex items-center text-sm">
                      <!-- Avatar with inset shadow -->

                      <div>
                        <p class="font-semibold">{{ user.question }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                          <!-- {{shop.rating}} -->
                        </p>
                      </div>
                    </div>
                  </Link>
                </td>
                <td class="px-4 py-3 text-sm" v-html="user.answer"></td>
                <td class="px-4 py-3 text-sm">
                  {{ moment(user.created_at) }}
                </td>
                <td class="px-4 py-3">
                  <div class="flex items-center space-x-4 text-sm">
                    <Link
                      :href="route('kitchn.faq.edit', { faq: user })"
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
                    </Link>
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
                        text-red-600
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
                          class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple"
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
            <pagination class="mt-6" :links="users.links" />
          </span>
        </div>
      </div>
    </div>
  </admin-layout>
</template>
<script>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import JetInput from "@/Jetstream/Input.vue";

import { Link } from "@inertiajs/inertia-vue3";
import moment from "moment";
import Swal from "sweetalert2";
import Pagination from "../../../Bits/Pagination.vue";
import _ from "lodash";
export default {
  props: {
    users: Object,
    filters: Object,
  },
  data() {
    return {
      //allUsers: this.users,
      params: {
        search: this.filters.search,
        field: this.filters.field,
        direction: this.filters.direction,
        start_date: this.filters.start_date,
        end_date: this.filters.end_date,
      },
    };
  },
  components: {
    AdminLayout,
    Link,
    Swal,
    Pagination,
    JetInput,
  },
  methods: {
    moment(date) {
      // var myDate = new Date(date*1000);
      return moment(date).format("MMMM Do YYYY, h:mm:ss a");
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
          this.$inertia.delete(route("kitchn.faq.destroy", { id: user }), {
            onSuccess: (response) => {
              // console.log(response.props.users);
              // this.allUsers = response.props.users;
              Swal.fire("Deleted!", "FAQ deleted.", "success");
            },
          });
        }
      });
    },
    changeStart() {
      document.getElementById("end_date").removeAttribute("readonly");
      // set the min for end date
      document
        .getElementById("end_date")
        .setAttribute("min", document.getElementById("start_date").value);
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
    sort(field) {
      this.params.field = field;
      this.params.direction = this.params.direction === "asc" ? "desc" : "asc";
    },
  },
  watch: {
    params: {
      handler: _.throttle(function () {
        let params = _.pickBy(this.params);

        // Object.keys(params).forEach(key=>{
        //     if(params[key] == ''){
        //         delete params[key];
        //     }
        // })

        this.$inertia.get(this.route("kitchn.faq.index"), params, {
          replace: true,
          preserveState: true,
        });
      }, 150),
      deep: true,
    },
  },
};
</script>
