
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
         <tr v-for="(category,index) in categories" :key="category.id">
           <td>{{index+1}}</td>
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
    </Layout>

 </template>

 <script setup>
 import Layout from '../Layouts/Layout.vue'
 import {useForm} from '@inertiajs/vue3'
 import {del} from '../../Composables/httpMethod.js'
 const props = defineProps({
    categories : Array
 });
const form = useForm({})

 const deleteCategory = (id) => {
    del(route('categories.destroy',id))
 }

 </script>

 <style lang="scss" scoped>

 </style>
