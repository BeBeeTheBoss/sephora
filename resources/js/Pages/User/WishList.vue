<template>
    <layout>
        <div class="container-fluid">
            <div class="row mt-3" v-if="products.length != 0">
                <div class="col-12">
                    <h5 class="fw-bold my-3">My wishlists</h5>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 mb-3" v-for="product, index in products" :key="product">
                            <Product :name="product.name" :categoryName="product.category.name"
                                :image="product.images[0].image" :price="product.price"
                                :discount_price="product.discount_price" :description="product.description"
                                @click="dialogArray[index] = true" />
                            <template>
                                <div class="text-center pa-4">
                                    <v-dialog v-model="dialogArray[index]" width="auto">
                                        <v-card max-width="400" class="pb-3" style="position:relative">
                                            <div style="position:absolute;top:10px;right:10px;z-index:3">
                                                <font-awesome-icon @click="dialogArray[index] = false"
                                                    icon="fa-solid fa-xmark" class="me-2 text-white fs-5"
                                                    style="background-color: black;padding:6px;border-radius:50%;width:16px;height:16px;cursor:pointer" />
                                            </div>
                                            <div>
                                                <Carousel :from="'productCarousel' + product.id"
                                                    :images="product.images" height="300px" />
                                                <div style="position:relative;cursor:pointer">
                                                    <div class="card-body px-3 pt-3">
                                                        <div class="flex justify-between items-center">
                                                            <span class="text-muted" style="font-size:12px">{{
                                                                product.category.name
                                                                }} <font-awesome-icon class="ms-2 me-1"
                                                                    icon="fa-solid fa-fire"
                                                                    style="font-size: 13px;color:#fe919d" />12</span>
                                                            <IconBtn v-if="product.is_favorite"
                                                                @click="addToWishlist(product.id)"
                                                                icon="fa-solid fa-heart"
                                                                style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                                                            <IconBtn v-else @click="addToWishlist(product.id)"
                                                                icon="fa-regular fa-heart"
                                                                style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                                                        </div>
                                                        <h5 class="card-title fw-bold">{{ product.name }}</h5>
                                                        <p class="card-text text-muted whitespace-pre-wrap" style="font-size:10px">
                                                            {{ product.description }}
                                                        </p>
                                                        <div class="fw-bold d-flex align-items-center"
                                                            style="color:#fe919d">$23000
                                                            <span
                                                                class="text-decoration-line-through text-muted ms-1 mt-1"
                                                                style="font-size:12px">$25000</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <div class="col-5 flex justify-center items-center mt-3">
                                                            <IconBtn icon="fas fa-circle-minus" />
                                                            <input type="text" class="form-control w-25" value="1">
                                                            <IconBtn icon="fas fa-circle-plus" />
                                                        </div>
                                                        <div class="pt-3 col-7 pe-3">
                                                            <button class="btn w-100 fw-bold"
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

const page = usePage();

const props = defineProps({
    products: Object
})
const dialogArray = ref([]);

onMounted(() => {
    props.products.forEach(() => {
        dialogArray.value.push(false)
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
