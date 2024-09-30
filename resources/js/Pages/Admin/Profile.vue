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
                    <input type="password" id="password" name="password" v-model="form.password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Update Password Field -->
                <div>
                    <label for="update-password" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input type="password" id="update-password" name="update-password" v-model="confirmPassword"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
import { ref } from 'vue';
 import { useForm } from '@inertiajs/vue3';
import Layout from './Layouts/Layout.vue'
import { update } from '../Composables/httpMethod.js'
import { useToast } from 'vue-toastification';

const props = defineProps({
    admin: Object
})

const confirmPassword = ref('')
const toast = useToast()

const form = useForm({
    name: props.admin.name,
    email: props.admin.email,
    password : ''
})

const updateProfile = () => {
    if(form.email === ''){
        toast.warning('The email field is required');
    }

    if (form.password !== confirmPassword.value) {
        toast.warning("Password and Confirm Password do not match.");
    } else {
        update(form, route("updateProfile", props.admin.id));
    }
};

</script>

<style lang="scss" scoped></style>
