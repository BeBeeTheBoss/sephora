
<template>
    <Layout>
     <Link :href="$route('categories.create')"><button class="btn btn-sm mb-3 float-end " style="border:1px solid #ff006e;">+ Create New</button></Link>
     <h3 class="text-center text-success">Category List</h3>
     <table class="table">
       <thead>
         <tr class="table-danger">
           <th>ID</th>
           <th>Name</th>
           <th>Email</th>
           <th>Phone</th>
           <th>Message</th>
         </tr>
       </thead>
       <tbody>
         <tr v-for="(contact,index) in paginatedContacts" :key="contact.id">
          <td>{{ (currentPage - 1) * itemsPerPage + index + 1 }}</td>
           <td>{{contact.name}}</td>
           <td>{{ contact.email }}</td>
           <td>{{ contact.phone }}</td>
           <td>{{ contact.message }}</td>
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
 const props = defineProps({
    contacts : Array
 });

 const currentPage = ref(1);
const itemsPerPage = 10;
const totalPages = computed(() => Math.ceil(props.contacts.length / itemsPerPage));

// Paginated products computed property
const paginatedContacts = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.contacts.slice(start, end);
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


 </script>

 <style lang="scss" scoped>

 </style>
