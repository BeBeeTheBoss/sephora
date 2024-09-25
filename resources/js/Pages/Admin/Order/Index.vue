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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order, index) in orders" :key="order.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ order.user_name }}</td>
                    <td>{{ order.payment }}</td>
                    <td>{{ order.order_code }}</td>
                    <td>{{ order.phone }}</td>
                    <td>{{ order.address }}</td>
                    <td>{{ order.ss }}</td>
                    <td>
                        <form @submit.prevent>
                            <button @click="AcceptOrReject(order.id,'accept')" class="btn border btn-sm me-2">Accept</button>
                            <button @click="AcceptOrReject(order.id,'reject')" class="btn btn-sm" style="border:1px solid #ff0054;">Reject</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </Layout>

</template>

<script setup>
import Layout from '../Layouts/Layout.vue'
const props = defineProps(['orders']);

const AcceptOrReject = (id,status) => {
    if(status === 'accept'){
        console.log('accept');
    }else{
        console.log('reject');
    }
}

</script>

<style lang="scss" scoped></style>
