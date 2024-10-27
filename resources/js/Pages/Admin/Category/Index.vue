
<template>
    <Layout>
     <Link :href="$route('categories.create')"><button class="btn btn-sm mb-3 float-end " style="border:1px solid #ff006e;">+ Create New</button></Link>
     <h3 class="text-center text-success">Category List</h3>
     <table class="table">
       <thead>
         <tr class="table-danger">
           <th>ID</th>
           <th>Image</th>
           <th>Name</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         <tr v-for="(category,index) in paginatedCategories" :key="category.id">
          <td>{{ (currentPage - 1) * itemsPerPage + index + 1 }}</td>
          <td>
            <img v-if="category.image" :src="category.image" alt="" style="width:100px;height:100px;object-fit:cover;border-radius:50%;">
            <div v-else>-</div>
           </td>
           <td>{{category.name}}</td>

           <td>
            <form @submit.prevent="deleteCategory(category.id)">
             <Link :href="`/admin/categories/${category.id}/edit`"><button class="btn btn-sm me-2 border border-warning">Edit</button></Link>
             <button class="btn btn-sm" style="border:1px solid #ff0054;">Delete</button>
            </form>
           </td>
         </tr>
       </tbody>
     </table>
       <!-- Pagination Controls -->
       <div class="d-flex justify-content-center">
                <button class="btn btn-secondary me-2" @click="previousPage" :disabled="currentPage === 1">Previous</button>
                <button class="btn btn-success" @click="nextPage" :disabled="currentPage >= totalPages">Next</button>
            </div>
    </Layout>

 </template>

 <script setup>
 import {ref,computed} from 'vue';
 import Layout from '../Layouts/Layout.vue'
 import {useForm} from '@inertiajs/vue3'
 import {del} from '../../Composables/httpMethod.js'
 const props = defineProps({
    categories : Array
 });

 const currentPage = ref(1);
const itemsPerPage = 10;
const totalPages = computed(() => Math.ceil(props.categories.length / itemsPerPage));

// Paginated products computed property
const paginatedCategories = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.categories.slice(start, end);
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


const form = useForm({})

 const deleteCategory = (id) => {
    del(route('categories.destroy',id))
 }

 </script>

 <style lang="scss" scoped>

 </style>
