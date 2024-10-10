<template>
    <Navbar />
    <div class="container row py-4 gap-3">
        <h3 ref="titleRef" class="section-title"></h3>
        <div class="col-lg-3 col-md-4 mb-3" v-for="product, index in all_products" :key="product">

            <Product @click="openProductModal(index, product.id)" :name="product.name"
                :categoryName="product.category.name" :image="product.images[0]?.image" :price="product.price"
                :discount_price="product.discount_price" :description="product.description"
                :popular="product.view_count" />
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

                                <Carousel :from="'productCarousel' + product.id" :images="product.images" height="300px"
                                    width="200px" />
                                <div class="" style="position:relative;cursor:pointer">
                                    <div class="card-body px-3 pt-3" style="max-height: 150px; overflow-y: auto;">
                                        <div class="flex justify-between items-center">
                                            <span class="text-muted" style="font-size:12px">{{ product.category.name
                                                }} <font-awesome-icon class="ms-2 me-1" icon="fa-solid fa-fire"
                                                    style="font-size: 13px;color:#fe919d" />{{ product.view_count
                                                }}</span>
                                            <IconBtn v-if="product.is_favorite" @click="addToWishlist(product.id)"
                                                icon="fa-solid fa-heart"
                                                style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                                            <IconBtn v-else @click="addToWishlist(product.id)"
                                                icon="fa-regular fa-heart"
                                                style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                                        </div>
                                        <h5 class="card-title fw-bold">{{ product.name }}</h5>
                                        <p class="card-text text-muted whitespace-pre-wrap" style="font-size:10px;">
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
</template>

<script setup>
import { ref, onMounted,onUpdated } from 'vue';
import Carousel from "./Components/Carousel.vue";
import Navbar from './Components/Navbar.vue';
import Product from "./Components/Product.vue";
import { Link, usePage, router } from '@inertiajs/vue3'
import IconBtn from "./Components/IconBtn.vue";
import { useToast } from "vue-toastification";
import { route } from "ziggy-js";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import axios from 'axios';

const toast = useToast();
const page = usePage();

const props = defineProps({
    categories : Object,
    popular_products : Array,
})

const all_products = ref(props.popular_products);
const titleRef = ref(null);

const dialogArray = ref([]);
const quantity = ref([]);

const incrementViewCount = (productId) => {
    axios.post(`/product/${productId}/increment-view`)
        .then(response => {
            console.log('View count incremented:', response.data);
        })
        .catch(error => {
            if (error.response) {
                toast.error('Failed to increment view count.');
            } else if (error.request) {
                toast.error('No response from the server.');
            } else {
                toast.error('An error occurred while incrementing view count.');
            }
            console.error('Error incrementing view count:', error);
        });
};

const openProductModal = (index, productId) => {
    dialogArray.value[index] = true;
    incrementViewCount(productId);
};


onMounted(() => {
    all_products.value.forEach(product => {
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

const addToCart = (index, id, quantity) => {
    dialogArray.value[index] = false
    router.post(route('cart.create'), { product_id: id, quantity: quantity });
}

// Colors for each letter in "Trending Products"
const rainbowColors = ['#FF0000', '#FF7F00', '#FFFF00', '#00FF00', '#0000FF', '#4B0082', '#9400D3', '#FF1493'];

const applyRainbowColors = () => {
    const titleText = "Popular Products";
    const titleElement = titleRef.value;
    titleElement.innerHTML = '';

    // Loop through each letter and apply a color
    for (let i = 0; i < titleText.length; i++) {
        const letterSpan = document.createElement('span');
        letterSpan.textContent = titleText[i];


        if (i < 7) {
            letterSpan.style.color = rainbowColors[i % rainbowColors.length];
        }

        titleElement.appendChild(letterSpan);
    }
};

onMounted(() => {
    applyRainbowColors();
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap');

.section-title {
    font-family: "Permanent Marker", cursive;
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    color: #333;
}

.card-body {
    padding: 1rem;
    font-family: 'Poppins', sans-serif;
}



.card-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #e74c3c;
}
</style>
