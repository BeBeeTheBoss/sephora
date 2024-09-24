
<template>
    <Layout>
     <Link :href="$route('carousel_images.create')"><button class="btn mb-3 float-end btn-sm text-white" style="background-color:#ff006e;">+ Add</button></Link>
     <table class="table table-bordered" style="border:1px solid #ff006e;">
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
             <Link :href="`/admin/carousel_images/${carousel_image.id}/edit`"><button class="btn btn-warning btn-sm me-2"><font-awesome-icon icon="fa-regular fa-pen-to-square" /></button></Link>
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
