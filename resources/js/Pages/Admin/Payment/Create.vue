<template>
    <Layout>
        <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
            <div class="col-md-6 col-lg-4 border border-success rounded-3 p-4 shadow-lg">
                <form @submit.prevent="submit">
                    <h4 class="text-center mb-4 text-success">Create Payment</h4>
                    <v-row>
                        <v-col cols="12" class="my-2">
                            <v-textarea
                                autofocus
                                rows="1"
                                v-model="form.name"
                                variant="outlined"
                                label="Payment Name"
                                hide-details
                                class="mb-3"
                            ></v-textarea>
                           
                        </v-col>
                    </v-row>
                    <button class="btn btn-success w-100 rounded-lg text-white my-3" style="background-color: #4caf50; border: none;">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue';
import { post } from '../../Composables/httpMethod.js';
import { useToast } from 'vue-toastification';

const form = useForm({
    name: '',
});
const toast = useToast();

const submit = () => {
    if(form.name === '') {
        toast.warning('The name field is required');
    } else {
        post(form, route('payments.store'));
    }
}
</script>

<style scoped>
/* Additional styling can be added here */
</style>
