<template>
    <div class="" style="position:sticky;z-index:10;top:0;">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid z-10">
                <img src="https://iconape.com/wp-content/png_logo_vector/shopping-and-ecommerce-28.png"
                    style="width: 40px" />
                <a class="navbar-brand" href="#">
                    <div class="logo col-2 flex align-items-center" style="font-size:25px">
                        <div class="font-bold" style="color: #ff006e">Sep</div>
                        <span class=" font-bold">hora</span>
                    </div>
                </a>
                <div class="ms-32 d-flex">
                    <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="mt-2" />
                    <input type="text" placeholder="Search" class="form-control ms-2">
                </div>
                <ul class="navbar-nav ms-auto me-12">
                    <ProfileImage :profile="profile" />
                </ul>
            </div>
        </nav>
    </div>
</template>

<script setup>
import {ref,onMounted} from "vue"
import ProfileImage from './ProfileImage.vue';
import axios from 'axios';
const profile = ref(null)
onMounted(() => {
    axios.get('/profile').then(response => {
        profile.value = response.data
    })
});
</script>

<style scoped>
.navbar {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
