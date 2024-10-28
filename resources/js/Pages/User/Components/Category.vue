<template>
    <div class="rounded-3 border shadow-sm d-flex row align-items-center mx-1"
        style="cursor: pointer;position:relative">
        <div class="col-4" style="margin-left: -12px">
            <img :src="image" class="w-100" style="height: 80px; object-fit: cover; object-position: center" />
        </div>
        <div class="col-8">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-uppercase fw-bold">
                    {{ name }}
                </div>
            
            </div>
            <span style="position:absolute;right:10px" v-if="is_active">
                <FontAwesomeIcon icon=" fa-solid fa-circle-check" style="color:#fe919d"></FontAwesomeIcon>
            </span>

        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

const props = defineProps({
    image: String,
    name: String,
    // count: Number,
    is_active: Boolean
});
</script>

<style scoped></style>
