<template>
    <Layout>
      <Link href="/admin/products/create">
        <button class="btn btn-sm mb-3 float-end" style="border: 1px solid #ff006e">
          + Create New
        </button>
      </Link>
  
      <!-- Search Bar -->
      <div class="row">
        <h3 class="text-center text-success">Product List</h3>
        <div class="ms-32 d-flex mb-3">
          <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="mt-2" />
          <input
            type="text"
            placeholder="Search"
            v-model="searchQuery"
            class="form-control ms-2 w-25"
          />
        </div>
  
        <!-- Product List -->
        <div v-for="product in paginatedProducts" :key="product.id" class="col-md-3 mb-4">
          <div class="">
            <img class="" :src="product.images[0]?.image" style="width:150px;height:200px;object-fit: cover;" />
            <div>
              <h6 class="mt-3" style="font-size: 14px;">- {{ product.name }}</h6>
              <h6 class="whitespace-pre" style="font-size: 14px;">{{ product.description }}</h6>
              <span class="font-semibold">- ${{ product.price }}</span>
              <v-switch
                @change="changeSwitchValue(product.is_active, product.id)"
                v-model="product.is_active"
                color="primary"
              ></v-switch>
              <form @submit.prevent="deleteProduct(product.id)">
                <Link :href="$route('products.edit', product.id)">
                  <button class="btn border border-warning btn-sm me-2">Edit</button>
                </Link>
                <button class="btn btn-sm" style="border: 1px solid #ff0054">Delete</button>
                <Link :href="$route('products.detail', product.id)">
                  <button class="btn border btn-sm ms-2">Detail</button>
                </Link>
              </form>
            </div>
          </div>
        </div>
  
        <!-- Pagination (Bottom) -->
        <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4">
          <ul class="pagination">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
              <button class="page-link" @click="prevPage">Previous</button>
            </li>
            <li
              v-for="page in totalPages"
              :key="page"
              class="page-item"
              :class="{ active: currentPage === page }"
            >
              <button class="page-link" @click="goToPage(page)">{{ page }}</button>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
              <button class="page-link" @click="nextPage">Next</button>
            </li>
          </ul>
        </nav>
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
  products: Array, 
});

const changeSwitchValue = (is_active, id) => {
  const formForSwitch = useForm({
    id: id,
    is_active: is_active
  });
  let options = {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Congrats, it's successful!", { autoClose: 6000 });
    }
  };
  formForSwitch.post(route('products.toggle'), options);
};

const searchQuery = ref('');

// Pagination states
const currentPage = ref(1);
const itemsPerPage = 12; // Now showing 12 products per page

// Filtered products based on search query
const filteredProducts = computed(() => {
  if (!searchQuery.value) {
    return props.products;
  }

  const query = searchQuery.value.toLowerCase();

  return props.products.filter((product) => {
    return (
      product.name.toLowerCase().includes(query) ||
      product.description.toLowerCase().includes(query) ||
      product.price.toString().includes(query)
    );
  });
});

// Paginated products based on the current page
const paginatedProducts = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return filteredProducts.value.slice(start, end);
});

// Total number of pages based on the filtered products
const totalPages = computed(() => {
  return Math.ceil(filteredProducts.value.length / itemsPerPage);
});

// Navigate to a specific page
const goToPage = (page) => {
  currentPage.value = page;
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};

const form = useForm({});

const deleteProduct = (id) => {
  del(route('products.destroy', id));
};
</script>

