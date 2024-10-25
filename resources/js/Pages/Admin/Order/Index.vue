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
                    <td> <span @click="showDialogArray[index] = true"
                            style="text-decoration:underline;cursor:pointer;color:blue">
                            {{ order.order_code }}
                        </span></td>
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
                            <button @click="AcceptOrReject(order.id, 'reject')"
                                class="btn btn-sm broder border-danger">Reject</button>
                        </form>
                    </td>

                    <template>
                        <div>
                            <v-dialog v-model="showDialogArray[index]" width="auto">
                                <v-card width="400px" class="px-4 py-3 inconsolata">
                                    <div>
                                        <h3 class="text-center mb-3">Sephora</h3>

                                    </div>
                                    <div class="flex justify-between my-2">
                                        <div class="">
                                            Order Code: {{ order.order_code }}
                                        </div>
                                        <div>
                                            Date: {{ formatDate(order.created_at) }}
                                        </div>
                                    </div>
                                    <div class="row py-1 mb-2 mt-4"
                                        style="border-bottom: 2px dashed #5F5F5F;border-top: 2px dashed #5F5F5F">
                                        <div class="col-7 text-start">
                                            Item
                                        </div>
                                        <div class="col-2 text-end">
                                            Qty
                                        </div>
                                        <div class="col-3 text-end">
                                            Price
                                        </div>
                                    </div>
                                    <div class="row" v-for="item in order.order_products" :key="item">
                                        <div class="col-7 text-start">
                                            {{ item.product.name }}
                                        </div>
                                        <div class="col-2 text-end">
                                            {{ item.quantity }}
                                        </div>
                                        <div class="col-3 text-end">
                                            {{ item.product.price }}Ks
                                        </div>
                                    </div>
                                    <div class="row mt-2 pt-1" style="border-top: 2px dashed #5F5F5F">
                                        <div class="col-9 text-end">
                                            Subtotal
                                        </div>
                                        <div class="col-3 text-end">
                                            {{ order.total_price }}Ks
                                        </div>
                                        <div class="col-9 text-end">
                                            Shipping Fee
                                        </div>
                                        <div class="col-3 text-end">
                                            500Ks
                                        </div>
                                        <div class="col-7 pt-2 offset-5" style="border-bottom: 2px dashed #5F5F5F;">
                                        </div>
                                        <div class="col-9 text-end">
                                            Total
                                        </div>
                                        <div class="col-3 text-end">
                                            {{ order.total_price + 500 }}Ks
                                        </div>
                                    </div>
                                    <div class="row mt-4 py-2 flex justify-center"
                                        style="border-top: 2px dashed #5F5F5F">
                                        <div class="text-end">
                                            <div class="col-12 mb-2">
                                                <div class="mb-2">
                                                    Order Information
                                                </div>
                                                <div>
                                                    Phone : {{ order.phone }}
                                                </div>
                                                <div>
                                                    Address : {{ order.address }}
                                                </div>
                                                <div>
                                                    Payment : {{ order.payment.name }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </v-card>
                            </v-dialog>
                        </div>
                    </template>
                </tr>
            </tbody>
        </table>
    </Layout>

</template>

<script setup>
import { ref,onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
const props = defineProps({
    orders: Array
});
const form = useForm({
    id: '',
    status: ''
})

const showDialogArray = ref([]);

onMounted(() => {
    props.orders.forEach(() => {
        showDialogArray.value.push(false)
    })
});

const formatDate = (dateString) => {
    // Create a new Date object from the dateString
    const date = new Date(dateString);

    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Format the date as per your requirement
    const formattedDate = `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;

    return formattedDate;
}


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
