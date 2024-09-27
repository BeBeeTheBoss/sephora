<template>
    <Layout>
        <div class="container">
            <h5 class="fw-bold mt-4 mb-3 col-10 offset-1">My orders</h5>
            <div class="row flex justify-center">
                <div class="col-10">
                    <table class="table table-striped border">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order Code</th>
                                <th>Total Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order, index in orders" :key="order">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    <span @click="showDialogArray[index] = true"
                                        style="text-decoration:underline;cursor:pointer;color:blue">
                                        {{ order.order_code }}
                                    </span>
                                </td>
                                <td>{{ order.total_price + 5000 }} MMK</td>
                                <td>{{ order.payment.name }}</td>
                                <td class="text-capitalize">
                                    <span class="rounded px-2 py-1 text-white" :class="checkStatus(order.status)">
                                        {{ order.status }}
                                    </span>
                                </td>
                                <td>{{ formatDate(order.created_at) }}</td>
                                <td style="z-index:100">
                                    <div class="dropdown">
                                        <IconBtn icon="fa-solid fa-ellipsis" style="margin-top:-5px"
                                            data-bs-toggle="dropdown" />
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item" style="cursor: pointer;">
                                                <div @click="refund(order.id)">
                                                    Refund
                                                </div>
                                            </li>
                                            <li class="dropdown-item" style="cursor: pointer;">
                                                <div @click="received(order.id)">
                                                    Received
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
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
                                                <div class="row py-1 mb-2"
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
                                                        {{ item.product.price * item.quantity }}
                                                    </div>
                                                </div>
                                                <div class="row mt-2 pt-1" style="border-top: 2px dashed #5F5F5F">
                                                    <div class="col-9 text-end">
                                                        Subtotal
                                                    </div>
                                                    <div class="col-3 text-end">
                                                        {{ order.total_price }}
                                                    </div>
                                                    <div class="col-9 text-end">
                                                        Shipping Fee
                                                    </div>
                                                    <div class="col-3 text-end">
                                                        5000
                                                    </div>
                                                    <div class="col-7 pt-2 offset-5"
                                                        style="border-bottom: 2px dashed #5F5F5F;">
                                                    </div>
                                                    <div class="col-9 text-end">
                                                        Total
                                                    </div>
                                                    <div class="col-3 text-end">
                                                        {{ order.total_price + 5000 }}
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
                                                    <div class="text-center py-2 mt-1"
                                                        style="border-top: 2px dashed #5F5F5F;border-bottom: 2px dashed #5F5F5F">
                                                        Thanks for you order
                                                    </div>
                                                </div>
                                            </v-card>
                                        </v-dialog>
                                    </div>
                                </template>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "./Layouts/Layout.vue";
import IconBtn from "./Components/IconBtn.vue";
import { ref, onMounted, onUpdated } from 'vue'
import { router, usePage } from "@inertiajs/vue3";
import { route } from 'ziggy-js';
import { useToast } from "vue-toastification";

const toast = useToast();
const page = usePage();

const showDialogArray = ref([]);

onMounted(() => {
    props.orders.forEach(() => {
        showDialogArray.value.push(false)
    })

    if (page.props.flash) {
        if (page.props.flash.success) {
            toast.success(page.props.flash.success);
            page.props.flash.success = null;
        } else if (page.props.flash.failed) {
            toast.error(page.props.flash.failed);
            page.props.flash.failed = null;
        }
    }
})

onUpdated(() => {

    if (page.props.flash) {
        if (page.props.flash.success) {
            toast.success(page.props.flash.success);
            page.props.flash.success = null;
        } else if (page.props.flash.failed) {
            toast.error(page.props.flash.failed);
            page.props.flash.failed = null;
        }
    }

})

const props = defineProps({
    orders: Array,
})

console.log(props.orders);

const formatDate = (dateString) => {
    // Create a new Date object from the dateString
    const date = new Date(dateString);

    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Format the date as per your requirement
    const formattedDate = `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;

    return formattedDate;
}

const checkStatus = (status) => {
    if (status === 'pending') {
        return 'bg-warning'
    } else if (status === 'delivered') {
        return 'bg-info'
    } else if (status === 'reject') {
        return 'bg-danger'
    } else if (status === 'completed') {
        return 'bg-success'
    }
}

const refund = (id) => {
    router.post(route('orders.refund', {
        id: id
    }))
}

const received = (id) => {
    router.post(route('orders.received', {
        id: id
    }))
}


</script>

<style></style>
