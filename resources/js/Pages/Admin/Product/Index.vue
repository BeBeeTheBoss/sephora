<template>
    <Layout>
        <Link href="/admin/products/create"><button class="btn mb-3 float-end"
            style="border:1px solid #ff006e">
            + Create New
        </button></Link>
        <table class="table">
            <thead>
                <tr class="table-danger">
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
                    <td>
                        <div class="row p-2">
                            <div class="col-md-12" v-for="image in product.images" :key="image.id">
                                <v-img :src="image.image"
                                 class="my-2 mx-auto" style="width:130px;height:130px;object-fit:cover;border:1px solid green;border-radius:50%;">
                                </v-img>
                            </div>
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
