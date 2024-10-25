<template>
    <Layout>
        <div class="container-fluid">
            <div class="row mt-3" v-if="products.length != 0">
                <div class="col-8" style="padding:0px 70px">
                    <h5 class="fw-bold my-3">My Shopping Cart</h5>
                    <div class="bg-[#fe919e4f] my-2 py-2 px-2 shadow-sm rounded flex items-center"
                        v-for="product, index in products" :key="product" style="position:relative">
                        <div class="col-1">
                            <img :src="product.product.images[0]?.image" class="w-100"
                                style="height:100px;object-fit:cover;object-position: center;">
                        </div>
                        <div class="col-3 text-start ps-5">
                            {{ product.product.name }}
                        </div>
                        <div class="col-6 flex justify-center items-center">
                            <IconBtn icon="fas fa-circle-minus" @click="subQuantity(index)" />
                            <input type="text" class="form-control text-center" disabled="true" :value="quantity[index]"
                                style="width:13%">
                            <IconBtn icon="fas fa-circle-plus"
                                @click="quantity[index]++, sub_total += product.product.price" />

                        </div>
                        <div class="col-2 text-center">
                           {{ product.product.price * quantity[index] }}Ks
                        </div>
                        <span @click="deleteProduct(product.id,product.product.price * quantity[index])" class="translate-middle badge bg-danger"
                            style="position:absolute;top:50%;right:-55px;cursor:pointer">
                            <FontAwesomeIcon icon="fa-solid fa-trash-can" style="font-size:16px;" />
                        </span>
                    </div>
                    <div class="text-end">
                         SubTotal : {{ sub_total }}Ks
                    </div>
                </div>
                <div class="col-4 ps-5 flex justify-center"
                    style="height:85vh;overflow:scroll;border-left: solid 1px #FE919D;">
                    <div class="w-100" style="">
                        <h5 class="fw-bold mt-3 mb-4">Summary</h5>
                        <v-textarea color="#FE919D" rows="1" v-model="form.phone" label="Phone number"
                            variant="outlined"></v-textarea>
                        <v-textarea color="#FE919D" rows="3" v-model="form.address" label="Address"
                            variant="outlined"></v-textarea>
                        <v-select v-model="form.payment_id" color="#FE919D" label="Select Payment method"
                            :items="payments" item-title="name" item-value="id" variant="outlined"></v-select>
                        <!-- <v-file-input color="#FE919D" chips prepend-icon="mdi-camera" @change="onFileChange"
                            variant="outlined" label="Payment screenshot" show-size clearable
                            @click:clear="clearImage(1)"></v-file-input> -->
                        <v-file-input chips prepend-icon="mdi-camera" @change="onFileChange"
                            @input="form.ss_image = $event.target.files[0]" variant="outlined"
                            label="Payment screenshot" show-size clearable @click:clear="clearImage"></v-file-input>
                        <div class="preview flex justify-center">
                            <v-img class="rounded-lg mb-4" :width="1" :height="250" cover v-if="formImageUrl"
                                :src="formImageUrl" />
                        </div>
                        <div class="flex justify-between">
                            <div>Shipping Fee</div>
                            <div>+ 500Ks</div>
                        </div>
                        <div class="flex justify-between">
                            <div>Total</div>
                            <div>{{ sub_total }}Ks</div>
                        </div>
                        <div class="mt-4 pb-2">
                            <button @click="checkOut"
                                class="w-100 bg-[#FE919D] text-white p-3 rounded-2">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="row flex justify-center align-items-center" style="height:70vh">
                <div class="col-2 text-center">
                    <img src="../../images/nodata.svg" class="">
                    There's no data in your cart.
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from './Layouts/Layout.vue'
import IconBtn from './Components/IconBtn.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { ref, onMounted, onUpdated } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import { route } from 'ziggy-js';

const props = defineProps({
    'products': Object,
    'payments': Object
})

const toast = useToast();
const page = usePage();

const quantity = ref([]);
const sub_total = ref(0);

const formImageUrl = ref(null);

const form = useForm({
    'phone': '',
    'address': '',
    'payment_id': '',
    'ss_image': [],
    'order_products': []
})


onMounted(() => {
    props.products.forEach(product => {
        quantity.value.push(product.quantity);
        sub_total.value += (product.product.price * product.quantity);
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

const onFileChange = (e) => {
    const file = e.target.files[0];
    formImageUrl.value = URL.createObjectURL(file);
}

const clearImage = () => {
    formImageUrl.value = null;
    form.ss_image = [];
}

const subQuantity = (index) => {
    sub_total.value -= quantity.value[index] == 1 ? 0 : props.products[index].product.price;
    quantity.value[index] = quantity.value[index] <= 1 ? 1 : quantity.value[index] - 1;
}

const deleteProduct = (id,price) => {
    router.delete(route('cart.delete', {
        id: id
    }));
    sub_total.value -= price
}

const checkOut = () => {
    if (form.phone == '' || form.address == '' || form.payment_id == '' || form.ss_image == []) {
        toast.warning('All fields are required');
        return;
    }

    let index = 0;
    props.products.forEach(product => {
        form.order_products.push({
            product_id: product.product_id,
            price: product.product.price,
            quantity: quantity.value[index],
            total_price: product.product.price * quantity.value[index]
        });
        index++;
    })

    form.post(route('orders.create'));

}

</script>

<style scoped>
::-webkit-scrollbar {
    display: none;
}
</style>
