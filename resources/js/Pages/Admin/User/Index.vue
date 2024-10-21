<template>
    <Layout>
        <table class="table">
            <thead>
                <tr class="table-danger">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="user.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role }}</td>
                    <td>{{ formatDate(user.created_at) }}</td>
                    <td>
                        <form @submit.prevent="userDelete(user.id)">
                            <button class="btn btn-sm" style="border:1px solid #ff0054;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </Layout>
</template>

<script setup>
import Layout from '../Layouts/Layout.vue';
import { ref } from 'vue';
import {del} from '../../Composables/httpMethod.js'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
    users : Array,
});

const formatDate = (dateString) => {
    const date = new Date(dateString);

    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const formattedDate = `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;

    return formattedDate;
}


const userDelete = (id) => {
    del(route('users.destroy', id));
}

</script>


<style lang="scss" scoped></style>
