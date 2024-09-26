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
                            <tr v-for="order,index in orders" :key="order">
                                <td>{{ index+1 }}</td>
                                <td>{{ order.order_code }}</td>
                                <td>{{ order.total_price }} MMK</td>
                                <td>{{ order.payment.name }}</td>
                                <td class="text-capitalize">
                                    <span class="bg-warning text-white rounded px-2 py-1">
                                        {{ order.status }}
                                    </span>
                                </td>
                                <td>{{ formatDate(order.created_at) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <IconBtn icon="fa-solid fa-ellipsis" style="margin-top:-5px" data-bs-toggle="dropdown"/>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item" style="cursor: pointer;">
                                                <div>
                                                    Refund
                                                </div>
                                            </li>
                                            <li class="dropdown-item" style="cursor: pointer;">
                                                <div>
                                                    Received
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
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

const props = defineProps({
    orders: Array,
})

const formatDate = (dateString) => {
    // Create a new Date object from the dateString
    const date = new Date(dateString);

    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Format the date as per your requirement
    const formattedDate = `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;

    return formattedDate;
}


</script>

<style></style>
