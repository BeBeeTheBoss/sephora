<template>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="col-10 d-flex justify-content-center align-items-center">
            <form class="form">
                <p class="title">Register to Sephora</p>
                <p class="message">Signup now and start shopping. </p>
                <label>
                    <input v-model="form.name" class="input" type="text" placeholder="" required="">
                    <span>Username</span>
                </label>

                <!-- <label>
                        <input class="input" type="text" placeholder="" required="">
                        <span>Lastname</span>
                    </label> -->

                <label>
                    <input v-model="form.email" class="input" type="email" placeholder="" required="">
                    <span>Email</span>
                </label>

                <label>
                    <input :type="showPassword ? 'text' : 'password'" v-model="form.password" class="input" placeholder="" required="">
                    <span>Password</span>
                    <input type="checkbox" v-model="showPassword" id="showPassword">
                </label>
                <label>
                    <input :type="showConfirmPassword ? 'text' : 'password'" v-model="form.confirm_password" class="input" placeholder="" required="">
                    <span>Confirm password</span>
                    <input type="checkbox" v-model="showConfirmPassword" id="showPassword">
                </label>
                <button type="button" @click="submit" class="submit">Submit</button>
                <p class="signin">Already have an acount ?
                    <Link :href="route('loginPage')" style="color:white">Login</Link>
                </p>
            </form>
        </div>

    </div>

</template>

<script setup>
import { Link, useForm,usePage } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";
import {route} from 'ziggy-js';
import {ref,onMounted,onUpdated} from 'vue'

const form = useForm({
    name: '',
    email: '',
    password: '',
    confirm_password: '',
});

const toast = useToast();
const page = usePage();
const showPassword = ref(false);
const showConfirmPassword = ref(false);

onMounted(() => {

if (page.props.flash) {
    if (page.props.flash.success) {
        toast.success(page.props.flash.success);
        page.props.flash.success = '';
    } else if (page.props.flash.failed) {
        toast.error(page.props.flash.failed);
        page.props.flash.failed = '';
    }
}
})

onUpdated(() => {

if (page.props.flash) {
    if (page.props.flash.success) {
        toast.success(page.props.flash.success);
        page.props.flash.success = '';
    } else if (page.props.flash.failed) {
        toast.error(page.props.flash.failed);
        page.props.flash.failed = '';
    }
}

})


const submit = () => {
    if(form.name == '' || form.email == '' || form.password == '' || form.confirm_password == ''){
        toast.warning('All fields are required');
        return;
    }

    if(!form.email.includes('@gmail.com')){
        toast.warning('Invalid email');
        return;
    }

    if(form.password != form.confirm_password){
        toast.warning('Passwords do not match');
        return;
    }

    form.post(route('signUp'));

}

</script>

<style scoped>
/* From Uiverse.io by ammarsaa */

.form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 450px;
    padding: 30px 60px;
    border-radius: 20px;
    position: relative;
    color: #fff;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

.title {
    font-size: 28px;
    font-weight: 600;
    letter-spacing: -1px;
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 30px;
    color: #FE919D;
}

.title::before {
    width: 18px;
    height: 18px;
}

.title::after {
    width: 18px;
    height: 18px;
    animation: pulse 1s linear infinite;
}

.title::before,
.title::after {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    border-radius: 50%;
    left: 0px;
    background-color: #FE919D;
}

.message,
.signin {
    font-size: 14.5px;
    color: #FE919D;
}

.signin {
    text-align: center;
}

.signin a:hover {
    text-decoration: underline #FE919D;
}

.signin a {
    color: #FE919D !important;
}

.flex {
    display: flex;
    width: 100%;
    gap: 6px;
}

.form label {
    position: relative;
}

.form label .input {
    /* background-color: #111827; */
    color: #FE919D;
    width: 100%;
    padding: 20px 05px 05px 10px;
    outline: 0;
    border: 1px solid #FE919D;
    border-radius: 10px;
}

.form label .input+span {
    color: #FE919D;
    position: absolute;
    left: 10px;
    top: 0px;
    font-size: 0.9em;
    cursor: text;
    transition: 0.3s ease;
}

.form label .input:placeholder-shown+span {
    top: 12.5px;
    font-size: 0.9em;
}

.form label .input:focus+span,
.form label .input:valid+span {
    color: #ff6879;
    top: 0px;
    font-size: 0.7em;
    font-weight: 600;
}

.input {
    font-size: medium;
}

.submit {
    border: none;
    outline: none;
    padding: 10px;
    border-radius: 10px;
    color: #fff;
    font-size: 16px;
    transform: .3s ease;
    background-color: #FE919D;
}

.submit:hover {
    background-color: #ff6879;
}

@keyframes pulse {
    from {
        transform: scale(0.9);
        opacity: 1;
    }

    to {
        transform: scale(1.8);
        opacity: 0;
    }
}
</style>
