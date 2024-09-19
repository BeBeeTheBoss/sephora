<template>
    <Layout>
        <Link :href="$route('payments.create')"><button class="btn mb-3 float-end text-white btn-sm" style="background-color:#ff006e;">+ Add</button></Link>

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
                <tr v-for="(payment, index) in payments" :key="payment.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ payment.name }}</td>
                    <td> <v-col cols="6">
                            <v-switch :model-value="true" color="primary" label="on"></v-switch>
                        </v-col></td>
                    <td>
                        <form @submit.prevent="deletePayment(payment.id)">
                            <Link :href="`/admin/payments/${payment.id}/edit`"><button
                                class="btn btn-warning btn-sm me-2"><font-awesome-icon icon="fa-regular fa-pen-to-square" /></button></Link>
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
import { useForm } from '@inertiajs/vue3';
import {del} from '../../Composables/httpMethod.js'
const props = defineProps(['payments']);
const form = useForm({})
const deletePayment = (id) => {
    del(form,route('payments.destroy', id));
}
</script>

<style lang="scss" scoped></style>
