<template>
    <div class="mt-2 ps-2 pt-2 pb-3" @click="back">
        <font-awesome-icon icon="fa-solid fa-arrow-left" class="me-2" />
        <span class="fw-bold">Back to home</span>
    </div>
    <div>
        <Carousel :from="'productCarousel' + product.id" :images="product.images" height="300px" />
        <div style="position:relative;cursor:pointer">
            <div class="card-body px-3 pt-3">
                <div class="flex justify-between items-center">
                    <span class="text-muted" style="font-size:12px">{{ product.category.name
                        }} <font-awesome-icon class="ms-2 me-1" icon="fa-solid fa-fire"
                            style="font-size: 13px;color:#fe919d" />12</span>
                    <IconBtn v-if="product.is_favorite" @click="addToWishlist(product.id)" icon="fa-solid fa-heart"
                        style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                    <IconBtn v-else @click="addToWishlist(product.id)" icon="fa-regular fa-heart"
                        style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                </div>
                <h5 class="card-title fw-bold">{{ product.name }}</h5>
                <p class="card-text text-muted whitespace-pre-wrap" style="font-size:10px">
                    {{ product.description }}
                </p>
                <div class="fw-bold d-flex align-items-center justify-between" style="color:#fe919d">
                    <div>
                        {{ product.price }}
                        <span class="text-decoration-line-through text-muted ms-1" style="font-size:12px">{{
                            product.discount_price }}</span>
                        <span class="ms-2">
                            x {{ quantity }}
                        </span>
                    </div>
                    <div class="pe-1">
                        ${{ product.price * quantity }}
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="col-5 flex justify-center items-center mt-3">
                    <IconBtn icon="fas fa-circle-minus" @click="subQuantity(index)" />
                    <input type="text" class="form-control text-center" disabled="true" :value="quantity"
                        style="width:32%">
                    <IconBtn icon="fas fa-circle-plus" @click="quantity++" />
                </div>
                <div class="pt-3 col-7 pe-3">
                    <button class="btn w-100 fw-bold" @click="addToCart(product.id)"
                        style="background-color:#fe919d;color:white">
                        <font-awesome-icon icon="fa-solid fa-cart-shopping" class="me-2"></font-awesome-icon>
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Carousel from './Components/Carousel.vue';
import IconBtn from './Components/IconBtn.vue';
import { useForm,router,usePage } from '@inertiajs/vue3';
import {ref,onMounted,onUpdated} from 'vue'
import { useToast } from 'vue-toastification';
import {route} from 'ziggy-js';

const page = usePage();
const toast = useToast();

const props = defineProps({
    product: Object
})

onMounted(() => {

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

const quantity = ref(1)

const back = () => {
    router.get(route('home'));
}

const subQuantity = (id) => {
    quantity.value = quantity.value <= 1 ? 1 : quantity.value - 1;
}

const addToWishlist = (id) => {

    router.post(route('wish_lists.create'), { product_id: id });
}

const addToCart = (id) => {
    router.post(route('cart.create'), { product_id: id, quantity: quantity.value });
}

</script>

<style></style>
