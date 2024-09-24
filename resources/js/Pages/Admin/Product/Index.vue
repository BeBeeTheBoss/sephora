<template>
    <Layout>
        <Link href="/admin/products/create"><button class="btn mb-3 float-end btn-sm text-white"
            style="background-color: #ed9077">
            + Add
        </button></Link>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Category Name</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Discount Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" :key="product.id">
                    <td>{{ index + 1 }}</td>
                    <td class="d-flex">
                        <div class="col-md-6" v-for="image in product.images" :key="image.id">
                            <v-img :src="image.image" style="width:120px;height:120px;">
                            </v-img>
                        </div>
                    </td>
                    <td>{{ product.category.name }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.discount_price }}</td>
                    <td>
                        <form @submit.prevent="deleteProduct(product.id)">
                            <Link :href="`/admin/products/${product.id}/edit`"><button
                                class="btn btn-warning btn-sm me-2">
                                <font-awesome-icon icon="fa-regular fa-pen-to-square" /></button></Link>
                            <button class="btn btn-danger btn-sm">
                                <font-awesome-icon icon="fa-solid fa-trash" />
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </Layout>
</template>

<script setup>
import Layout from "../Layouts/Layout.vue";
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    products: Object,
});

const form = useForm({});

const deleteProduct = (id) => {
    form.post(`/admin/products/${id}/delete`);
};
</script>

<style lang="scss" scoped></style>
