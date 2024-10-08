<template>
    <Layout>
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

                    <!-- Product Status -->
                    <p class="mt-3" v-if="product.is_active">Status: <span class="text-success">Available</span></p>
                    <p v-else>Status: <span class="text-danger">Out of Stock</span></p>

                    <!-- Actions -->
                    <div class="mt-4">
                        <Link :href="$route('products.index')" class="btn btn-primary me-2">Back</Link>
                        <Link :href="$route('products.edit', product.id)" class="btn btn-secondary">Edit Product</Link>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "../Layouts/Layout.vue";
import { ref,defineProps } from "vue";

const props = defineProps({
    product: Object,
});

let selectedImage = ref(props.product.images[0].image); // Set the default selected image
</script>

<style scoped>
/* Add custom styling as needed */
</style>
