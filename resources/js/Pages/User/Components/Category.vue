<template>
  <div class="rounded-3 border shadow d-flex row align-items-center mx-1" style="cursor: pointer;">
    <div class="col-4" style="margin-left: -12px">
      <img
        :src="image"
        class="w-100"
        style="height: 80px; object-fit: cover; object-position: center"
      />
    </div>
    <div class="col-8">
      <div class="d-flex justify-content-between align-items-center">
        <div class="text-uppercase fw-bold">
          {{ name }}
        </div>
        <div class="text-muted" style="font-size: 12px">
          {{ count }}
        </div>
      </div>
      <div class="pt-1" style="color: #fe919d;font-size:15px">Show all <font-awesome-icon icon="fa-regular fa-eye" style="font-size: 15px"/></div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
  image: String,
  name: String,
  count: Number,
});
</script>

<style scoped></style>
