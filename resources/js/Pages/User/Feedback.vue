<template>
    <Navbar />
    <h3 class="text-center my-4">FeedBacks</h3>
    <div class="container row py-3">
        <div class="col-md-7 form-image">
            <img src="../../images/message.webp" alt="update Image">
        </div>
        <div class="col-md-5 p-5">
            <h3>Do you Like Website?</h3>
            <v-rating hover :length="5" :size="32" v-model="form.star" active-color="primary" />
            <hr>
            <h4 class="my-4">Write Your FeedBack</h4>
            <v-row>
                <v-col cols="12">
                    <v-textarea autofocus rows="2" v-model="form.message" variant="outlined" label="Feedback"
                        hide-details class="mb-3"></v-textarea>
                </v-col>
            </v-row>
            <button @click.prevent="submit" class="btn btn-primary w-100">Submit</button>
        </div>
    </div>
    <Footer />
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';
import { post } from '../Composables/httpMethod.js';
import { onMounted,onUpdated } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";


const toast = useToast();
const page = usePage();

onMounted(() => {

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

const form = useForm({
    message: '',
    star: 0
})

const submit = () => {
    post(form, route('feedback'));
    form.message = '';
    form.star = 0;
}
</script>
<style scoped></style>
