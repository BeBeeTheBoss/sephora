<template>
    <Layout>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-8" style="padding:0px 70px">
                    <h5 class="fw-bold my-3">My Shopping Cart</h5>
                    <div class="bg-[#fe919e4f] my-2 py-2 px-2 shadow-sm rounded flex items-center"
                        style="position:relative">
                        <div class="col-1">
                            <img src="https://via.placeholder.com/200" class="w-100">
                        </div>
                        <div class="col-3 text-center">
                            Something
                        </div>
                        <div class="col-6 flex justify-center items-center">
                            <IconBtn icon="fas fa-circle-plus" />
                            <input type="text" class="form-control w-25">
                            <IconBtn icon="fas fa-circle-minus" />
                        </div>
                        <div class="col-2 text-center">
                            10000 MMK
                        </div>
                        <span class="translate-middle badge bg-danger" style="position:absolute;top:50%;right:-55px">
                            <FontAwesomeIcon icon="fa-solid fa-trash-can" style="font-size:16px;cursor:pointer" />
                        </span>
                    </div>
                    <div class="bg-[#fe919e4f] my-2 py-2 px-2 shadow-sm rounded flex items-center"
                        style="position:relative">
                        <div class="col-1">
                            <img src="https://via.placeholder.com/200" class="w-100">
                        </div>
                        <div class="col-3 text-center">
                            Something
                        </div>
                        <div class="col-6 flex justify-center items-center">
                            <IconBtn icon="fas fa-circle-plus" />
                            <input type="text" class="form-control w-25">
                            <IconBtn icon="fas fa-circle-minus" />
                        </div>
                        <div class="col-2 text-center">
                            10000 MMK
                        </div>
                        <span class="translate-middle badge bg-danger" style="position:absolute;top:50%;right:-55px">
                            <FontAwesomeIcon icon="fa-solid fa-trash-can" style="font-size:16px;cursor:pointer" />
                        </span>
                    </div>
                    <div class="text-end">
                        SubTotal : 420000 MMK
                    </div>
                </div>
                <div class="col-4 ps-5 flex justify-center"
                    style="height:85vh;overflow:scroll;border-left: solid 1px #FE919D;">
                    <div class="w-100" style="">
                        <h5 class="fw-bold mt-3 mb-4">Summary</h5>
                        <v-textarea color="#FE919D" rows="1" v-model="phone" label="Phone number"
                            variant="outlined"></v-textarea>
                        <v-textarea color="#FE919D" rows="3" v-model="address" label="Address"
                            variant="outlined"></v-textarea>
                        <v-select color="#FE919D" label="Select Payment method"
                            :items="['K-Pay', 'Aya-Pay', 'Wave-Pay', 'CB-Pay', 'Uab-Pay']"
                            variant="outlined"></v-select>
                        <v-file-input color="#FE919D" chips prepend-icon="mdi-camera" @change="onFileChange"
                            variant="outlined" label="Payment screenshot" show-size clearable
                            @click:clear="clearImage(1)"></v-file-input>
                        <div class="flex justify-between">
                            <div>Shipping Fee</div>
                            <div>+ 4000 MMK</div>
                        </div>
                        <div class="flex justify-between">
                            <div>Total</div>
                            <div>424000 MMK</div>
                        </div>
                        <div class="mt-4 pb-2">
                            <button class="w-100 bg-[#FE919D] text-white p-3 rounded-2">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from './Layouts/Layout.vue'
import IconBtn from './Components/IconBtn.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

</script>

<style scoped>
::-webkit-scrollbar {
    display: none;
}
</style>
