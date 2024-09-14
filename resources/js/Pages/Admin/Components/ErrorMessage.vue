<template>
    <div v-if="text" class="text-danger">{{ text }}</div>
</template>

<script setup>
defineProps({
    text : String
})
</script>

<style lang="scss" scoped>

</style>
