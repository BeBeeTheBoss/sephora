<template>
    <Layout>
        <div class="container">
            <h5 class="fw-bold mt-4 mb-3 col-10 offset-1">My orders</h5>
            <div class="row flex justify-center">
                <div class="col-10">
                    <table class="table bg-danger table-striped border">
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
                            <tr v-for="index in 10" :key="index">
                                <td>1</td>
                                <td>#ORD2022332</td>
                                <td>10000 MMK</td>
                                <td>COD</td>
                                <td>Delivered</td>
                                <td>2022-01-01</td>
                                <td>Refund</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="col-10"></div>
                <div class="col-10 row rounded-2 flex align-center p-3" style="background-color: #FFDDE1">
                    <div class="col-1">
                        <img src="https://via.placeholder.com/200" class="w-100">
                    </div>
                    <div class="col-3 text-start">
                        Something
                    </div>
                    <div class="col-6 flex justify-start items-center">
                        Pending
                    </div>
                    <div class="col-2 text-start">
                        10000 MMK
                    </div>
                </div> -->
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "./Layouts/Layout.vue";
</script>

<style></style>
