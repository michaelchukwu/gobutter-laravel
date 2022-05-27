<template>
    <admin-layout title="Edit Products">
         <div class="container grid px-6 mx-auto">
                         <!-- With actions -->
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Products
            </h2>
            <!-- CTA -->
            <Link
              class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
              :href="route('kitchn.product.index')"
            >

              <span>&LeftArrow; All Products </span>
            </Link>
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Update {{product.name}}
            </h4>
            <form @submit="submit">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-6">
                    <div
                    class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-full"
                    >

                    <jet-validation-errors class="mb-4" />

                        <div class="mt-4">
                            <jet-label for="name" value="Name" />
                            <jet-input placeholder="Name" id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autocomplete="name" @keyup="createSlug"/>
                        </div>
                        <div class="mt-4">
                            <jet-label for="sku" value="SKU" />
                            <jet-input placeholder="SKU" id="sku" type="text" class="mt-1 block w-full" v-model="form.sku" required autocomplete="sku" />
                            <small>this stands for stock keeping unit</small>
                        </div>
                        <div class="mt-4">
                            <jet-label for="slug" value="Slug" />
                            <jet-input placeholder="Slug" id="slug" type="text" class="mt-1 block w-full" v-model="form.slug" required autocomplete="slug"/>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mt-4">
                                <jet-label for="price" value="Price" />
                                <jet-input placeholder="Price" id="price" type="number" class="mt-1 block w-full" v-model="form.price" required autocomplete="price"/>
                            </div>
                            <div class="mt-4">
                                <jet-label for="sale_price" value="Sale Price" />
                                <jet-input placeholder="Sale Price" id="sale_price" type="number" class="mt-1 block w-full" v-model="form.sale_price" required autocomplete="sale_price"/>
                            </div>
                        </div>

                        <div class="mt-4">
                            <jet-label for="volume" value="Volume" />
                            <jet-input placeholder="Volume" id="volume" type="number" class="mt-1 block w-full" v-model="form.volume" required autocomplete="volume"/>
                        </div>
                        <div class="mt-4">
                            <jet-label for="quantity" value="Quantity" />
                            <jet-input placeholder="Quantity" id="quantity" type="number" class="mt-1 block w-full" v-model="form.quantity" required autocomplete="quantity"/>
                        </div>
                        <div class="mt-4">
                            <jet-label for="summary" value="Summary" />
                            <textarea placeholder="summary" id="summary" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.summary" required autocomplete="summary" ></textarea>
                        </div>
                        <div class="mt-4">
                            <jet-label for="description" value="Description" />
                            <textarea placeholder="Description" id="description" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.description" required autocomplete="description" ></textarea>
                        </div>



                    </div>
                    <div
                    class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-full"
                    >

                        <div class="mt-4">
                            <jet-label for="tag" value="Tags" />
                            <vue-tags-input
                            v-model="tag"
                            :tags="form.tags"
                            @tags-changed="newTags => form.tags = newTags"
                            />
                        </div>
                        <div class="mt-4">
                            <jet-label for="img" value="Image" />
                            <!-- <jet-input placeholder="Image" id="img" type="file" accept="image/*" class="mt-1 block w-full" v-model="form.img" required autocomplete="img"/> -->
                            <img :src="form.img" alt="">
                        </div>
                        <div class="flex gap-6">
                            <div class="mt-4 flex gap-2">
                                <jet-label for="status" value="Status" />
                                <jet-checkbox v-model="form.status" />
                            </div>
                            <div class="mt-4 flex gap-2">
                                <jet-label for="featured" value="Featured" />
                                <jet-checkbox v-model="form.featured" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <jet-label for="store" value="Store" />
                            <select v-model="form.product_id" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option v-for="r in products" :key="r.id" :value="r.id">{{r.name}}</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <jet-label for="product_attributes" value="Other Attributes" />
                            <textarea placeholder="Other Attributes" id="product_attributes" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.product_attributes" required autocomplete="product_attributes" ></textarea>
                        </div>

                        <jet-button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Update
                        </jet-button>


                    </div>
                </div>
            </form>
         </div>

    </admin-layout>
</template>
<script>
    import AdminLayout from '../../../Layouts/AdminLayout.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Swal from 'sweetalert2';
    export default {
        props:{
            product: Object,
        },
        data(){
            return {
                allproducts:this.products,
                form: this.$inertia.form({
                    name: this.product.name,
                    description: this.product.description,
                    slug:this.product.slug,
                    sku:this.product.sku,
                    img:this.product.img,
                    summary:this.product.summary,
                    quantity:this.product.quantity,
                    volume:this.product.volume,
                    price:this.product.price,
                    sale_price:this.product.sale_price,
                    status:this.product.status,
                    featured:this.product.featured,
                    product_attributes:this.product.product_attributes,
                    shop_id:this.product.shop_id,
                    tags:[]
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
                this.form.put(this.route('kitchn.product.update', {id:this.product.id}), {
                    onFinish: () => this.form.reset(),
                })
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
            this.checkMessage()
        }
    }
</script>
