
<template>
    <Layout>
     <Link href="/admin/categories/create"><button class="btn btn-primary mb-3 float-end">+ Add Category</button></Link>
     <table class="table table-bordered">
       <thead>
         <tr>
           <th>ID</th>
           <th>Image</th>
           <th>Name</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         <tr v-for="category in categories" :key="category.id">
           <td>{{increaseCount}}</td>
           <td>
            <img :src="`/storage/images/${category.image}`" alt="" style="width:100px;">
           </td>
           <td>{{category.name}}</td>
           <td>
            <form @submit.prevent="deleteCategory(category.id)">
             <Link :href="`/admin/categories/${category.id}/edit`"><button class="btn btn-warning btn-sm me-2">Edit</button></Link>
             <button class="btn btn-danger btn-sm">Delete</button>
            </form>
           </td>
         </tr>
       </tbody>
     </table>
    </Layout>

 </template>

 <script setup>
 import Layout from '../Layouts/Layout.vue'
 import {ref,computed} from 'vue'
 import {useForm} from '@inertiajs/vue3'
 const props = defineProps(['categories']);
const form = useForm({})
 const deleteCategory = (id) => {
    form.post(`/admin/categories/${id}`);
 }
 const count = ref(1);

 const increaseCount = computed(() => {
  return count.value++;
 });
 </script>

 <style lang="scss" scoped>

 </style>
