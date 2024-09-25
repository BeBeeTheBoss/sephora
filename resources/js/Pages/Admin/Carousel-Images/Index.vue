
<template>
    <Layout>
     <Link :href="$route('carousel_images.create')"><button class="btn mb-3 float-end btn-sm " style="border:1px solid #ff006e;">+ Create New</button></Link>
     <table class="table">
       <thead>
         <tr class="table-danger">
           <th>ID</th>
           <th>Image</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         <tr v-for="(carousel_image,index) in carousel_images" :key="carousel_image.id">
           <td>{{index+1}}</td>
           <td>
            <img v-if="carousel_image.name" :src="carousel_image.name" alt="" style="width:100px;height:100px;object-fit:cover">
            <div v-else>-</div>
           </td>
           <td>
            <form @submit.prevent="deleteImage(carousel_image.id)">
             <Link :href="$route('carousel_images.edit',carousel_image.id)"><button class="btn border btn-sm me-2">Edit</button></Link>
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
    carousel_images : Array
 });

const form = useForm({})

 const deleteImage = (id) => {
    del(form,route('carousel_images.destroy',id))
 }


 </script>

 <style lang="scss" scoped>

 </style>
