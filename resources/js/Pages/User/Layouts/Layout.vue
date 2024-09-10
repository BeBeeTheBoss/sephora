<template>
  <v-container class="poppins-medium">
    <Navbar />
    <slot />
    <Footer />
  </v-container>
</template>

<script setup>
import Navbar from "../Components/Navbar.vue";
import Footer from "../Components/Footer.vue";
</script>

<style></style>
