
<template>
    <Layout>
     <table class="table table-bordered">
       <thead>
         <tr>
           <th>ID</th>
           <th>User Name</th>
           <th>Payment</th>
           <th>Order Code</th>
           <th>Phone</th>
           <th>Address</th>
           <th>Screen Shot</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td></td>
         </tr>
       </tbody>
     </table>
    </Layout>

 </template>

 <script setup>
 import Layout from '../Layouts/Layout.vue'
 import {ref} from 'vue'
 const props = defineProps(['orders']);


 </script>

 <style lang="scss" scoped>

 </style>
