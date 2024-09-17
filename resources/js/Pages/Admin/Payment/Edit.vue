<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-4 border border-danger rounded-3 p-3">
            <form @submit.prevent="update">
                <h4 class="text-center">Edit Payment</h4>
                <v-row >
                    <v-col cols="12" class="my-2">
                        <v-textarea autofocus rows="1" v-model="form.name" variant="outlined" label="Name" hide-details
                            required></v-textarea>
                        <ErrorMessage :text="form.errors.name" />
                    </v-col>
                </v-row>
                <button class="btn w-100 rounded-lg text-white my-3" style="background-color:#ff595e;">Update</button>
            </form>
        </div>
    </div>

</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    payment : Object
})


const form = useForm({
    name: props.payment.name,
})

const update = () => {
    form.post('/admin/payments');
}
</script>

<style lang="scss" scoped></style>
