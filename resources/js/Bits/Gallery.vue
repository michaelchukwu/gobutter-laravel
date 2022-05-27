<template>
  <div>
    <div class="container px-5 py-2 mx-auto lg:pt-5 lg:px-1">
      <div class="flex flex-wrap -m-1 md:-m-2">
        <div class="flex flex-wrap w-1/2">
          <div class="w-1/2 p-1 md:p-2">
            <img
              alt="gallery"
              class="
                block
                object-cover object-center
                w-full
                h-full
                hover:scale-110
                cursor-pointer
                transition
                duration-300
                ease-in-out
              "
              src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(70).webp"
            />
          </div>
          <div class="w-1/2 p-1 md:p-2">
            <img
              alt="gallery"
              class="block object-cover object-center w-full h-full"
              src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(72).webp"
            />
          </div>
          <div class="w-full p-1 md:p-2">
            <img
              alt="gallery"
              class="block object-cover object-center w-full h-full"
              src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
            />
          </div>
        </div>
        <div class="flex flex-wrap w-1/2">
          <div class="w-full p-1 md:p-2">
            <img
              alt="gallery"
              class="block object-cover object-center w-full h-full"
              src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(74).webp"
            />
          </div>
          <div class="w-1/2 p-1 md:p-2">
            <img
              alt="gallery"
              class="block object-cover object-center w-full h-full"
              src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(75).webp"
            />
          </div>
          <div class="w-1/2 p-1 md:p-2">
            <img
              alt="gallery"
              class="block object-cover object-center w-full h-full"
              src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(77).webp"
            />
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="lg:flex lg:flex-wrap mt-5">
      <div
        v-for="k in images.data"
        :key="k.id"
        class="
          p-1
          w-full
          lg:w-1/3
          hover:underline
          transition-all
          duration-100
          ease-linear
        "
      >
        <img :src="k.image" :alt="k.title" />
      </div>
    </div> -->
    <pagination class="mt-6" :links="images.links" />
  </div>
</template>

<script>
import Pagination from "@/Bits/Pagination.vue";
export default {
  name: "Gallery",
  components: {
    Pagination,
  },
  props: ["images"],
};
</script>
