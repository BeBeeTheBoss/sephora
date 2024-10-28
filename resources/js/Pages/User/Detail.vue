<template>
    <Navbar />
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Main Image -->
                <v-img :src="selectedImage" style="width: 100%; height: 300px;" class="mb-4" />

                <!-- Thumbnail Gallery -->

                <div class="flex">
                    <v-img v-for="(image, index) in product.images" :key="index" :src="image.image"
                        style="cursor: pointer;width:80px;height:80px;border-radius: 10px;"
                        @click="selectedImage = image.image" class="mx-2 border shadow-md" />
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <h5 class="font-semibold">{{ product.name }}</h5>
                <p class="whitespace-pre-wrap">{{ product.description }}</p>

                <div v-if="product.discount_price > 0">
                    <span class="text-muted">{{ product.price }}Ks</span>
                    <span class="text-danger ms-2" style="text-decoration: line-through;">{{ product.discount_price
                        }}Ks</span>
                </div>
                <div v-else>
                    <span class="text-dark">{{ product.price }}Ks</span>
                </div>

                <div class="flex mt-3">
                    <button class="btn w-100 fw-bold me-2" @click="addToCart(product.id)"
                        style="background-color:#fe919d;color:white">
                        <font-awesome-icon icon="fa-solid fa-cart-shopping" class="me-2"></font-awesome-icon>
                        Add to cart
                    </button>
                    <button class="btn w-100 fw-bold me-2" @click="addToWishlist(product.id)"
                        style="background-color:#fe919d;color:white">
                        <font-awesome-icon icon="fa-regular fa-heart" class="me-2"></font-awesome-icon>
                        Wish List
                    </button>
                    <button @click="goBack" class="btn w-100" style="background-color:#fe919d;color:white"><font-awesome-icon icon="fa-solid fa-backward" /> Back</button>
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script setup>
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue'
import { ref,onMounted,onUpdated } from 'vue';
import { router,usePage } from '@inertiajs/vue3'
import { route } from "ziggy-js";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
    product: Object
})

const goBack = () => {
    window.history.back();
}
let selectedImage = ref(props.product.images[0]?.image); // Set the default selected image
const page = usePage();
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

const addToWishlist = (id) => {
router.post(route('wish_lists.create'), { product_id: id });
}

const addToCart = (id) => {
router.post(route('cart.create'), { product_id: id, quantity: 1 });
}

</script>

<style lang="scss" scoped></style>
