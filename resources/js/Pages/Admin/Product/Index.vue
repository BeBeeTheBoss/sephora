
<template>
    <Layout>
     <Link href="/admin/products/create"><button class="btn btn-primary mb-3 float-end">+ Add Product</button></Link>
     <table class="table table-bordered">
       <thead>
         <tr>
           <th>ID</th>
           <th>Category Name</th>
           <th>Name</th>
           <th>Description</th>
           <th>Price</th>
           <th>Discount Price</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td>{{ increaseCount }}</td>
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
 const deleteProduct= (id) => {
    form.post(`/admin/products/${id}`);
 }

 const count = ref(1);

 const increaseCount = computed(() => {
  return count.value++;
 });
 </script>

 <style lang="scss" scoped>

 </style>
