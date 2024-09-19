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
                    <div class="w-100">
                        <div class="flex justify-between items-center mt-2 mb-4">
                            <h5 class="fw-bold">Summary</h5>
                            <IconBtn icon="fa-solid fa-xmark" @click="isActive.value = false" />
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
