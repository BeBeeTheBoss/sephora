
<template>
    <Layout>
     <Link href="/admin/categories/create"><button class="btn btn-primary mb-3 float-end">+ Add Category</button></Link>
     <table class="table table-bordered">
       <thead>
         <tr>
           <th>ID</th>
           <th>Name</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         <tr v-for="category in categories" :key="category.id">
           <td>{{category.id}}</td>
           <td>{{category.name}}</td>
           <td>
             <Link :href="`/admin/categories/${category.id}/edit`"><button class="btn btn-warning btn-sm me-2">Edit</button></Link>
             <button class="btn btn-danger btn-sm">Delete</button>
           </td>
         </tr>
       </tbody>
     </table>
    </Layout>

 </template>

 <script setup>
 import Layout from '../Layouts/Layout.vue'
 const props = defineProps(['categories']);
 </script>

 <style lang="scss" scoped>

 </style>
