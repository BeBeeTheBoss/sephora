<template>
    <Layout>
        <!-- Profile Header -->
            <div class="flex justify-center mt-5">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQG7WjONaOfilXR3bebrfe_zcjl58ZdAzJHYw&s"
                    alt="Profile Picture" class="w-32 rounded-full" style="border:2px solid green;">
            </div>


        <!-- Profile Edit Form -->
        <div class="col-md-4 mx-auto bg-white shadow-md rounded-lg border border-success my-2">
            <form class="p-6 space-y-6">
                <h3 class="text-2xl font-semibold">Edit Profile</h3>

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" v-model="form.name"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" v-model="form.email"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                </div>


                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input :type="showPassword ? 'text' : 'password'"  id="password" name="password" v-model="form.password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <input type="checkbox" v-model="showPassword" id="showPassword">
                        <label for="showPassword">Show Password</label>
                </div>

                <!-- Update Password Field -->
                <div>
                    <label for="update-password" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input :type="showConfirmPassword ? 'text' : 'password'" id="update-password" name="update-password" v-model="confirmPassword"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <input type="checkbox" v-model="showConfirmPassword" id="showPassword">
                        <label for="showConfirmPassword">Show Password</label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button @click="updateProfile" type="button"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </Layout>
</template>

<script setup>
import { ref,onMounted,onUpdated } from 'vue';
 import { useForm,usePage } from '@inertiajs/vue3';
import Layout from './Layouts/Layout.vue'
import { useToast } from 'vue-toastification';

const props = defineProps({
    admin: Object
})
const page = usePage();
const confirmPassword = ref('')
const showPassword = ref(false);
const showConfirmPassword = ref(false);
const toast = useToast()

const form = useForm({
    name: props.admin.name,
    email: props.admin.email,
    password : ''
})

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



const updateProfile = () => {
    if(form.name == '' || form.email == '' || form.password == '' || confirmPassword.value == ''){
        toast.warning('All fields are required');
        return;
    }

    if(!form.email.includes('@gmail.com')){
        toast.warning('Invalid email');
        return;
    }

    if (page.props.flash && page.props.flash.failed) {
        toast.error(page.props.flash.failed);
        return;
    }


    if (form.password !== confirmPassword.value) {
        toast.warning("Password and Confirm Password do not match.");
    } else {
        form.post(route("updateProfile", props.admin.id));
    }
};

</script>

<style lang="scss" scoped></style>
