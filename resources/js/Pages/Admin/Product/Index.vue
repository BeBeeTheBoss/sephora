<template>
    <Layout>
        <h3 class="text-center font-bold" style="color:#fe919d;">Product List</h3>
        <Link :href="$route('products.create')"><button class="btn btn-sm mb-3 float-end"
            style="border: 1px solid #ff006e">
            + Create New
        </button></Link>
        <div class="row">
            <div class="mb-3">
                <!-- <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="mt-2 flex" /> -->
                <input type="text" placeholder="Search" v-model="searchQuery"
                    class="form-control ms-2 w-25 border border-success">
            </div>

            <div class="row my-3">
                <div v-for="product in paginatedProducts" :key="product.id" class="col-6 col-md-3 mb-4">
                    <div class="border rounded-lg shadow-sm p-3 bg-white" style="transition: transform 0.2s;">
                        <img class="mx-auto rounded-lg w-100 h-48" :src="product.images[0]?.image"
                            style="object-fit: cover;" />
                        <div class="mt-2">
                            <h6 class="text-center text-pink-500 font-semibold" style="font-size: 16px;">{{ product.name
                                }}</h6>
                            <h6 class="whitespace-pre text-justify" style="font-size: 14px; color: #666;">- {{
                                truncatedDescription(product) }}</h6>
                            <div class="flex justify-center mt-2">
                                <span class="font-bold text-lg text-pink-600">{{ product.price }}Ks</span>
                                <p class="ms-2 font-semibold mt-0.5 text-red-600" v-if="product.discount_price > 0"
                                    style="text-decoration: line-through; font-size: 14px;">
                                    {{ product.discount_price }}Ks
                                </p>
                            </div>
                            <p class="d-none">{{ product.is_active = product.is_active ? true : false }}</p>
                            <div class="flex justify-center mt-3">
                                <v-switch @change="changeSwitchValue(product.is_active, product.id)"
                                    v-model="product.is_active" color="primary" focused="true"></v-switch>
                            </div>
                            <div class="flex justify-center mt-3">
                                <form @submit.prevent="deleteProduct(product.id)" class="flex flex-col items-center">
                                    <Link :href="$route('products.edit', product.id)">
                                    <button class="btn btn-warning btn-sm mb-2">Edit</button>
                                    </Link>
                                    <button class="btn btn-danger btn-sm mb-2"
                                        style="border: 1px solid #ff0054;">Delete</button>
                                    <Link :href="$route('products.detail', product.id)">
                                    <button class="btn btn-success btn-sm">Detail</button>
                                    </Link>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Pagination Controls -->
             <div class="d-flex justify-content-center">
                <button class="btn btn-secondary me-2" @click="previousPage" :disabled="currentPage === 1">Previous</button>
                <button class="btn btn-success" @click="nextPage" :disabled="currentPage >= totalPages">Next</button>
            </div>

        </div>

    </Layout>
</template>

<script setup>
import Layout from "../Layouts/Layout.vue";
import { ref, computed } from 'vue';
import { useForm } from "@inertiajs/vue3";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { del } from "../../Composables/httpMethod";
const props = defineProps({
    products: Object,
});


const currentPage = ref(1);
const itemsPerPage = 20;
const totalPages = computed(() => Math.ceil(filteredProducts.value.length / itemsPerPage));

const truncatedDescription = (product) => {
    const words = product.description ? product.description.trim().split(/\s+/) : [];
    if (words.length > 5) {
        return words.slice(0, 4).join(' ') + '...';
    } else {
        return product.description;
    }
};


const changeSwitchValue = (is_active, id) => {
    const formForSwitch = useForm({
        id: id,
        is_active: is_active
    });
    let options = {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Status updated successfully!", { autoClose: 6000 });
        }
    };
    formForSwitch.post(route('products.toggle'), options);
};

const searchQuery = ref('');


const filteredProducts = computed(() => {
    if (!searchQuery.value) {
        return props.products;
    }

    const query = searchQuery.value.toLowerCase();

    return props.products.filter(product => {
        return (
            product.name.toLowerCase().includes(query) ||
            product.description.toLowerCase().includes(query) ||
            product.price.toString().includes(query)
        );
    });
});


// Paginated products computed property
const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return filteredProducts.value.slice(start, end);
});


// Pagination methods
const previousPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
}

const form = useForm({});

const deleteProduct = (id) => {
    del(route('products.destroy', id));
};
</script>

<style scoped>
.InputContainer {
    width: 210px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(to bottom, rgb(227, 213, 255), rgb(255, 231, 231));
    border-radius: 30px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.075);
}

.input {
    width: 200px;
    height: 30px;
    border: none;
    outline: none;
    caret-color: rgb(255, 81, 0);
    background-color: rgb(255, 255, 255);
    border-radius: 30px;
    padding-left: 15px;
    letter-spacing: 0.8px;
    color: rgb(19, 19, 19);
    font-size: 13.4px;
}
</style>
