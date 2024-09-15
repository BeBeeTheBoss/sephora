
<template>
    <Layout>
    <Link href="/admin/payments/create"><button class="btn btn-primary mb-3 float-end">+ Add Payment</button></Link>

     <table class="table table-bordered">
       <thead>
         <tr>
           <th>ID</th>
           <th>Name</th>
           <th>Is Active</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         <tr v-for="payment in payments" :key="payment.id">
           <td>{{ increaseCount }}</td>
           <td>{{ payment.name }}</td>
           <td></td>
           <td></td>
         </tr>
       </tbody>
     </table>
    </Layout>

 </template>

 <script setup>
 import Layout from '../Layouts/Layout.vue'
 import {ref,computed} from 'vue'
 const props = defineProps(['payments']);

 const count = ref(1);

 const increaseCount = computed(() => {
  return count.value++;
 });
 </script>

 <style lang="scss" scoped>

 </style>
