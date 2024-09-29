<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-4 border border-success rounded-3 p-3 shadow-lg">
            <form @submit.prevent="updatePayment">
                <h4 class="text-center">Edit Payment</h4>
                <v-row >
                    <v-col cols="12" class="my-2">
                        <v-textarea autofocus rows="1" v-model="form.name" variant="outlined" label="Name" hide-details
                            required></v-textarea>
                    </v-col>
                </v-row>
                <button class="btn btn-success w-100 rounded-lg text-white my-3">Update</button>
            </form>
        </div>
    </div>

</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import {update} from '../../Composables/httpMethod.js'
const props = defineProps({
    payment : Object
})


const form = useForm({
    name: props.payment.name,
})

const updatePayment = () => {
    update(form,route('payments.update', props.payment.id));
}
</script>

<style lang="scss" scoped></style>
