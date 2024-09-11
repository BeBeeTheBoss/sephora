<template>
  <button class="btn border-0" style="position: relative">
    <font-awesome-icon :icon="icon" class="fs-5" />
    <span class="badge rounded-pill" style="position: absolute; top: -3px; right: 0px">{{
      count
    }}</span>
  </button>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
  icon: String,
  count: Number,
});
</script>

<style scoped>
.badge {
  font-size: 10px;
  background-color: #fe919d;
}
</style>
