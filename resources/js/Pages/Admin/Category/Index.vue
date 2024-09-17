
<template>
    <Layout>
     <Link href="/admin/categories/create"><button class="btn mb-3 float-end btn-sm text-white" style="background-color:#ED9077;">+ Add</button></Link>
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
         <tr v-for="(category,index) in categories" :key="category.id">
           <td>{{index+1}}</td>
           <td>
            <img :src="`/storage/images/${category.image}`" alt="" style="width:120px;height:100px;">
           </td>
           <td>{{category.name}}</td>
           <td>
            <form @submit.prevent="deleteCategory(category.id)">
             <Link :href="`/admin/categories/${category.id}/edit`"><button class="btn btn-warning btn-sm me-2"><font-awesome-icon icon="fa-regular fa-pen-to-square" /></button></Link>
             <button class="btn btn-danger btn-sm"><font-awesome-icon icon="fa-solid fa-trash" /></button>
            </form>
           </td>
         </tr>
       </tbody>
     </table>
    </Layout>

 </template>

 <script setup>
 import Layout from '../Layouts/Layout.vue'
 import {ref} from 'vue'
 import {useForm} from '@inertiajs/vue3'
 const props = defineProps(['categories']);
const form = useForm({})
 const deleteCategory = (id) => {
    form.post(`/admin/categories/${id}`);
 }
 const count = ref(1);

 </script>

 <style lang="scss" scoped>

 </style>
