<template>
    <layout>
        <div class="container-fluid">
            <div class="row mt-3" v-if="products.length != 0">
                <div class="col-12">
                    <h4 class="fw-bold my-4 text-center">My Wishlists</h4>
                    <!-- <div v-if="notificationMessage" class="notification w-100 p-3">
                        <span class="bg-success w-100 p-3 float-end rounded-md">{{ notificationMessage }}</span>
                    </div> -->
                    <div class="container row mt-5">
                        <div class="col-lg-3 col-md-4 mb-3" v-for="product, index in products" :key="product">
                            <Product :name="product.name" :categoryName="product.category.name"
                                :image="product.images[0]?.image" :price="product.price"
                                :discount_price="product.discount_price" :description="product.description" :product_id=product.id
                                @click="dialogArray[index] = true" />
                                <template>
                    <div class="text-center pa-4">
                        <v-dialog v-model="dialogArray[index]" width="auto">
                            <v-card max-width="600" class="pb-3" style="position:relative;min-height:500px;">
                                <div style="position:absolute;top:10px;right:10px;z-index:3">
                                    <font-awesome-icon @click="dialogArray[index] = false" icon="fa-solid fa-xmark"
                                        class="me-2 text-white fs-5"
                                        style="background-color: black;padding:6px;border-radius:50%;width:16px;height:16px;cursor:pointer" />
                                </div>
                                <div>

                                    <Carousel :from="'productCarousel' + product.id" :images="product.images"
                                     height="300px" />
                                    <div class="" style="position:relative;cursor:pointer">
                                        <div class="card-body px-3 pt-3" style="max-height: 150px; overflow-y: auto;">
                                            <div class="flex justify-between items-center">
                                                <span class="text-muted" style="font-size:12px">{{ product.category.name
                                                    }} <font-awesome-icon class="ms-2 me-1" icon="fa-solid fa-fire"
                                                        style="font-size: 13px;color:#fe919d" />{{ product.view_count }}</span>
                                                <IconBtn v-if="product.is_favorite" @click="addToWishlist(product.id)"
                                                    icon="fa-solid fa-heart"
                                                    style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                                                <IconBtn v-else @click="addToWishlist(product.id)"
                                                    icon="fa-regular fa-heart"
                                                    style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                                            </div>
                                            <h5 class="card-title fw-bold">{{ product.name }}</h5>
                                            <p class="card-text text-muted whitespace-pre-wrap" style="font-size:10px;" >
                                                {{ product.description }}
                                            </p>
                                            <div class="fw-bold d-flex align-items-center justify-between"
                                                style="color:#fe919d">
                                                <div>
                                                     {{ product.price }}Ks
                                                    <!-- <span class="text-decoration-line-through text-muted ms-1"
                                                        style="font-size:12px">{{ product.discount_price }}</span> -->
                                                    <span class="ms-2">
                                                        x {{ quantity[index] }}
                                                    </span>
                                                </div>
                                                <div class="pe-1">
                                                    {{ product.price * quantity[index] }}Ks
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="col-5 flex justify-center items-center mt-3">
                                                <IconBtn icon="fas fa-circle-minus" @click="subQuantity(index)" />
                                                <input type="text" class="form-control text-center" disabled="true"
                                                    :value="quantity[index]" style="width:32%">
                                                <IconBtn icon="fas fa-circle-plus" @click="quantity[index]++" />
                                            </div>
                                            <div class="pt-3 col-7 pe-3">
                                                <button class="btn w-100 fw-bold"
                                                    @click="addToCart(index, product.id, quantity[index])"
                                                    style="background-color:#fe919d;color:white">
                                                    <font-awesome-icon icon="fa-solid fa-cart-shopping"
                                                        class="me-2"></font-awesome-icon>
                                                    Add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </v-card>
                        </v-dialog>
                    </div>
                </template>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="row flex justify-center align-items-center" style="height:90vh">
                    <div class="col-lg-2 col-md-5 col-sm-10 col-10 text-center">
                        <img src="../../images/nodata.svg" class="">
                        There's no data in your wishlist.
                    </div>
                </div>
        </div>
    </layout>
</template>

<script setup>
import Layout from './Layouts/Layout.vue';
import Product from './Components/Product.vue';
import Carousel from './Components/Carousel.vue';
import IconBtn from './Components/IconBtn.vue';
import { ref, onMounted } from 'vue'
import { usePage,router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { useToast } from "vue-toastification";
import axios from 'axios';
const page = usePage();
const toast = useToast();
const props = defineProps({
    products: Object,
    userWishList : Object
})

console.log(props.products);
const isNoti = ref(false);

const dialogArray = ref([]);

const quantity = ref([]);

const subQuantity = (index) => {
    quantity.value[index] = quantity.value[index] <= 1 ? 1 : quantity.value[index] - 1;
}

const addToCart = (index, id, quantity) => {
    dialogArray.value[index] = false
    router.post(route('cart.create'), { product_id: id, quantity: quantity });
}


onMounted(() => {

    if (props.products && props.products.length > 0) {
        props.products.forEach((product) => {
          if (product.userWishList?.is_notified === 1) {
            isNoti.value = true;
            toast.warning(`Product ${product.name} is back!`);

            setTimeout(() => {
                axios.post('/noti-off', {
                    user_id: product.user_id,
                    product_id: product.id,
                })
                .then(response => {
                    console.log('Notification status sent:', response.data);
                })
                .catch(error => {
                    console.error('Error sending notification status:', error);
                });
            }, 3000); // Adjust the time as needed
            }
        });
    }

    props.products.forEach(() => {
        dialogArray.value.push(false)
        quantity.value.push(1)
    })

    if (page.props.flash) {
        if (page.props.flash.success) {
            toast.success(page.props.flash.success);
            page.props.flash.success = null;
        } else if (page.props.flash.failed) {
            toast.error(page.props.flash.failed);
            page.props.flash.failed = null;
        }
    }
})

const addToWishlist = (id) => {
    router.post(route('wish_lists.create'), { product_id: id });
}


</script>

<style></style>
