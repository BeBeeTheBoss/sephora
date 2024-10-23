<template>
    <Navbar />
    <h3 class="text-center my-4">FeedBacks</h3>
    <div class="container row py-3">
        <div class="container p-5">
            <h3>Do you Like Website?</h3>
            <v-rating hover :length="5" :size="32" v-model="form.star" active-color="primary" />
            <hr>
            <h4 class="my-4">Write Your FeedBack</h4>
            <v-row>
                <v-col cols="6">
                    <v-textarea autofocus rows="2" v-model="form.message" variant="outlined" label="Feedback"
                        hide-details class="mb-3"></v-textarea>
                </v-col>
            </v-row>
            <button @click.prevent="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Navbar from './Components/Navbar.vue';
import { post } from '../Composables/httpMethod.js';
const form = useForm({
    message : '',
    star : 0
})

const submit = () => {
    post(form,route('feedback'));
    form.message = '';
    form.star = 0;
}
</script>
<style scoped></style>
