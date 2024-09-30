<template>
    <div class="poppins-medium">
        <Navbar />
        <slot />
        <BottomNavbar class="d-lg-none d-md-none d-sm-flex d-flex" />
        <Footer />
    </div>
</template>

<script setup>
import Navbar from "../Components/Navbar.vue";
import BottomNavbar from "../Components/BottomNavbar.vue";
import Footer from "../Components/Footer.vue";
import SpeedDial from "../Components/SpeedDial.vue"
</script>

<style></style>
