<template>
    <Layout>
        <div class="row w-100 d-flex justify-content-center mt-lg-4 mt-md-4 mt-sm-3 mt-3">
            <div class="col-lg-8 col-md-10 col-sm-12 col-12">
                <Carousel from="ads" :images="carouselImages" class="d-lg-block d-md-block d-sm-none d-none ps-5"
                    height="450px" />
                <Carousel from="phone" :images="carouselImages" class="d-lg-none d-md-none d-sm-block d-block"
                    height="200px" style="margin-left: 15px" />
            </div>
            <div class="col-lg-4 col-md-10 col-sm-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-3">
                <div
                    class="row w-100 px-lg-4 px-md-2 px-sm-0 px-0 ps-lg-0 ps-md-0 ps-sm-3 ps-5 d-lg-flex d-md-flex d-sm-none d-none">
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <Link class="text-decoration-none text-black" :href="$route('products.popular')"><ListHeader name="Popular" icon="fa-solid fa-arrow-up-right-dots" /></Link>
                    </div>
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <Link class="text-decoration-none text-black" :href="$route('products.trending')"><ListHeader name="Trending" icon="fa-solid fa-fire" /></Link>
                    </div>
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <Link class="text-decoration-none text-black" :href="$route('products.recommend')"><ListHeader name="Recommend" icon="fa-solid fa-basket-shopping" /></Link>
                    </div>
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <ListHeader name="New arrivals" icon="fa-solid fa-box-open" />
                    </div>
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <ListHeader name="Explore" icon="fa-solid fa-magnifying-glass" />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center px-lg-5 px-md-3 px-sm-2 px-2 mb-3">
            <h5 class="mt-lg-5 mt-md-4 mt-sm-2 mt-2 fw-bold">Categories</h5>
            <div class="text-muted">See all</div>
        </div>
        <div class="row w-100 px-5 d-lg-flex d-md-flex d-sm-none d-none">
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3" v-for="category in categories" :key="category">
                <Category :name="category.name" :count="category.products_count" :image="category.image" />
            </div>
        </div>
        <div class="d-lg-none d-md-none d-sm-block d-block">
            <div class="pb-3" style="overflow-x: auto; white-space: nowrap">
                <CategoryCircle v-for="category in categories" :key="category" class="d-inline-block"
                    :image="category.image" :name="category.name" />
            </div>
        </div>
        <div class="d-lg-flex d-md-flex d-sm-none d-none justify-content-between align-items-center px-lg-5 px-md-3 px-sm-2 px-2 mb-3"
            style="margin-top:-10px">
            <h5 class="mt-lg-5 mt-md-4 mt-sm-2 mt-2 fw-bold">Products</h5>
            <div class="text-muted">See all</div>
        </div>
        <div class="row w-100 px-5 mb-5 d-lg-flex d-md-flex d-sm-none d-none">
            <div class="col-lg-3 col-md-4 mb-3" v-for="product, index in products" :key="product">
                <Product @click="openProductModal(index,product.id)"  :name="product.name" :categoryName="product.category.name" :image="product.images[0].image"
                    :price="product.price" :discount_price="product.discount_price" :description="product.description"
                />
                <template>
                    <div class="text-center pa-4">
                        <v-dialog v-model="dialogArray[index]" width="auto">
                            <v-card max-width="400" class="pb-3" style="position:relative">
                                <div style="position:absolute;top:10px;right:10px;z-index:3">
                                    <font-awesome-icon @click="dialogArray[index] = false" icon="fa-solid fa-xmark"
                                        class="me-2 text-white fs-5"
                                        style="background-color: black;padding:6px;border-radius:50%;width:16px;height:16px;cursor:pointer" />
                                </div>
                                <div>

                                    <Carousel :from="'productCarousel' + product.id" :images="product.images"
                                        height="300px" />
                                    <div style="position:relative;cursor:pointer">
                                        <div class="card-body px-3 pt-3">
                                            <div class="flex justify-between items-center">
                                                <span class="text-muted" style="font-size:12px">{{ product.category.name
                                                    }} <font-awesome-icon class="ms-2 me-1" icon="fa-solid fa-fire"
                                                        style="font-size: 13px;color:#fe919d" />12</span>
                                                <IconBtn v-if="product.is_favorite" @click="addToWishlist(product.id)"
                                                    icon="fa-solid fa-heart"
                                                    style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                                                <IconBtn v-else @click="addToWishlist(product.id)"
                                                    icon="fa-regular fa-heart"
                                                    style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                                            </div>
                                            <h5 class="card-title fw-bold">{{ product.name }}</h5>
                                            <p class="card-text text-muted" style="font-size:10px">
                                                {{ product.description }}
                                            </p>
                                            <div class="fw-bold d-flex align-items-center justify-between"
                                                style="color:#fe919d">
                                                <div>
                                                    {{ product.price }}
                                                    <span class="text-decoration-line-through text-muted ms-1"
                                                        style="font-size:12px">{{ product.discount_price }}</span>
                                                        <span class="ms-2">
                                                            x {{ quantity[index] }}
                                                        </span>
                                                </div>
                                                <div class="pe-1">
                                                    {{ product.price * quantity[index] }} Ks
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="col-5 flex justify-center items-center mt-3">
                                                <IconBtn icon="fas fa-circle-minus" @click="subQuantity(index)" />
                                                <input type="text" class="form-control text-center" disabled="true" :value="quantity[index]"
                                                    style="width:32%">
                                                <IconBtn icon="fas fa-circle-plus" @click="quantity[index]++" />
                                            </div>
                                            <div class="pt-3 col-7 pe-3">
                                                <button class="btn w-100 fw-bold" @click="addToCart(index,product.id, quantity[index])"
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
        <div class="d-lg-none d-md-none d-sm-flex d-flex justify-content-between align-items-center px-lg-5 px-md-3 px-sm-2 px-2 mt-2 mb-3"
            style="margin-top:-10px">
            <h5 class="mt-lg-5 mt-md-4 mt-sm-2 mt-2 fw-bold">Trending</h5>
            <div class="text-muted">See all</div>
        </div>
        <div class="d-lg-none d-md-none d-sm-flex d-flex ps-3 pb-3 mb-5" style="overflow-x: scroll;">
            <div class="me-3" v-for="product in products" :key="product">
                <Link :href="'/product/details/'+product.id" style="text-decoration:none">
                <Product :name="product.name" :categoryName="product.category.name" :image="product.images[0].image"
                    :price="product.price" :discount_price="product.discount_price" :description="product.description"
                    size="phone" />
                </Link>
            </div>
        </div>
        <SpeedDial :payments="payments" :cartData="cartData" v-if="is_auth"/>
    </Layout>
</template>

<script setup>
import ListHeader from "./Components/ListHeader.vue";
import Layout from "./Layouts/Layout.vue";
import Carousel from "./Components/Carousel.vue";
import Category from "./Components/Category.vue";
import CategoryCircle from "./Components/CategoryCircle.vue";
import Product from "./Components/Product.vue";
import { Link, usePage, router } from '@inertiajs/vue3'
import { ref, onMounted, onUpdated } from 'vue'
import IconBtn from "./Components/IconBtn.vue";
import { useToast } from "vue-toastification";
import { route } from "ziggy-js";
import SpeedDial from "./Components/SpeedDial.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import axios from 'axios';

const toast = useToast();
const page = usePage();

const props = defineProps({
    categories: Object,
    products: Array,
    carouselImages : Object,
    cartData : Array,
    payments : Array,
    is_auth : Boolean
})


const dialogArray = ref([]);
const quantity = ref([]);


const incrementViewCount = (productId) => {
    axios.post(`/product/${productId}/increment-view`)
        .then(response => {
            console.log('View count incremented:', response.data);
        })
        .catch(error => {
            console.error('Error incrementing view count:', error);
        });
};

const openProductModal = (index, productId) => {
    dialogArray.value[index] = true;
    incrementViewCount(productId);
};


onMounted(() => {
    props.products.forEach(product => {
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

onUpdated(() => {

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

const subQuantity = (index) => {
    quantity.value[index] = quantity.value[index] <= 1 ? 1 : quantity.value[index] - 1;
}

const addToCart = (index,id, quantity) => {
    dialogArray.value[index] = false
    router.post(route('cart.create'), { product_id: id, quantity: quantity });
}

</script>

<style scoped>
--webkit-scrollbar {
    display: none;
}
</style>
