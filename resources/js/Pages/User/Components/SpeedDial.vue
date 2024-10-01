<template>
    <!-- <v-speed-dial location="right bottom" transition="scale-transition">
        <template v-slot:activator="{ props: activatorProps }">
            <v-fab v-bind="activatorProps" size="large" class="speed-dial d-lg-none d-md-none d-sm-block d-block"
                icon="$vuetify">
                <IconBtn icon="fa-solid fa-cart-shopping" from="floatingIcon" count="3" class="icon" />
            </v-fab>
        </template>

</v-speed-dial> -->
    <v-dialog max-width="500">
        <template v-slot:activator="{ props: activatorProps }">
            <v-fab v-bind="activatorProps" size="large" class="speed-dial d-lg-none d-md-none d-sm-block d-block"
                icon="$vuetify">
                <IconBtn icon="fa-solid fa-cart-shopping" from="floatingIcon" v-if="cartData.length != 0" :count="cartData.length" class="icon" />
                <IconBtn icon="fa-solid fa-cart-shopping" from="floatingIcon" v-else class="icon" />
            </v-fab>
        </template>

        <template v-slot:default="{ isActive }">
            <v-card>
                <!-- <v-card-actions>
                    <v-btn text="Close Dialog" @click="isActive.value = false"></v-btn>
                </v-card-actions> -->
                <v-card-text v-if="cartData.length != 0">
                    <div class="flex justify-between items-center mt-2 mb-4">
                        <h5 class="fw-bold">My Shopping cart</h5>
                        <IconBtn icon="fa-solid fa-xmark" @click="isActive.value = false" />
                    </div>
                    <div v-for="item, index in cartData" :key="item"
                        class="bg-[#fe919e4f] my-2 py-2 px-2 shadow-sm rounded flex items-center"
                        style="position:relative;font-size:12px">
                        <div class="col-1">
                            <img :src="item.product.images[0].image" class="w-100">
                        </div>
                        <div class="col-3 text-center">
                            {{ item.product.name }}
                        </div>
                        <div class="col-6 flex justify-center items-center">
                            <IconBtn icon="fas fa-circle-minus" @click="subQuantity(index)" />
                            <input type="text" class="form-control text-center" disabled="true" :value="quantity[index]"
                                style="width:50%">
                            <IconBtn icon="fas fa-circle-plus"
                                @click="quantity[index]++, sub_total += item.product.price" />
                        </div>
                        <div class="col-2 text-center">
                            {{ item.product.price * quantity[index] }} Ks
                        </div>
                        <span @click="deleteProduct(item.id, item.product.price * quantity[index])"
                            class="translate-middle badge bg-danger" style="position:absolute;top:2px;right:-20px">
                            <FontAwesomeIcon icon="fa-solid fa-xmark" style="font-size:12px;cursor:pointer" />
                        </span>
                    </div>
                    <div class="text-end" style="font-size:13px">
                        SubTotal : {{ sub_total }} Ks
                    </div>
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
                            <div>+ 5000 Ks</div>
                        </div>
                        <div class="flex justify-between">
                            <div>Total</div>
                            <div>{{ sub_total + 5000 }} Ks</div>
                        </div>
                        <div class="mt-4 pb-2">
                            <button @click="checkOut"
                                class="w-100 bg-[#FE919D] text-white p-3 rounded-2">Checkout</button>
                        </div>
                    </div>
                </v-card-text>
                <div v-else class="row flex justify-center align-items-center" style="height:60vh">
                    <div class="col-9 text-center">
                        <img src="../../../images/nodata.svg" class="">
                        There's no data in your wishlist.
                    </div>
                </div>
                <div v-if="cartData.length == 0">
                    <IconBtn icon="fa-solid fa-xmark" @click="isActive.value = false" style="position: absolute;top:10px;right:10px"/>
                </div>
            </v-card>
        </template>
    </v-dialog>
</template>

<script setup>
import IconBtn from './IconBtn.vue';
import axios from 'axios';
import { usePage, router, useForm } from '@inertiajs/vue3';
import { ref, onMounted, onUpdated } from 'vue'
import { useToast } from 'vue-toastification';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { route } from "ziggy-js";

const toast = useToast();
const page = usePage();

const quantity = ref([]);
const sub_total = ref(0);
const formImageUrl = ref(null);

const props = defineProps({
    cartData: Array,
    payments: Array
})

const form = useForm({
    'phone': '',
    'address': '',
    'payment_id': '',
    'ss_image': [],
    'order_products': []
})

onMounted(() => {
    props.cartData.forEach(item => {
        quantity.value.push(item.quantity);
        sub_total.value += (item.product.price * item.quantity);
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
    sub_total.value -= quantity.value[index] == 1 ? 0 : props.cartData[index].product.price;
    quantity.value[index] = quantity.value[index] <= 1 ? 1 : quantity.value[index] - 1;
}

const deleteProduct = (id, price) => {
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
    props.cartData.forEach(item => {
        form.order_products.push({
            product_id: item.product_id,
            price: item.product.price,
            quantity: quantity.value[index],
            total_price: item.product.price * quantity.value[index]
        });
        index++;
    })

    form.post(route('orders.create'));

}

</script>

<style scoped>
.speed-dial {
    position: fixed;
    bottom: 140px;
    right: 80px;
}

.icon {
    background-color: #fe919d;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    color: white;
    padding-top: 12px
}
</style>
