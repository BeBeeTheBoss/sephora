<template>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <img src="../../../images/sephoralogo.jpg"
                style="width: 200px;height:50px;" />
             
                <ul class="navbar-nav ms-auto me-12">
                    <ProfileImage :profile="profile" />
                </ul>
            </div>
        </nav>
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
    z-index: 50;
    position: sticky;
    top: 0;
    background-color: white; 
}


</style>
