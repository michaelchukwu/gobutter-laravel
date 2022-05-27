<template>
  <Head :title="title" />
  <div
    class="flex h-screen bg-gray-50 dark:bg-gray-900"
    :class="{ 'overflow-hidden': isSideMenuOpen }"
  >
    <!-- Desktop sidebar -->
    <aside
      class="
        z-20
        hidden
        w-64
        overflow-y-auto
        bg-white
        dark:bg-gray-800
        md:block
        flex-shrink-0
      "
    >
      <div class="py-4 text-gray-500 dark:text-gray-400">
        <a
          class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
          href="#"
        >
          <jet-application-logo class="h-1/2 w-1/2 ml-4"></jet-application-logo>
        </a>
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <span
              v-if="route().current('kitchn.home')"
              class="
                absolute
                inset-y-0
                left-0
                w-1
                bg-o-green
                rounded-tr-lg rounded-br-lg
              "
              aria-hidden="true"
            ></span>
            <Link
              :class="route().current('kitchn.home') ? 'text-gray-800' : ''"
              class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200 dark:text-gray-100
              "
              :href="route('kitchn.home')"
            >
              <svg
                class="w-5 h-5"
                aria-hidden="true"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                ></path>
              </svg>
              <span class="ml-4">Dashboard</span>
            </Link>
          </li>
        </ul>
        <ul>
          <li
            class="relative px-6 py-3"
            v-if="$page.props.isAdmin || $page.props.isHOD"
          >
            <span
              v-if="route().current('kitchn.user.*')"
              class="
                absolute
                inset-y-0
                left-0
                w-1
                bg-o-green
                rounded-tr-lg rounded-br-lg
              "
              aria-hidden="true"
            ></span>
            <Link
              :class="route().current('kitchn.user.*') ? 'text-gray-800' : ''"
              class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200
              "
              :href="route('kitchn.user.index')"
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
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                />
              </svg>
              <span class="ml-4">Staff</span>
            </Link>
          </li>
          <li class="relative px-6 py-3" v-if="!$page.props.isEditor">
            <span
              v-if="route().current('kitchn.business.*')"
              class="
                absolute
                inset-y-0
                left-0
                w-1
                bg-o-green
                rounded-tr-lg rounded-br-lg
              "
              aria-hidden="true"
            ></span>
            <Link
              :class="
                route().current('kitchn.business.*') ? 'text-gray-800' : ''
              "
              class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200
              "
              :href="route('kitchn.business.index')"
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
                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                />
              </svg>
              <span class="ml-4">Businesses</span>
            </Link>
          </li>
          <li
            class="relative px-6 py-3"
            v-if="
              $page.props.isAdmin || $page.props.isHOD || $page.props.isEditor
            "
          >
            <span
              v-if="route().current('kitchn.faq.*')"
              class="
                absolute
                inset-y-0
                left-0
                w-1
                bg-o-green
                rounded-tr-lg rounded-br-lg
              "
              aria-hidden="true"
            ></span>
            <Link
              :class="route().current('kitchn.faq.*') ? 'text-gray-800' : ''"
              class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200
              "
              :href="route('kitchn.faq.index')"
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
                  d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
              <span class="ml-4">FAQs</span>
            </Link>
          </li>
          <li
            class="relative px-6 py-3"
            v-if="
              $page.props.isAdmin || $page.props.isHOD || $page.props.isEditor
            "
          >
            <span
              v-if="route().current('kitchn.knowledge.*')"
              class="
                absolute
                inset-y-0
                left-0
                w-1
                bg-o-green
                rounded-tr-lg rounded-br-lg
              "
              aria-hidden="true"
            ></span>
            <Link
              :class="
                route().current('kitchn.knowledge.*') ? 'text-gray-800' : ''
              "
              class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200
              "
              :href="route('kitchn.knowledge.index')"
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
                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                />
              </svg>
              <span class="ml-4">Knowledgebase</span>
            </Link>
          </li>
          <li
            class="relative px-6 py-3"
            v-if="$page.props.isAdmin || $page.props.isEditor"
          >
            <span
              v-if="route().current('kitchn.chat.*')"
              class="
                absolute
                inset-y-0
                left-0
                w-1
                bg-o-green
                rounded-tr-lg rounded-br-lg
              "
              aria-hidden="true"
            ></span>
            <Link
              :class="route().current('kitchn.chat.*') ? 'text-gray-800' : ''"
              class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200
              "
              :href="route('kitchn.chat.index')"
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
                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                />
              </svg>
              <span class="ml-4">Chat</span>
            </Link>
          </li>
          <li class="relative px-6 py-3" v-if="$page.props.isAdmin">
            <span
              v-if="route().current('kitchn.service.*')"
              class="
                absolute
                inset-y-0
                left-0
                w-1
                bg-o-green
                rounded-tr-lg rounded-br-lg
              "
              aria-hidden="true"
            ></span>
            <Link
              :class="
                route().current('kitchn.service.*') ? 'text-gray-800' : ''
              "
              class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200
              "
              :href="route('kitchn.service.index')"
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
                  d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"
                />
              </svg>
              <span class="ml-4">Departments</span>
            </Link>
          </li>
          <li class="relative px-6 py-3" v-if="!$page.props.isEditor">
            <span
              v-if="route().current('kitchn.report')"
              class="
                absolute
                inset-y-0
                left-0
                w-1
                bg-o-green
                rounded-tr-lg rounded-br-lg
              "
              aria-hidden="true"
            ></span>
            <Link
              :class="route().current('kitchn.report') ? 'text-gray-800' : ''"
              class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200
              "
              :href="route('kitchn.report')"
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
                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                />
              </svg>
              <span class="ml-4">Reports</span>
            </Link>
          </li>
          <li class="relative px-6 py-3" v-if="$page.props.isAdmin">
            <span
              v-if="route().current('kitchn.backup.index')"
              class="
                absolute
                inset-y-0
                left-0
                w-1
                bg-o-green
                rounded-tr-lg rounded-br-lg
              "
              aria-hidden="true"
            ></span>
            <Link
              :class="
                route().current('kitchn.backup.index') ? 'text-gray-800' : ''
              "
              class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200
              "
              :href="route('kitchn.backup.index')"
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
                  d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3"
                />
              </svg>
              <span class="ml-4">Backup files</span>
            </Link>
          </li>
        </ul>
        <div class="px-6 my-6">
          <Link
            v-if="!$page.props.isEditor"
            :href="route('kitchn.ticket.index')"
            class="
              flex
              items-center
              justify-between
              w-full
              px-4
              py-2
              text-sm
              font-medium
              leading-5
              text-white
              transition-colors
              duration-150
              bg-o-green
              border border-transparent
              rounded-lg
              active:bg-o-green
              hover:bg-green-500
              focus:outline-none focus:shadow-outline-purple
            "
          >
            Tickets
            <span class="ml-2" aria-hidden="true">+</span>
          </Link>
        </div>
        <div class="px-6 my-6" v-if="$page.props.isAdmin">
          <Link
            :href="route('kitchn.backup.now')"
            class="
              flex
              items-center
              justify-between
              w-full
              px-4
              py-2
              text-sm
              font-medium
              leading-5
              text-white
              transition-colors
              duration-150
              bg-o-yellow
              border border-transparent
              rounded-lg
              active:bg-o-green
              hover:bg-yellow-500
              focus:outline-none focus:shadow-outline-purple
            "
          >
            Backup now
            <span class="ml-2" aria-hidden="true"
              ><svg
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
                  d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3"
                /></svg
            ></span>
          </Link>
        </div>
      </div>
    </aside>
    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    <transition
      name="side-menu-slide"
      enter-active-class="transition ease-in-out duration-150"
      enter-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in-out duration-150"
      leave-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-show="isSideMenuOpen"
        @click="toggleSideMenu"
        class="
          fixed
          inset-0
          z-10
          flex
          items-end
          bg-black bg-opacity-50
          sm:items-center sm:justify-center
        "
      ></div>
    </transition>
    <transition
      name="slide"
      enter-active-class="transition ease-in-out duration-150"
      enter-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in-out duration-150"
      leave-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <aside
        class="
          fixed
          inset-y-0
          z-20
          flex-shrink-0
          w-64
          mt-16
          overflow-y-auto
          bg-white
          dark:bg-gray-800
          md:hidden
          transition
          ease-in-out
          duration-150
        "
        v-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @keydown.esc="toggleSideMenu"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
            <jet-application-logo
              class="h-1/2 w-1/2 ml-4"
            ></jet-application-logo>
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                v-if="route().current('kitchn.home')"
                class="
                  absolute
                  inset-y-0
                  left-0
                  w-1
                  bg-o-green
                  rounded-tr-lg rounded-br-lg
                "
                aria-hidden="true"
              ></span>
              <Link
                :class="route().current('kitchn.home') ? 'text-gray-800' : ''"
                class="
                  inline-flex
                  items-center
                  w-full
                  text-sm
                  font-semibold
                  transition-colors
                  duration-150
                  hover:text-gray-800
                  dark:hover:text-gray-200 dark:text-gray-100
                "
                :href="route('kitchn.home')"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Dashboard</span>
              </Link>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <span
                v-if="route().current('kitchn.user.*')"
                class="
                  absolute
                  inset-y-0
                  left-0
                  w-1
                  bg-o-green
                  rounded-tr-lg rounded-br-lg
                "
                aria-hidden="true"
              ></span>
              <Link
                :class="route().current('kitchn.user.*') ? 'text-gray-800' : ''"
                class="
                  inline-flex
                  items-center
                  w-full
                  text-sm
                  font-semibold
                  transition-colors
                  duration-150
                  hover:text-gray-800
                  dark:hover:text-gray-200
                "
                :href="route('kitchn.user.index')"
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
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                  />
                </svg>
                <span class="ml-4">Users</span>
              </Link>
            </li>
            <li class="relative px-6 py-3" v-if="!$page.props.isEditor">
              <span
                v-if="route().current('kitchn.business.*')"
                class="
                  absolute
                  inset-y-0
                  left-0
                  w-1
                  bg-o-green
                  rounded-tr-lg rounded-br-lg
                "
                aria-hidden="true"
              ></span>
              <Link
                :class="
                  route().current('kitchn.business.*') ? 'text-gray-800' : ''
                "
                class="
                  inline-flex
                  items-center
                  w-full
                  text-sm
                  font-semibold
                  transition-colors
                  duration-150
                  hover:text-gray-800
                  dark:hover:text-gray-200
                "
                :href="route('kitchn.business.index')"
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
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                  />
                </svg>
                <span class="ml-4">Businesses</span>
              </Link>
            </li>
            <li
              class="relative px-6 py-3"
              v-if="$page.props.isAdmin || $page.props.HOD"
            >
              <span
                v-if="route().current('kitchn.faq.*')"
                class="
                  absolute
                  inset-y-0
                  left-0
                  w-1
                  bg-o-green
                  rounded-tr-lg rounded-br-lg
                "
                aria-hidden="true"
              ></span>
              <Link
                :class="route().current('kitchn.faq.*') ? 'text-gray-800' : ''"
                class="
                  inline-flex
                  items-center
                  w-full
                  text-sm
                  font-semibold
                  transition-colors
                  duration-150
                  hover:text-gray-800
                  dark:hover:text-gray-200
                "
                :href="route('kitchn.faq.index')"
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
                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
                <span class="ml-4">FAQs</span>
              </Link>
            </li>
            <li
              class="relative px-6 py-3"
              v-if="$page.props.isAdmin || $page.props.HOD"
            >
              <span
                v-if="route().current('kitchn.knowledge.*')"
                class="
                  absolute
                  inset-y-0
                  left-0
                  w-1
                  bg-o-green
                  rounded-tr-lg rounded-br-lg
                "
                aria-hidden="true"
              ></span>
              <Link
                :class="
                  route().current('kitchn.knowledge.*') ? 'text-gray-800' : ''
                "
                class="
                  inline-flex
                  items-center
                  w-full
                  text-sm
                  font-semibold
                  transition-colors
                  duration-150
                  hover:text-gray-800
                  dark:hover:text-gray-200
                "
                :href="route('kitchn.knowledge.index')"
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
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                  />
                </svg>
                <span class="ml-4">Knowledgebase</span>
              </Link>
            </li>
            <li class="relative px-6 py-3" v-if="$page.props.isAdmin">
              <span
                v-if="route().current('kitchn.chat.*')"
                class="
                  absolute
                  inset-y-0
                  left-0
                  w-1
                  bg-o-green
                  rounded-tr-lg rounded-br-lg
                "
                aria-hidden="true"
              ></span>
              <Link
                :class="route().current('kitchn.chat.*') ? 'text-gray-800' : ''"
                class="
                  inline-flex
                  items-center
                  w-full
                  text-sm
                  font-semibold
                  transition-colors
                  duration-150
                  hover:text-gray-800
                  dark:hover:text-gray-200
                "
                :href="route('kitchn.chat.index')"
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
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                  />
                </svg>
                <span class="ml-4">Chat</span>
              </Link>
            </li>
            <li class="relative px-6 py-3" v-if="$page.props.isAdmin">
              <span
                v-if="route().current('kitchn.service.*')"
                class="
                  absolute
                  inset-y-0
                  left-0
                  w-1
                  bg-o-green
                  rounded-tr-lg rounded-br-lg
                "
                aria-hidden="true"
              ></span>
              <Link
                :class="
                  route().current('kitchn.service.*') ? 'text-gray-800' : ''
                "
                class="
                  inline-flex
                  items-center
                  w-full
                  text-sm
                  font-semibold
                  transition-colors
                  duration-150
                  hover:text-gray-800
                  dark:hover:text-gray-200
                "
                :href="route('kitchn.service.index')"
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
                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"
                  />
                </svg>
                <span class="ml-4">Departments</span>
              </Link>
            </li>
            <li class="relative px-6 py-3">
              <span
                v-if="route().current('kitchn.report')"
                class="
                  absolute
                  inset-y-0
                  left-0
                  w-1
                  bg-o-green
                  rounded-tr-lg rounded-br-lg
                "
                aria-hidden="true"
              ></span>
              <Link
                :class="route().current('kitchn.report') ? 'text-gray-800' : ''"
                class="
                  inline-flex
                  items-center
                  w-full
                  text-sm
                  font-semibold
                  transition-colors
                  duration-150
                  hover:text-gray-800
                  dark:hover:text-gray-200
                "
                :href="route('kitchn.report')"
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
                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                  />
                </svg>
                <span class="ml-4">Reports</span>
              </Link>
            </li>
            <li class="relative px-6 py-3" v-if="$page.props.isAdmin">
              <span
                v-if="route().current('kitchn.backup.index')"
                class="
                  absolute
                  inset-y-0
                  left-0
                  w-1
                  bg-o-green
                  rounded-tr-lg rounded-br-lg
                "
                aria-hidden="true"
              ></span>
              <Link
                :class="
                  route().current('kitchn.backup.index') ? 'text-gray-800' : ''
                "
                class="
                  inline-flex
                  items-center
                  w-full
                  text-sm
                  font-semibold
                  transition-colors
                  duration-150
                  hover:text-gray-800
                  dark:hover:text-gray-200
                "
                :href="route('kitchn.backup.index')"
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
                    d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3"
                  />
                </svg>
                <span class="ml-4">Backup files</span>
              </Link>
            </li>
          </ul>
          <div class="px-6 my-6">
            <Link
              :href="route('kitchn.ticket.index')"
              class="
                flex
                items-center
                justify-between
                w-full
                px-4
                py-2
                text-sm
                font-medium
                leading-5
                text-white
                transition-colors
                duration-150
                bg-o-green
                border border-transparent
                rounded-lg
                active:bg-o-green
                hover:bg-green-500
                focus:outline-none focus:shadow-outline-purple
              "
            >
              Tickets
              <span class="ml-2" aria-hidden="true">+</span>
            </Link>
          </div>
          <div class="px-6 my-6" v-if="$page.props.isAdmin">
            <Link
              :href="route('kitchn.backup.now')"
              class="
                flex
                items-center
                justify-between
                w-full
                px-4
                py-2
                text-sm
                font-medium
                leading-5
                text-white
                transition-colors
                duration-150
                bg-o-yellow
                border border-transparent
                rounded-lg
                active:bg-o-yellow
                hover:bg-yellow-500
                focus:outline-none focus:shadow-outline-purple
              "
            >
              Backup now
              <span class="ml-2" aria-hidden="true">
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
                    d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3"
                  />
                </svg>
              </span>
            </Link>
          </div>
        </div>
      </aside>
    </transition>
    <div class="flex flex-col flex-1 w-full">
      <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
        <div
          class="
            container
            flex
            items-center
            justify-between
            h-full
            px-6
            mx-auto
            text-o-green
            dark:text-purple-300
          "
        >
          <!-- Mobile hamburger -->
          <button
            class="
              p-1
              mr-5
              -ml-1
              rounded-md
              md:hidden
              focus:outline-none focus:shadow-outline-purple
            "
            @click="toggleSideMenu"
            aria-label="Menu"
          >
            <svg
              class="w-6 h-6"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </button>
          <!-- Search input -->
          <div class="flex justify-center flex-1 lg:mr-32">
            <div
              class="
                relative
                text-white
                dark:text-white
                w-full
                max-w-xl
                mr-6
                focus-within:text-white
              "
            >
              <div class="absolute inset-y-0 flex items-center pl-2">
                <svg
                  class="w-4 h-4"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </div>
              <!-- <input
                class="
                  w-full
                  pl-8
                  pr-2
                  text-sm text-gray-700
                  placeholder-gray-600
                  bg-gray-100
                  border-0
                  rounded-md
                  dark:placeholder-gray-500
                  dark:focus:shadow-outline-gray
                  dark:focus:placeholder-gray-600
                  dark:bg-gray-700
                  dark:text-gray-200
                  focus:placeholder-gray-500
                  focus:bg-white
                  focus:border-o-green
                  focus:outline-none
                  focus:shadow-outline-purple
                  form-input
                "
                type="text"
                placeholder="Search for tickets"
                aria-label="Search"
              /> -->
            </div>
          </div>
          <ul class="flex items-center flex-shrink-0 space-x-6">
            <!-- Theme toggler -->
            <li class="flex">
              <button
                class="
                  rounded-md
                  focus:outline-none focus:shadow-outline-purple
                "
                @click="toggleTheme"
                aria-label="Toggle color mode"
              >
                <template x-if="!dark">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                    ></path>
                  </svg>
                </template>
                <template x-if="dark">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </template>
              </button>
            </li>
            <!-- Notifications menu -->
            <li class="relative">
              <Link :href="route('kitchn.notifications')">
                <button
                  class="
                    relative
                    align-middle
                    rounded-md
                    focus:outline-none focus:shadow-outline-purple
                  "
                  @click="toggleNotificationsMenu"
                  @keydown.escape="closeNotificationsMenu"
                  aria-label="Notifications"
                  aria-haspopup="true"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                    ></path>
                  </svg>
                  <!-- Notification badge -->
                  <span
                    v-if="$page.props.unreadNotificationsCount > 0"
                    aria-hidden="true"
                    class="
                      absolute
                      top-0
                      right-0
                      inline-block
                      w-3
                      h-3
                      transform
                      translate-x-1
                      -translate-y-1
                      bg-red-600
                      border-2 border-white
                      rounded-full
                      dark:border-gray-800
                    "
                  ></span>
                </button>
              </Link>
              <template x-if="isNotificationsMenuOpen">
                <ul
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100"
                  x-transition:leave-end="opacity-0"
                  @click="closeNotificationsMenu"
                  @keydown.escape="closeNotificationsMenu"
                  class="
                    absolute
                    right-0
                    w-56
                    p-2
                    mt-2
                    space-y-2
                    text-gray-600
                    bg-white
                    border border-gray-100
                    rounded-md
                    shadow-md
                    dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700
                  "
                >
                  <li class="flex">
                    <a
                      class="
                        inline-flex
                        items-center
                        justify-between
                        w-full
                        px-2
                        py-1
                        text-sm
                        font-semibold
                        transition-colors
                        duration-150
                        rounded-md
                        hover:bg-gray-100 hover:text-gray-800
                        dark:hover:bg-gray-800 dark:hover:text-gray-200
                      "
                      href="#"
                    >
                      <span>Messages</span>
                      <span
                        class="
                          inline-flex
                          items-center
                          justify-center
                          px-2
                          py-1
                          text-xs
                          font-bold
                          leading-none
                          text-red-600
                          bg-red-100
                          rounded-full
                          dark:text-red-100 dark:bg-red-600
                        "
                      >
                        13
                      </span>
                    </a>
                  </li>
                  <li class="flex">
                    <a
                      class="
                        inline-flex
                        items-center
                        justify-between
                        w-full
                        px-2
                        py-1
                        text-sm
                        font-semibold
                        transition-colors
                        duration-150
                        rounded-md
                        hover:bg-gray-100 hover:text-gray-800
                        dark:hover:bg-gray-800 dark:hover:text-gray-200
                      "
                      href="#"
                    >
                      <span>Sales</span>
                      <span
                        class="
                          inline-flex
                          items-center
                          justify-center
                          px-2
                          py-1
                          text-xs
                          font-bold
                          leading-none
                          text-red-600
                          bg-red-100
                          rounded-full
                          dark:text-red-100 dark:bg-red-600
                        "
                      >
                        2
                      </span>
                    </a>
                  </li>
                  <li class="flex">
                    <a
                      class="
                        inline-flex
                        items-center
                        justify-between
                        w-full
                        px-2
                        py-1
                        text-sm
                        font-semibold
                        transition-colors
                        duration-150
                        rounded-md
                        hover:bg-gray-100 hover:text-gray-800
                        dark:hover:bg-gray-800 dark:hover:text-gray-200
                      "
                      href="#"
                    >
                      <span>Alerts</span>
                    </a>
                  </li>
                </ul>
              </template>
            </li>
            <!-- Profile menu -->
            <li class="relative">
              <button
                class="
                  align-middle
                  rounded-full
                  focus:shadow-outline-purple focus:outline-none
                  flex
                  gap-1
                "
                @click="toggleProfileMenu"
                @keydown.escape="closeProfileMenu"
                aria-label="Account"
                aria-haspopup="true"
              >
                <img
                  class="object-cover w-8 h-8 rounded-full"
                  :src="$page.props.user.profile_photo_url"
                  :alt="$page.props.user.name"
                  aria-hidden="true"
                />
                <span
                  class="
                    flex flex-col
                    text-black text-sm text-left
                    items-center
                  "
                >
                  <strong class="hidden lg:block">{{
                    $page.props.user.name
                  }}</strong>
                </span>
              </button>
              <template v-if="isProfileMenuOpen">
                <ul
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100"
                  x-transition:leave-end="opacity-0"
                  @click="closeProfileMenu"
                  @keydown.escape="closeProfileMenu"
                  class="
                    absolute
                    right-0
                    w-56
                    p-2
                    mt-2
                    space-y-2
                    text-gray-600
                    bg-white
                    border border-gray-100
                    rounded-md
                    shadow-md
                    dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700
                  "
                  aria-label="submenu"
                >
                  <li
                    class="
                      flex
                      hover:bg-gray-100 hover:text-gray-800
                      dark:hover:bg-gray-800 dark:hover:text-gray-200
                    "
                  >
                    <form @submit.prevent="logout">
                      <button
                        class="
                          inline-flex
                          items-center
                          w-full
                          px-2
                          py-1
                          text-sm
                          font-semibold
                          transition-colors
                          duration-150
                          rounded-md
                        "
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        Log Out
                      </button>
                    </form>
                  </li>
                </ul>
              </template>
            </li>
          </ul>
        </div>
      </header>
      <main class="h-full overflow-y-auto">
        <slot></slot>
      </main>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default defineComponent({
  props: {
    title: String,
  },

  components: {
    Head,
    JetApplicationLogo,
    JetBanner,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink,
    Link,
  },

  data() {
    return {
      isSideMenuOpen: false,
      isProfileMenuOpen: false,
      showingNavigationDropdown: false,
    };
  },

  methods: {
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen;
    },
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen;
    },
    logout() {
      axios.post(route("logout")).then(() => {
        window.location = route("login");
      });
    },
  },
});
</script>
