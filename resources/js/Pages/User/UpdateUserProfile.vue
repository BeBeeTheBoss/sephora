<template>
    <Navbar />
    <div class="body">
        <div class="two-column-container">
            <div class="form-image">
                <img src="../../images/update.jpg" alt="update Image">
            </div>
            <section class="form-container">

                <div class="col-md-8 mx-auto bg-white shadow-md rounded-lg border border-success my-2">
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
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password" v-model="form.password"
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
                                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update
                                Profile</button>
                        </div>
                    </form>
                </div>

            </section>
        </div>
    </div>
    <Footer />
</template>

<script setup>
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';
import { ref } from 'vue';
 import { useForm } from '@inertiajs/vue3';
import { update } from '../Composables/httpMethod.js'
import { useToast } from 'vue-toastification';

const props = defineProps({
    user: Object
})

const confirmPassword = ref('')
const showPassword = ref(false);
const showConfirmPassword = ref(false);
const toast = useToast()

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
    password : ''
})

const updateProfile = () => {
    if(form.email === ''){
        toast.warning('The email field is required');
    }

    if(!form.email.includes('@gmail.com')){
        toast.warning('Invalid email');
        return;
    }

    if (form.password !== confirmPassword.value) {
        toast.warning("Password and Confirm Password do not match.");
    } else {
        update(form, route("profile.update", props.user.id));

        form.password = '';
        confirmPassword.value = '';
    }
};



</script>

<style scoped>
.body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    background-color: #f8e5f3;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Stylish user header */
.user-header {
    background-color: #f8a5c2;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 10px;
    margin-bottom: 20px;
}

.user-header h1 {
    color: #e91e63;
    font-size: 28px;
    margin: 0;
    padding: 0;
}

.user-header a {
    color: #333;
    text-decoration: none;
    font-size: 18px;
}

/* Revamped form */

.form-container h3 {
    color: #e91e63;
    font-size: 24px;
    margin-bottom: 30px;
    text-align: center;
}

.form-container .box {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    color: #333;
}

.form-container .box:focus {
    outline: none;
    border-color: #e91e63;
}

.form-container .btn {
    display: block;
    width: 100%;
    background-color: #e91e63;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-container .btn:hover {
    background-color: #c2185b;
}

.form-container .message {
    color: #e91e63;
    text-align: center;
    margin-top: 20px;
}

/* Dropdown Styling */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    /* Increase border radius for a softer look */
    padding: 15px;
    /* Increase padding for a more spacious feel */
    z-index: 1;
    display: none;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-item {
    display: block;
    padding: 8px 15px;
    /* Adjust padding for better spacing */
    font-size: 18px;
    /* Increase font size for a more elegant look */
    color: #e91e63;
    /* Use a girly color for the text */
    transition: background-color 0.3s ease;
    text-decoration: none;
    /* Remove underline from the links */
}

.dropdown-item:hover {
    background-color: #fce4ec;
    /* Add a subtle hover background color */
    border-radius: 10px;
    /* Adjust border radius for a softer hover effect */
}

/* Additional Decorative Elements */
.dropdown-menu::before {
    content: "";
    position: absolute;
    top: -10px;
    left: 20px;
    border: 10px solid transparent;
}

.dropdown-menu::after {
    content: "";
    position: absolute;
    top: -8px;
    left: 20px;
    border: 9px solid transparent;
}

/* Apply the dropdown styles to the "Shop" dropdown */
.dropdown-menu {
    width: 250px;
    /* Adjust the width of the dropdown */
}

.dropdown-item {
    color: #e91e63;
    /* Girly color for dropdown items */
}

.dropdown-item:hover {
    background-color: #fce4ec;
    /* Add a subtle hover background color */
}

/* Two-Column Layout */
.two-column-container {
    display: flex;
    justify-content: space-between;
}

.two-column-container .form-container {
    flex: 1;
    margin-left: 20px;
    /* Adjust the margin as needed to separate the columns */
}

/* Image */
.form-image {
    flex: 1;
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

/* Container styling */
.show-password-container {
    display: flex;
    align-items: center;
    margin-top: 10px;
    font-size: 16px;
    color: #333;
    /* Text color */
}

/* Checkbox styling */
.show-password-container input[type="checkbox"] {
    margin-right: 5px;
}

/* Label styling */
.show-password-container label {
    cursor: pointer;
}

/* Label styling when the checkbox is checked */
.show-password-container input[type="checkbox"]:checked+label {
    font-weight: bold;
    color: #e91e63;
    /* Color when checked */
}
</style>