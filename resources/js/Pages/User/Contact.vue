<template>
    <Navbar />
    <div class="body">
        <div class="row two-column-container mb-5">
            <div class="col-md-8 form-image">
                <img src="../../images/message.webp" alt="update Image">
            </div>
            <section class="col-md-4 contact" style="background-color:#f7e1f3;">
                <div class="border-1 border-black mx-5 p-2" style="border-radius: 5px;background-color: white;">
                    <h4 class="text-center pt-3">Contact Us</h4>
                    <form action="" method="post" class="contact-form px-3">
                        <div class="mb-3">
                            <input type="text" v-model="form.name" name="name" placeholder="Enter your name" required maxlength="20"
                                class="box">
                        </div>
                        <div class="mb-3">
                            <input type="email" v-model="form.email" name="email" placeholder="Enter your email" required maxlength="50"
                                class="box">
                        </div>
                        <div class="mb-3">
                            <input type="number" v-model="form.phone" name="phone" min="0" max="9999999999" placeholder="Enter your number"
                                required onkeypress="if(this.value.length == 11) return false;" class="box">
                        </div>
                        <div class="mb-3">
                            <textarea name="msg" v-model="form.message" class="box" placeholder="Enter your message" cols="20"
                                rows="5"></textarea>
                        </div>
                        <input @click.prevent="submit" type="submit" value="Send Message" name="send" class="btn w-100">
                    </form>
                </div>
            </section>
        </div>
        <Footer />
    </div>
</template>

<script setup>
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';
import { onMounted,onUpdated } from 'vue';
import { route } from "ziggy-js";
import { useForm } from '@inertiajs/vue3';
import { post } from '../Composables/httpMethod';
import { useToast } from "vue-toastification";
import { usePage } from '@inertiajs/vue3'


const toast = useToast();
const page = usePage();

const form = useForm({
    name : '',
    email : '',
    phone : '',
    message : ''
})

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



const submit = () => {
    post(form,route('contact.store'));
    form.name = '',
    form.email = '',
    form.phone = '',
    form.message = ''
}


</script>

<style scoped>
.box{
    width:100%;
    padding:10px 5px;
    border-radius: 5px;
}
.body {
    font-family: "Arial", sans-serif;
    color: #333;
    line-height: 1.6;
}

.box{
    background: #c9c7c8;
}

.contact {
    padding: 50px 0;
    text-align: center;
}

.contact h3 {
    font-size: 36px;
    color: #e91e63;
    margin-bottom: 30px;
}

.contact p {
    font-size: 20px;
    margin: 20px 0;
}

.contact .btn {
    padding: 12px 25px;
    background-color: #e91e63;
    color: #fff;
    text-decoration: none;
    border-radius: 30px;
    font-size: 20px;
    transition: background-color 0.3s ease;
    cursor: pointer;
    border: none;
}

.contact .btn:hover {
    background-color: #c2185b;
}


/* Image */
.form-image {
    flex: 0.9;
    /* Use flex to make the image and form share the same height */
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
    /* Set a white background */
}

.form-image img {
    max-width: 100%;
    /* Ensure the image fits within its container */
    max-height: 100%;
    /* Make the image the same height as the form */
}
</style>