<template>
    <Layout>
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-4 border border-danger rounded-3 p-3">
            <form @submit.prevent="submit">
                <h4 class="text-center">Create Payment</h4>
                <v-row >
                    <v-col cols="12" class="my-2">
                        <v-textarea autofocus rows="1" v-model="form.name" variant="outlined" label="Name" hide-details
                            required></v-textarea>
                        <ErrorMessage :text="form.errors.name" />
                    </v-col>
                </v-row>
                <button class="btn w-100 rounded-lg text-white my-3" style="background-color:#ff595e;">Submit</button>
            </form>
        </div>
    </div>
</Layout>

</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue'
import { post } from '../../Composables/httpMethod.js';
const form = useForm({
    name: '',
})

const submit = () => {
    post(form,route('payments.store'));
}
</script>

<style lang="scss" scoped></style>
