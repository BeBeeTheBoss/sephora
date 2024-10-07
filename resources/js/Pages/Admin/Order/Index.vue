<template>
    <Layout>
        <table class="table">
            <thead>
                <tr class="table-danger">
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Payment</th>
                    <th>Order Code</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Screen Shot</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order, index) in orders" :key="order.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ order.user.name }}</td>
                    <td>{{ order.payment.name }}</td>
                    <td>{{ order.order_code }}</td>
                    <td>{{ order.phone }}</td>
                    <td>{{ order.address }}</td>
                    <td>
                        <v-img :src="order.ss_image" style="width:80px;height:80px;object-fit:cover;" alt=""></v-img>
                    </td>
                    <td>{{ order.status }}</td>
                    <td v-if="order.status != 'completed'">
                        <form @submit.prevent>
                            <button @click="AcceptOrReject(order.id, 'accept')"
                                class="btn border border-success btn-sm me-2">Accept</button>
                            <button @click="AcceptOrReject(order.id, 'reject')" class="btn btn-sm broder border-danger"
                      >Reject</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </Layout>

</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
const props = defineProps(['orders']);
const form = useForm({
    id: '',
    status: ''
})

const AcceptOrReject = (id, status) => {

        form.id = id
        form.status = status
        let options = {
            preserveScroll: true,
            onSuccess: () => {
                toast.success("Congrats, it's successful!", { autoClose: 6000 })
            }
        }
        form.post(route('orders.decision'), options);

}

</script>

<style lang="scss" scoped></style>
