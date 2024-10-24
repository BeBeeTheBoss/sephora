<template>
    <Navbar />
    <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <!-- Main Image -->
                    <v-img :src="selectedImage" style="width: 100%; height: 400px;" class="mb-4" />

                    <!-- Thumbnail Gallery -->

                    <div class="d-flex justify-content-center">
                        <v-img
                            v-for="(image, index) in product.images"
                            :key="index"
                            :src="image.image"
                            style="cursor: pointer;"
                            @click="selectedImage = image.image"
                            class="border"
                        />
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <h5 class="font-semibold">{{ product.name }}</h5>
                    <p class="whitespace-pre-wrap">{{ product.description }}</p>

                    <div v-if="product.discount_price > 0">
                        <span class="text-muted" >{{ product.price }}Ks</span>
                        <span class="text-danger ms-2" style="text-decoration: line-through;">{{ product.discount_price }}Ks</span>
                    </div>
                    <div v-else>
                        <span class="text-dark">{{ product.price }}Ks</span>
                    </div>

                </div>
            </div>
        </div>
        <Footer />
</template>

<script setup>
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue'
const props = defineProps({
    product : Object
})

let selectedImage = ref(props.product.images[0].image); // Set the default selected image
</script>

<style lang="scss" scoped>

</style>