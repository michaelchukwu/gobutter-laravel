<template>
  <div>
    <div class="hidden lg:block w-full bg-[#01a372]">
      <div class="max-w-5xl mx-auto text-white flex gap-6 text-[0.875rem]">
        <div class="py-3 flex gap-6">
          <span class="flex gap-3 items-center font-light text-sm">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 text-[#fde428]"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
              />
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
              />
            </svg>
            52, Lome Crescent, Zone 7, Wuse, Abuja
          </span>
          <span class="flex gap-3 items-center font-light text-sm">
            <i class="fa fa-clock-o"></i>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 text-[#fde428]"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
              />
            </svg>
            Mon - Fri 8.00 - 16.00.
          </span>

          <span class="flex gap-3 items-center font-light text-sm">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 text-[#fde428]"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
              />
            </svg>
            Toll-Free 08002255766
          </span>
        </div>
        <div>
          <Link
            :href="route('signup')"
            class="
              bg-[#fde428]
              h-full
              flex
              items-center
              px-12
              ml-4
              text-[#01a372] text-sm
              font-bold
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-3 w-3 mr-1"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
              />
            </svg>
            {{ $page.props.user ? "Account" : "Register/Login" }}
          </Link>
        </div>
      </div>
    </div>
    <div class="hidden lg:block w-full bg-white shadow">
      <div class="max-w-6xl mx-auto py-3 flex items-center">
        <div>
          <a href="son.gov.ng">
            <img
              src="https://son.gov.ng/wp-content/uploads/2021/02/SON-LOGO-2.jpeg"
            />
          </a>
        </div>
        <div class="ml-14">
          <div class="flex justify-end mb-3">
            <span class="px-2"
              ><svg
                class="w-5 h-5"
                fill="#01a372"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24px"
                height="24px"
              >
                <path
                  d="M17.525,9H14V7c0-1.032,0.084-1.682,1.563-1.682h1.868v-3.18C16.522,2.044,15.608,1.998,14.693,2 C11.98,2,10,3.657,10,6.699V9H7v4l3-0.001V22h4v-9.003l3.066-0.001L17.525,9z"
                /></svg
            ></span>
            <span class="px-2"
              ><svg
                class="w-5 h-5"
                fill="#01a372"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 30 30"
                width="30px"
                height="30px"
              >
                <path
                  d="M28,6.937c-0.957,0.425-1.985,0.711-3.064,0.84c1.102-0.66,1.947-1.705,2.345-2.951c-1.03,0.611-2.172,1.055-3.388,1.295 c-0.973-1.037-2.359-1.685-3.893-1.685c-2.946,0-5.334,2.389-5.334,5.334c0,0.418,0.048,0.826,0.138,1.215 c-4.433-0.222-8.363-2.346-10.995-5.574C3.351,6.199,3.088,7.115,3.088,8.094c0,1.85,0.941,3.483,2.372,4.439 c-0.874-0.028-1.697-0.268-2.416-0.667c0,0.023,0,0.044,0,0.067c0,2.585,1.838,4.741,4.279,5.23 c-0.447,0.122-0.919,0.187-1.406,0.187c-0.343,0-0.678-0.034-1.003-0.095c0.679,2.119,2.649,3.662,4.983,3.705 c-1.825,1.431-4.125,2.284-6.625,2.284c-0.43,0-0.855-0.025-1.273-0.075c2.361,1.513,5.164,2.396,8.177,2.396 c9.812,0,15.176-8.128,15.176-15.177c0-0.231-0.005-0.461-0.015-0.69C26.38,8.945,27.285,8.006,28,6.937z"
                /></svg
            ></span>

            <span class="px-2"
              ><svg
                class="w-5 h-5"
                fill="#01a372"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 32 32"
                width="32px"
                height="32px"
              >
                <path
                  d="M 11 7 C 6.027344 7 2 11.027344 2 16 C 2 20.972656 6.027344 25 11 25 C 15.972656 25 20 20.972656 20 16 C 20 15.382813 19.933594 14.78125 19.8125 14.199219 L 19.765625 14 L 11 14 L 11 17 L 17 17 C 16.523438 19.835938 13.972656 22 11 22 C 7.6875 22 5 19.3125 5 16 C 5 12.6875 7.6875 10 11 10 C 12.5 10 13.867188 10.554688 14.921875 11.464844 L 17.070313 9.359375 C 15.46875 7.894531 13.339844 7 11 7 Z M 25 11 L 25 14 L 22 14 L 22 16 L 25 16 L 25 19 L 27 19 L 27 16 L 30 16 L 30 14 L 27 14 L 27 11 Z"
                /></svg
            ></span>
            <span class="px-2"
              ><svg
                class="w-5 h-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 48 48"
                width="48px"
                height="48px"
              >
                <path
                  fill="#01a372"
                  d="M8.421 14h.052 0C11.263 14 13 12 13 9.5 12.948 6.945 11.263 5 8.526 5 5.789 5 4 6.945 4 9.5 4 12 5.736 14 8.421 14zM4 17H13V43H4zM44 26.5c0-5.247-4.253-9.5-9.5-9.5-3.053 0-5.762 1.446-7.5 3.684V17h-9v26h9V28h0c0-2.209 1.791-4 4-4s4 1.791 4 4v15h9C44 43 44 27.955 44 26.5z"
                /></svg
            ></span>
          </div>
          <div
            class="text-[#01a372] text-[16px] font-bold tracking-tighter flex"
          >
            <span class="px-5"><a href="https://son.gov.ng/">Home</a></span>

            <son-link v-for="menu in $page.props.menu_1" :key="menu">
              <template v-slot:title>
                <a href="#">{{ menu.parent.title }}</a>
              </template>
              <template v-slot:content>
                <a
                  v-for="men in menu.child"
                  :key="men.id"
                  href="https://son.gov.ng/about-son"
                  class="
                    block
                    px-4
                    py-2
                    text-sm text-black
                    hover:bg-o-green hover:text-white
                  "
                >
                  {{ men.title }}
                </a>
              </template>
            </son-link>
          </div>
        </div>
      </div>
    </div>
    <!-- mobile header  -->
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
      @keydown="toggleSideMenu"
    >
      <aside
        class="
          fixed
          inset-y-0
          z-20
          flex-shrink-0
          w-64
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
                v-if="route().current('dashboard')"
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
                :class="route().current('dashboard') ? 'text-gray-800' : ''"
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
                :href="route('dashboard')"
              >
                <span class="ml-4">Home</span>
              </Link>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <span
                v-if="route().current('view')"
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
                :class="route().current('view') ? 'text-gray-800' : ''"
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
                :href="route('view')"
              >
                <span class="ml-4">View Tickets</span>
              </Link>
            </li>
            <li class="relative px-6 py-3">
              <span
                v-if="route().current('ticket.*')"
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
                :class="route().current('ticket.*') ? 'text-gray-800' : ''"
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
                :href="route('ticket.create')"
              >
                <span class="ml-4">Submit Enquiry Form</span>
              </Link>
            </li>
            <li class="relative px-6 py-3">
              <span
                v-if="route().current('faqs.*')"
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
                :class="route().current('faqs.*') ? 'text-gray-800' : ''"
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
                <span class="ml-4">Knowledgebase</span>
              </Link>
            </li>
            <li class="relative px-6 py-3">
              <span
                v-if="route().current('faqs')"
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
                :class="route().current('faqs') ? 'text-gray-800' : ''"
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
                :href="route('faqs')"
              >
                <span class="ml-4">FAQs</span>
              </Link>
            </li>
            <li class="relative px-6 py-3">
              <span
                v-if="route().current('news.*')"
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
                :class="route().current('news.*') ? 'text-gray-800' : ''"
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
                :href="route('news.create')"
              >
                <span class="ml-4">News</span>
              </Link>
            </li>
          </ul>
        </div>
      </aside>
    </transition>
    <div class="lg:hidden block w-full bg-white py-2 px-2">
      <div class="flex justify-between">
        <img
          src="https://son.gov.ng/wp-content/uploads/2021/02/SON-LOGO-2.jpeg"
        />
        <button @click="toggleSideMenu">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-10 w-10 text-o-green"
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
        </button>
      </div>
    </div>
    <div class="lg:hidden block w-full bg-o-green py-6 px-6 text-white">
      <div class="py-3 grid gap-6">
        <Link
          :href="route('gallery')"
          class="flex gap-3 items-center font-light text-sm"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-8 w-8 text-[#fde428]"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
            />
          </svg>
          Gallery
        </Link>
        <Link
          :href="route('signup')"
          class="flex gap-3 items-center font-light text-sm"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-8 w-8 text-[#fde428]"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
            />
          </svg>
          {{ $page.props.user ? "Account" : "Register" }}
        </Link>
        <Link
          v-if="!$page.props.user"
          :href="route('auth.login')"
          class="flex gap-3 items-center font-light text-sm"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-8 w-8 text-[#fde428]"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
            />
          </svg>
          Login
        </Link>
      </div>
    </div>
    <div class="w-full">
      <div class="h-[30vh] flex items-center justify-between header-welcome">
        <div class="max-w-5xl mx-auto flex items-center gap-12">
          <div>
            <img
              class="hidden md:block h-68 w-64"
              src="/assets/img/smiling.png"
              alt=""
            />
          </div>
          <div class="text-center md:text-left">
            <div class="font-extrabold text-[#01a372] text-4xl">
              <h1>
                Get easy access to SON SME services at a subsidised rate and
                more
              </h1>
              <!-- <div class="w-16 h-1.5 bg-white mx-auto"></div> -->
            </div>
            <div class="mt-5 text-xl font-bold">
              <Link
                :href="route('signup')"
                class="text-white bg-o-green py-2 px-5 rounded font-bold"
              >
                {{ $page.props.user ? "Go to Dashboard" : "Sign Up" }}
              </Link>
            </div>
          </div>
        </div>
      </div>

      <div
        class="
          flex
          items-center
          justify-center
          py-20
          lg:px-0
          px-2
          bg-gray-100
          shadow
        "
      >
        <div class="w-full">
          <div class="text-center text-lg max-w-5xl mx-auto">
            <h2 class="font-extrabold text-3xl">ABOUT SON's MSMEs SERVICES</h2>
            <p>
              Access necessary information to enhance compliance to Standards
              and Conformity Assessment in order to enhance the quality of “Made
              in Nigeria Products”.
            </p>
          </div>
          <div class="mt-12 text-lg font-bold text-center mx-auto">
            <h2 class="font-extrabold pb-4 text-4xl text-o-green">Services</h2>
            <div class="w-10 h-2 bg-o-yellow rounded-full mx-auto"></div>
          </div>
          <div
            class="
              grid grid-cols-1
              md:grid-cols-2
              lg:grid-cols-4
              mt-4
              lg:mt-10
              mx-auto
              max-w-7xl
              gap-2
            "
          >
            <a
              v-for="service in services"
              :key="service.id"
              class="
                flex
                mt-1
                bg-slate-100
                hover:bg-white
                p-3
                w-full
                shadow
                rounded
              "
              :href="service.url"
            >
              <!-- <div>
                <img class="h-20 w-20" src="img/sil/s.png" alt="" />
              </div> -->
              <div>
                <div class="text-o-green font-bold text-xl tracking-tight">
                  {{ service.title }}
                </div>
                <div class="text-sm text-gray-600">
                  <p v-html="service.description"></p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div
        class="
          flex
          items-center
          justify-center
          py-16
          bg-white
          shadow-lg
          border-b border-b-gray-100
        "
      >
        <div>
          <div class="text-center text-lg">
            Do you have any questions? We're ready and waiting to answer your
            questions and solve your problems
          </div>
          <div class="mt-5 text-lg font-bold text-center">
            <Link
              :href="route('ticket.create')"
              class="text-white bg-o-green py-2 px-5 rounded font-bold"
            >
              Submit Enquiry Form
            </Link>
          </div>
        </div>
      </div>
      <div class="flex items-center justify-center py-8 bg-o-yellow shadow">
        <div>
          <div class="text-center text-xl font-bold text-o-green">
            What service do you require today?
          </div>
          <div
            class="
              mt-5
              grid
              lg:flex lg:justify-between
              gap-4
              text-lg
              font-bold
              text-center
            "
          >
            <Link
              :href="route('ticket.create')"
              class="
                items-center
                bg-white
                py-2
                px-5
                rounded-lg
                flex
                justify-between
                font-bold
                gap-3
              "
            >
              <svg
                width="31"
                height="31"
                class="h-8 w-8"
                viewBox="0 0 31 31"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M16.2964 0.153695C19.6637 -0.138932 23.3769 -0.219864 26.0399 1.8591C28.6755 3.91664 29.1572 7.57564 29.9584 10.8194C30.7003 13.8227 31.5795 16.9631 30.4854 19.8571C29.4146 22.6898 26.5679 24.2246 24.1837 26.0948C21.6887 28.052 19.4601 31.2247 16.2964 30.9874C13.1316 30.7501 11.5167 27.1659 9.22516 24.973C7.31246 23.1427 5.39201 21.4989 4.01765 19.2372C2.2402 16.3122 -0.648968 13.3387 0.130693 10.0069C0.910441 6.67478 4.7869 5.23449 7.71157 3.45186C10.3944 1.81666 13.1653 0.425794 16.2964 0.153695Z"
                  fill="#F4F4F5"
                />
                <path
                  d="M16 8.80401C14.9097 8.27317 13.7126 7.99819 12.5 8.00001C11.245 8.00001 10.057 8.29001 9 8.80401V18.804C10.0903 18.2732 11.2874 17.9982 12.5 18C14.169 18 15.718 18.51 17 19.385C18.3261 18.4802 19.8947 17.9975 21.5 18C22.755 18 23.943 18.29 25 18.804V8.80401C23.9097 8.27317 22.7126 7.99819 21.5 8.00001C20.245 8.00001 19.057 8.29001 18 8.80401V16C18 16.2652 17.8946 16.5196 17.7071 16.7071C17.5196 16.8947 17.2652 17 17 17C16.7348 17 16.4804 16.8947 16.2929 16.7071C16.1054 16.5196 16 16.2652 16 16V8.80401Z"
                  fill="#01A372"
                />
              </svg>
              Register my product
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
                  d="M14 5l7 7m0 0l-7 7m7-7H3"
                />
              </svg>
            </Link>
            <Link
              :href="route('ticket.create')"
              class="
                items-center
                bg-white
                py-2
                px-5
                rounded-lg
                flex
                justify-between
                font-bold
                gap-3
              "
            >
              <svg
                width="31"
                height="31"
                class="h-8 w-8"
                viewBox="0 0 31 31"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M16.2964 0.153695C19.6637 -0.138932 23.3769 -0.219864 26.0399 1.8591C28.6755 3.91664 29.1572 7.57564 29.9584 10.8194C30.7003 13.8227 31.5795 16.9631 30.4854 19.8571C29.4146 22.6898 26.5679 24.2246 24.1837 26.0948C21.6887 28.052 19.4601 31.2247 16.2964 30.9874C13.1316 30.7501 11.5167 27.1659 9.22516 24.973C7.31246 23.1427 5.39201 21.4989 4.01765 19.2372C2.2402 16.3122 -0.648968 13.3387 0.130693 10.0069C0.910441 6.67478 4.7869 5.23449 7.71157 3.45186C10.3944 1.81666 13.1653 0.425794 16.2964 0.153695Z"
                  fill="#F4F4F5"
                />
                <path
                  d="M16 8.80401C14.9097 8.27317 13.7126 7.99819 12.5 8.00001C11.245 8.00001 10.057 8.29001 9 8.80401V18.804C10.0903 18.2732 11.2874 17.9982 12.5 18C14.169 18 15.718 18.51 17 19.385C18.3261 18.4802 19.8947 17.9975 21.5 18C22.755 18 23.943 18.29 25 18.804V8.80401C23.9097 8.27317 22.7126 7.99819 21.5 8.00001C20.245 8.00001 19.057 8.29001 18 8.80401V16C18 16.2652 17.8946 16.5196 17.7071 16.7071C17.5196 16.8947 17.2652 17 17 17C16.7348 17 16.4804 16.8947 16.2929 16.7071C16.1054 16.5196 16 16.2652 16 16V8.80401Z"
                  fill="#01A372"
                />
              </svg>
              Get product standard
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
                  d="M14 5l7 7m0 0l-7 7m7-7H3"
                />
              </svg>
            </Link>
            <Link
              :href="route('ticket.create')"
              class="
                items-center
                bg-white
                py-2
                px-5
                rounded-lg
                flex
                justify-between
                font-bold
                gap-3
              "
            >
              <svg
                width="31"
                height="31"
                class="h-8 w-8"
                viewBox="0 0 31 31"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M16.2964 0.153695C19.6637 -0.138932 23.3769 -0.219864 26.0399 1.8591C28.6755 3.91664 29.1572 7.57564 29.9584 10.8194C30.7003 13.8227 31.5795 16.9631 30.4854 19.8571C29.4146 22.6898 26.5679 24.2246 24.1837 26.0948C21.6887 28.052 19.4601 31.2247 16.2964 30.9874C13.1316 30.7501 11.5167 27.1659 9.22516 24.973C7.31246 23.1427 5.39201 21.4989 4.01765 19.2372C2.2402 16.3122 -0.648968 13.3387 0.130693 10.0069C0.910441 6.67478 4.7869 5.23449 7.71157 3.45186C10.3944 1.81666 13.1653 0.425794 16.2964 0.153695Z"
                  fill="#F4F4F5"
                />
                <path
                  d="M16 8.80401C14.9097 8.27317 13.7126 7.99819 12.5 8.00001C11.245 8.00001 10.057 8.29001 9 8.80401V18.804C10.0903 18.2732 11.2874 17.9982 12.5 18C14.169 18 15.718 18.51 17 19.385C18.3261 18.4802 19.8947 17.9975 21.5 18C22.755 18 23.943 18.29 25 18.804V8.80401C23.9097 8.27317 22.7126 7.99819 21.5 8.00001C20.245 8.00001 19.057 8.29001 18 8.80401V16C18 16.2652 17.8946 16.5196 17.7071 16.7071C17.5196 16.8947 17.2652 17 17 17C16.7348 17 16.4804 16.8947 16.2929 16.7071C16.1054 16.5196 16 16.2652 16 16V8.80401Z"
                  fill="#01A372"
                />
              </svg>
              Certify my product
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
                  d="M14 5l7 7m0 0l-7 7m7-7H3"
                />
              </svg>
            </Link>
            <Link
              :href="route('ticket.create')"
              class="
                items-center
                bg-white
                py-2
                px-5
                rounded-lg
                flex
                justify-between
                font-bold
                gap-3
              "
            >
              <svg
                width="31"
                height="31"
                class="h-8 w-8"
                viewBox="0 0 31 31"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M16.2964 0.153695C19.6637 -0.138932 23.3769 -0.219864 26.0399 1.8591C28.6755 3.91664 29.1572 7.57564 29.9584 10.8194C30.7003 13.8227 31.5795 16.9631 30.4854 19.8571C29.4146 22.6898 26.5679 24.2246 24.1837 26.0948C21.6887 28.052 19.4601 31.2247 16.2964 30.9874C13.1316 30.7501 11.5167 27.1659 9.22516 24.973C7.31246 23.1427 5.39201 21.4989 4.01765 19.2372C2.2402 16.3122 -0.648968 13.3387 0.130693 10.0069C0.910441 6.67478 4.7869 5.23449 7.71157 3.45186C10.3944 1.81666 13.1653 0.425794 16.2964 0.153695Z"
                  fill="#F4F4F5"
                />
                <path
                  d="M16 8.80401C14.9097 8.27317 13.7126 7.99819 12.5 8.00001C11.245 8.00001 10.057 8.29001 9 8.80401V18.804C10.0903 18.2732 11.2874 17.9982 12.5 18C14.169 18 15.718 18.51 17 19.385C18.3261 18.4802 19.8947 17.9975 21.5 18C22.755 18 23.943 18.29 25 18.804V8.80401C23.9097 8.27317 22.7126 7.99819 21.5 8.00001C20.245 8.00001 19.057 8.29001 18 8.80401V16C18 16.2652 17.8946 16.5196 17.7071 16.7071C17.5196 16.8947 17.2652 17 17 17C16.7348 17 16.4804 16.8947 16.2929 16.7071C16.1054 16.5196 16 16.2652 16 16V8.80401Z"
                  fill="#01A372"
                />
              </svg>
              Get import permit
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
                  d="M14 5l7 7m0 0l-7 7m7-7H3"
                />
              </svg>
            </Link>
          </div>
        </div>
      </div>
      <div
        class="
          flex
          items-center
          justify-center
          py-16
          bg-white
          shadow-lg
          border-b border-b-gray-100
        "
      >
        <div>
          <div class="text-center text-lg">Have any complaints?</div>
          <div class="mt-5 text-lg font-bold text-center">
            <a
              href="https://son.gov.ng/complaints-center"
              class="text-white bg-o-green py-2 px-5 rounded font-bold"
            >
              Visit our complaint center
            </a>
          </div>
        </div>
      </div>
      <div class="flex items-center justify-center py-8 bg-white shadow">
        <div class="max-w-6xl">
          <div class="text-center text-2xl font-bold text-o-green">
            Quick Access
          </div>
          <div
            class="
              mt-5
              grid
              lg:flex lg:justify-between
              gap-4
              text-lg
              font-bold
              text-center
            "
          >
            <Link
              :href="route('ticket.create')"
              class="
                items-start
                bg-white
                py-2
                px-5
                rounded-lg
                flex
                justify-between
                font-bold
                gap-3
                w-full
                lg:w-1/3
              "
            >
              <svg
                width="31"
                height="31"
                class="h-12 w-12 -mt-2"
                viewBox="0 0 31 31"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M16.2964 0.153695C19.6637 -0.138932 23.3769 -0.219864 26.0399 1.8591C28.6755 3.91664 29.1572 7.57564 29.9584 10.8194C30.7003 13.8227 31.5795 16.9631 30.4854 19.8571C29.4146 22.6898 26.5679 24.2246 24.1837 26.0948C21.6887 28.052 19.4601 31.2247 16.2964 30.9874C13.1316 30.7501 11.5167 27.1659 9.22516 24.973C7.31246 23.1427 5.39201 21.4989 4.01765 19.2372C2.2402 16.3122 -0.648968 13.3387 0.130693 10.0069C0.910441 6.67478 4.7869 5.23449 7.71157 3.45186C10.3944 1.81666 13.1653 0.425794 16.2964 0.153695Z"
                  fill="#F4F4F5"
                />
                <path
                  d="M16 8.80401C14.9097 8.27317 13.7126 7.99819 12.5 8.00001C11.245 8.00001 10.057 8.29001 9 8.80401V18.804C10.0903 18.2732 11.2874 17.9982 12.5 18C14.169 18 15.718 18.51 17 19.385C18.3261 18.4802 19.8947 17.9975 21.5 18C22.755 18 23.943 18.29 25 18.804V8.80401C23.9097 8.27317 22.7126 7.99819 21.5 8.00001C20.245 8.00001 19.057 8.29001 18 8.80401V16C18 16.2652 17.8946 16.5196 17.7071 16.7071C17.5196 16.8947 17.2652 17 17 17C16.7348 17 16.4804 16.8947 16.2929 16.7071C16.1054 16.5196 16 16.2652 16 16V8.80401Z"
                  fill="#01A372"
                />
              </svg>
              <div>
                <div class="flex gap-4">
                  Submit a ticket
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
                      d="M14 5l7 7m0 0l-7 7m7-7H3"
                    />
                  </svg>
                </div>
                <div class="text-sm text-left font-extralight">
                  Got any questions? We're waiting and willing to answer your
                  questions and any other challenge you might have
                </div>
              </div>
            </Link>
            <Link
              :href="route('knowledgebase.index')"
              class="
                items-start
                bg-white
                py-2
                px-5
                rounded-lg
                flex
                justify-between
                font-bold
                gap-3
                w-full
                lg:w-1/3
              "
            >
              <svg
                width="31"
                height="31"
                class="h-12 w-12 -mt-2"
                viewBox="0 0 31 31"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M16.2964 0.153695C19.6637 -0.138932 23.3769 -0.219864 26.0399 1.8591C28.6755 3.91664 29.1572 7.57564 29.9584 10.8194C30.7003 13.8227 31.5795 16.9631 30.4854 19.8571C29.4146 22.6898 26.5679 24.2246 24.1837 26.0948C21.6887 28.052 19.4601 31.2247 16.2964 30.9874C13.1316 30.7501 11.5167 27.1659 9.22516 24.973C7.31246 23.1427 5.39201 21.4989 4.01765 19.2372C2.2402 16.3122 -0.648968 13.3387 0.130693 10.0069C0.910441 6.67478 4.7869 5.23449 7.71157 3.45186C10.3944 1.81666 13.1653 0.425794 16.2964 0.153695Z"
                  fill="#F4F4F5"
                />
                <path
                  d="M16 8.80401C14.9097 8.27317 13.7126 7.99819 12.5 8.00001C11.245 8.00001 10.057 8.29001 9 8.80401V18.804C10.0903 18.2732 11.2874 17.9982 12.5 18C14.169 18 15.718 18.51 17 19.385C18.3261 18.4802 19.8947 17.9975 21.5 18C22.755 18 23.943 18.29 25 18.804V8.80401C23.9097 8.27317 22.7126 7.99819 21.5 8.00001C20.245 8.00001 19.057 8.29001 18 8.80401V16C18 16.2652 17.8946 16.5196 17.7071 16.7071C17.5196 16.8947 17.2652 17 17 17C16.7348 17 16.4804 16.8947 16.2929 16.7071C16.1054 16.5196 16 16.2652 16 16V8.80401Z"
                  fill="#01A372"
                />
              </svg>
              <div>
                <div class="flex gap-4">
                  Knowledgebase
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
                      d="M14 5l7 7m0 0l-7 7m7-7H3"
                    />
                  </svg>
                </div>
                <div class="text-sm text-left font-extralight">
                  Learn more about our products and services as we walk you
                  through our step-by-step guide
                </div>
              </div>
            </Link>
            <Link
              :href="route('faqs')"
              class="
                items-start
                bg-white
                py-2
                px-5
                rounded-lg
                flex
                justify-between
                font-bold
                gap-3
                w-full
                lg:w-1/3
              "
            >
              <svg
                width="31"
                height="31"
                class="h-12 w-12 -mt-2"
                viewBox="0 0 31 31"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M16.2964 0.153695C19.6637 -0.138932 23.3769 -0.219864 26.0399 1.8591C28.6755 3.91664 29.1572 7.57564 29.9584 10.8194C30.7003 13.8227 31.5795 16.9631 30.4854 19.8571C29.4146 22.6898 26.5679 24.2246 24.1837 26.0948C21.6887 28.052 19.4601 31.2247 16.2964 30.9874C13.1316 30.7501 11.5167 27.1659 9.22516 24.973C7.31246 23.1427 5.39201 21.4989 4.01765 19.2372C2.2402 16.3122 -0.648968 13.3387 0.130693 10.0069C0.910441 6.67478 4.7869 5.23449 7.71157 3.45186C10.3944 1.81666 13.1653 0.425794 16.2964 0.153695Z"
                  fill="#F4F4F5"
                />
                <path
                  d="M16 8.80401C14.9097 8.27317 13.7126 7.99819 12.5 8.00001C11.245 8.00001 10.057 8.29001 9 8.80401V18.804C10.0903 18.2732 11.2874 17.9982 12.5 18C14.169 18 15.718 18.51 17 19.385C18.3261 18.4802 19.8947 17.9975 21.5 18C22.755 18 23.943 18.29 25 18.804V8.80401C23.9097 8.27317 22.7126 7.99819 21.5 8.00001C20.245 8.00001 19.057 8.29001 18 8.80401V16C18 16.2652 17.8946 16.5196 17.7071 16.7071C17.5196 16.8947 17.2652 17 17 17C16.7348 17 16.4804 16.8947 16.2929 16.7071C16.1054 16.5196 16 16.2652 16 16V8.80401Z"
                  fill="#01A372"
                />
              </svg>
              <div>
                <div class="flex gap-4">
                  FAQs
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
                      d="M14 5l7 7m0 0l-7 7m7-7H3"
                    />
                  </svg>
                </div>
                <div class="text-sm text-left font-extralight">
                  Get help by browsing through our most frequently asked
                  questions about our products and service.
                </div>
              </div>
            </Link>
          </div>
        </div>
      </div>
    </div>
    <footer class="bottom-0">
      <div class="flex items-center justify-center py-4 bg-o-green shadow">
        <div>
          <!-- <div class="text-center text-lg">
            Can't find what you are looking for?
          </div> -->
          <div class="mt-5 text-sm font-bold text-center">
            <a
              href="https://son.gov.ng/complaints-center"
              class="text-white bg-o-green py-2 px-5 rounded font-bold"
            >
              &copy; 2022 SON MSME
            </a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
.header-welcome {
  background: -webkit-linear-gradient(
      rgba(1, 163, 114, 1),
      rgba(135, 60, 255, 0) 0%
    ),
    -webkit-linear-gradient(-45deg, rgba(1, 163, 114, 1) 30%, rgba(
            253,
            228,
            40,
            1
          )
          0%);
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
@media only screen and (max-width: 1500px) {
  .header-welcome {
    background: -webkit-linear-gradient(
        rgba(1, 163, 114, 1),
        rgba(135, 60, 255, 0) 0%
      ),
      -webkit-linear-gradient(-45deg, rgba(1, 163, 114, 1) 20%, rgba(
              253,
              228,
              40,
              1
            )
            0%);
  }
}
@media only screen and (max-width: 768px) {
  .header-welcome {
    background: -webkit-linear-gradient(
        rgba(1, 163, 114, 1),
        rgba(135, 60, 255, 0) 0%
      ),
      -webkit-linear-gradient(-45deg, rgba(1, 163, 114, 1) 0%, rgba(
              253,
              228,
              40,
              1
            )
            0%);
  }
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
import { Head, Link } from "@inertiajs/inertia-vue3";
import FrontLayout from "../Layouts/FrontLayout.vue";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import SonLink from "@/Bits/SonLink.vue";
export default defineComponent({
  data() {
    return {
      services: [
        {
          id: 1,
          url: "https://son.gov.ng/standards",
          title: "Standards",
          description:
            "Established by consensus and approved by the Standards Organisation Of Nigeria (SON).",
        },
        {
          id: 2,
          url: "https://son.gov.ng/testing",
          title: "Testing",
          description:
            "Take advantage of our extensive experience in the testing and evaluation of products.",
        },
        {
          id: 3,
          url: "https://son.gov.ng/son-product-certification",
          title: "Product Certification",
          description:
            "Responsible for ensuring that locally manufactured products in Nigeria give the required degree of satisfaction to consumers.",
        },
        {
          id: 4,
          url: "https://soncap.son.gov.ng/",
          title: "SONCAP ONLINE",
          description:
            "Dear Customer,<br /> Welcome to SONCAP Online. A Standards Organisation of Nigeria initiative, aimed at improving certificate processing by importers and manufacturers.",
        },
        {
          id: 5,
          url: "https://son.gov.ng/metrology-and-instrumentation",
          title: "Meteorology and Instrumentation",
          description:
            "Calibration of measuring and testing Instruments and participation in international metrology conferences.",
        },
        {
          id: 6,
          url: "https://son.gov.ng/port-border",
          title: "Port & Border",
          description:
            "Ensure that products imported into Nigeria are safe and that import conditions have been met.",
        },
        {
          id: 7,
          url: "https://son.gov.ng/training-technical-advisory",
          title: "Training & Technical Advisory",
          description:
            "Technical advice to manufacturers, exporters, importers in the understanding and use of standards.",
        },
      ],
      show: false,
      isSideMenuOpen: false,
      showingNavigationDropdown: false,
    };
  },
  props: {
    shops: Object,
  },
  components: {
    Head,
    Link,
    FrontLayout,
    JetApplicationLogo,
    SonLink,
  },
  methods: {
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen;
    },
  },
});
</script>
