<template>
  <Layout>
    <h3 class="text-center font-bold" style="color:#fe919d;">Product List</h3>
      <Link :href="$route('products.create')"><button class="btn btn-sm mb-3 float-end" style="border: 1px solid #ff006e">
          + Create New
      </button></Link>
      <div class="row">
              <div class="mb-3">
                  <!-- <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="mt-2 flex" /> -->
                  <input type="text" placeholder="Search" v-model="searchQuery" class="form-control ms-2 w-25 border border-success">
              </div>

          <div v-for="product in filteredProducts" :key="product.id" class="col-md-3 p-2">
              <div class="">
                    <img class="mx-auto w-50" :src="product.images[0]?.image" style="height: 150px" />
                  <div>
                      <h6 class="mt-3 w-100 text-center font-semibold" style="font-size:14px;color:#fe919d;">{{ product.name }}</h6>
                      <h6 class="whitespace-pre" style="font-size:14px;">- {{ truncatedDescription(product) }}</h6>
                      <div class="flex">
                        <span class="font-bold">${{ product.price }} </span>

                          <p class="ms-2 mt-0.5 font-semibold" v-if="product.discount_price > 0"
                              style="text-decoration: line-through;font-size:14px;color:red;">
                              {{ product.discount_price }}
                          </p>
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
                              class="btn btn-success btn-sm ms-2">Detail</button></Link>
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
  if (words.length > 10) {
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
