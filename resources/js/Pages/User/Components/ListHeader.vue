<template>
    <div class="p-4 mb-4 rounded-2 border shadow-sm fw-bold" style="background-color: #f5f3f3">
        <font-awesome-icon :icon="icon" class="me-2" style="color: #fe919d" />
        {{ name }}
    </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
  name: String,
  icon :String
});

</script>

<style></style>
