<template>
    <admin-layout title="Restaurants">
         <div class="container grid px-6 mx-auto">
                         <!-- With actions -->
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Restaurants
            </h2>
            <!-- CTA -->
            <Link
              class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
              :href="route('kitchn.shop.index')"
            >

              <span>&LeftArrow; All Restaurants </span>
            </Link>
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Create Restaurant
            </h4>
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-full md:w-1/2"
            >
            <form @submit="submit">
            <jet-validation-errors class="mb-4" />

                <div class="mt-4">
                    <jet-label for="name" value="Name" />
                    <jet-input placeholder="Name" id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autocomplete="name" @keyup="createSlug"/>
                </div>
                <div class="mt-4">
                    <jet-label for="slug" value="Slug" />
                    <jet-input placeholder="Slug" id="slug" type="text" class="mt-1 block w-full" v-model="form.slug" required autocomplete="slug"/>
                </div>
                <div class="mt-4">
                    <jet-label for="description" value="Description" />
                    <textarea placeholder="Description" id="description" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.description" required autocomplete="description" ></textarea>
                </div>
                <jet-button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create
                </jet-button>
            </form>

            </div>
         </div>

    </admin-layout>
</template>
<script>
    import AdminLayout from '../../../Layouts/AdminLayout.vue'
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Swal from 'sweetalert2';
    export default {
        props:{
            shops: Object
        },
        data(){
            return {
                allShops:this.shops,
                form: this.$inertia.form({
                    name: '',
                    description: '',
                    slug:''
                })
            }
        },
        components:{
            AdminLayout,
            Link,
            JetInput,
            JetLabel,
            JetButton,
            JetCheckbox,
            JetValidationErrors
        },
        methods: {
            submit() {
                this.form.post(this.route('kitchn.shop.store'), {
                    onFinish: () => this.form.reset(),
                })
            },
            createSlug(){
                this.form.slug = this.form.name.split(' ').join('-').toLowerCase()
            },
            checkMessage(){
                if(this.$page.props.flash.success){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })

                        Toast.fire({
                        icon: 'success',
                        title: this.$page.props.flash.success
                        }
                    )
                }
                if(this.$page.props.flash.error){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })

                        Toast.fire({
                        icon: 'error',
                        title: this.$page.props.flash.error
                        }
                    )
                }
            }

        },
        mounted(){
            this.checkMessage();
        }
    }
</script>
