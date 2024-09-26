<template>
    <Layout>
        <!-- Profile Header -->
            <div class="flex justify-center mt-5">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQG7WjONaOfilXR3bebrfe_zcjl58ZdAzJHYw&s"
                    alt="Profile Picture" class="w-32 rounded-full" style="border:2px solid green;">
            </div>


        <!-- Profile Edit Form -->
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg">
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

                <!-- Phone Field -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="tel" id="phone" name="phone" v-model="form.phone"
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
                    <input type="password" id="update-password" name="update-password" placeholder="••••••••"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Submit Button -->
                <div>
                    <button @click="update" type="submit"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </Layout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from './Layouts/Layout.vue'
const props = defineProps({
    admin: Object
})


const form = useForm({
    name: props.admin.name,
    email: props.admin.email,
    phone: props.admin.phone,
    password: props.admin.password
})

const update = () => {
    alert('hi');
}
</script>

<style lang="scss" scoped></style>
