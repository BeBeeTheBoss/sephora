<template>
    <Layout>
        <Link href="/admin/products/create"><button class="btn mb-3 float-end" style="border: 1px solid #ff006e">
            + Create New
        </button></Link>
        <div class="row">
            <div v-for="product in products" :key="product.id" class="col-md-3">
                <div class="card card-body">
                    <v-img :src="product.images[0].image" style="height: 100px"></v-img>
                    <div>
                        <h6 class="mt-3" style="font-size:14px;">{{ product.name }}</h6>
                        <h6 style="font-size:14px;">{{ product.description }}</h6>
                        <div class="flex">
                            <p class="me-3" v-if="product.discount_price > 0" style="text-decoration: line-through;font-size:14px;">
                                {{ product.price }}
                            </p>
                            <span style="font-size:14px;">{{ product.discount_price }} %</span>
                        </div>
                         <p class="d-none">{{ product.is_active = product.is_active ? true : false }}</p>
                            <v-switch @change="changeSwitchValue(product.is_active, product.id)" focused="true"
                                v-model="product.is_active" color="primary"></v-switch>
                        <form @submit.prevent="deleteProduct(product.id)">
                            <Link :href="$route('products.edit', product.id)"><button
                                class="btn border btn-sm me-2">Edit</button></Link>
                            <button class="btn btn-sm" style="border: 1px solid #ff0054">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "../Layouts/Layout.vue";
import { useForm } from "@inertiajs/vue3";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
const props = defineProps({
    products: Object,
});


const changeSwitchValue = (is_active, id) => {
    const formForSwitch = useForm({
        id: id,
        is_active: is_active
    })
    let options = {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Congrats, it's successful!", {autoClose: 6000})
        }
    }
    formForSwitch.post(route('products.toggle'),options);
};



const form = useForm({});

const deleteProduct = (id) => {
    form.post(`/admin/products/${id}/delete`);
};
</script>

<style lang="scss" scoped></style>
