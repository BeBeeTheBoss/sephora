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
                <IconBtn icon="fa-solid fa-cart-shopping" from="floatingIcon" count="3" class="icon" />
            </v-fab>
        </template>

        <template v-slot:default="{ isActive }">
            <v-card>
                <!-- <v-card-actions>
                    <v-btn text="Close Dialog" @click="isActive.value = false"></v-btn>
                </v-card-actions> -->
                <v-card-text>
                    <div class="flex justify-between items-center mt-2 mb-4">
                        <h5 class="fw-bold">My Shopping cart</h5>
                        <IconBtn icon="fa-solid fa-xmark" @click="isActive.value = false" />
                    </div>
                    <div v-for="item,index in cartData" :key="item" class="bg-[#fe919e4f] my-2 py-2 px-2 shadow-sm rounded flex items-center"
                        style="position:relative;font-size:12px">
                        <div class="col-1">
                            <img :src="item.product.images[0].image" class="w-100">
                        </div>
                        <div class="col-3 text-center">
                            {{ item.product.name }}
                        </div>
                        <div class="col-6 flex justify-center items-center">
                            <IconBtn icon="fas fa-circle-minus" @click="subQuantity(index)" />
                            <input type="text" class="form-control text-center" disabled="true" :value="quantity[index]" style="width:50%">
                            <IconBtn icon="fas fa-circle-plus"
                                @click="quantity[index]++, sub_total += item.product.price" />
                        </div>
                        <div class="col-2 text-center">
                            {{ item.product.price * quantity[index] }} Ks
                        </div>
                        <span class="translate-middle badge bg-danger" style="position:absolute;top:50%;right:-55px">
                            <FontAwesomeIcon icon="fa-solid fa-trash-can" style="font-size:16px;cursor:pointer" />
                        </span>
                    </div>
                    <div class="text-end" style="font-size:13px">
                        SubTotal : {{ sub_total }} Ks
                    </div>
                    <div class="w-100">
                        <div class="flex justify-between items-center mt-4 mb-3">
                            <h5 class="fw-bold">Summary</h5>
                        </div>
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
                        <div class="mt-4">
                            <button class="w-100 bg-[#FE919D] text-white p-3 rounded-2">Checkout</button>
                        </div>
                    </div>
                </v-card-text>
            </v-card>
        </template>
    </v-dialog>
</template>

<script setup>
import IconBtn from './IconBtn.vue';
import axios from 'axios';
import {usePage} from '@inertiajs/vue3';
import {ref,onMounted,onUpdated} from 'vue'
import { useToast } from 'vue-toastification';

const toast = useToast();
const page = usePage();

const quantity = ref([]);
const sub_total = ref(0);

const props = defineProps({
    cartData : Array
})

console.log(props.cartData);

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

const subQuantity = (index) => {
    sub_total.value -= quantity.value[index] == 1 ? 0 : props.cartData[index].product.price;
    quantity.value[index] = quantity.value[index] <= 1 ? 1 : quantity.value[index] - 1;
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
