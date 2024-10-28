<template>
    <div>
        <button @click="goBack" class="btn" style="background-color:#fe919d;color:white"><font-awesome-icon icon="fa-solid fa-backward" /> Back</button>
    </div>
</template>

<script setup>
const goBack = () => {
    window.history.back();
}
</script>

<style lang="scss" scoped>

</style>
