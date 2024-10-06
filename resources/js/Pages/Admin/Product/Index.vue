<template>
  <Layout>
      <Link :href="$route('products.create')"><button class="btn btn-sm mb-3 float-end" style="border: 1px solid #ff006e">
          + Create New
      </button></Link>
      <div class="row">
              <div class=" mb-3">
                  <!-- <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="mt-2 flex" /> -->
                  <input type="text" placeholder="Search" v-model="searchQuery" class="form-control ms-2 w-25">
              </div>

          <div v-for="product in filteredProducts" :key="product.id" class="col-md-4">
              <div class="">
                      <img :src="product.images[0]?.image" style="height: 100px" />
                  <div>
                      <h6 class="mt-3" style="font-size:14px;">{{ product.name }}</h6>
                      <h6 class="whitespace-pre" style="font-size:14px;">{{ truncatedDescription(product) }}</h6>
                      <span class="font-semibold">${{ product.price }} </span>
                      <div class="flex">
                          <p class="me-1" v-if="product.discount_price > 0"
                              style="text-decoration: line-through;font-size:14px;">
                              {{ product.discount_price }}
                          </p>
                          <!-- <span v-if="product.discount_price != 0" class="text-danger" style="font-size:14px;">{{ product.discount_price }}% Off</span> -->
                      </div>
                      <p class="d-none">{{ product.is_active = product.is_active ? true : false }}</p>
                      <v-switch @change="changeSwitchValue(product.is_active, product.id)" focused="true"
                          v-model="product.is_active" color="primary"></v-switch>
                      <form @submit.prevent="deleteProduct(product.id)">
                          <Link :href="$route('products.edit', product.id)"><button
                              class="btn border border-warning btn-sm me-2">Edit</button></Link>
                          <button class="btn btn-sm" style="border: 1px solid #ff0054">
                              Delete
                          </button>
                          <Link :href="$route('products.detail', product.id)"><button
                              class="btn border btn-sm ms-2">Detail</button></Link>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </Layout>
</template>

<script setup>
import Layout from "../Layouts/Layout.vue";
import {ref,computed} from 'vue';
import { useForm } from "@inertiajs/vue3";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { del } from "../../Composables/httpMethod";
const props = defineProps({
  products: Object,
});


const truncatedDescription = (product) => {
  const words = product.description ? product.description.trim().split(/\s+/) : [];
  if (words.length > 50) {
    return words.slice(0,  5).join(' ') + '...';
  } else {
    return product.description;
  }
};


const changeSwitchValue = (is_active, id) => {
  const formForSwitch = useForm({
      id: id,
      is_active: is_active
  })
  let options = {
      preserveScroll: true,
      onSuccess: () => {
          toast.success("Congrats, it's successful!", { autoClose: 6000 })
      }
  }
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

const form = useForm({});

const deleteProduct = (id) => {
  del(route('products.destroy',id));
};
</script>

<style lang="scss" scoped></style>