<template>
    <div class="mx-2">
        <img class="rounded-circle shadow-sm" style="width:70px;height:70px;object-fit:cover;object-position:center"
            :src="image" alt="">
        <div class="text-center mt-1 fw-bold" style="font-size:13px">{{ name }}</div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
    image: String,
    name: String
})

</script>

<style></style>
