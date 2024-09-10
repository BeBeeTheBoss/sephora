<template>
  <nav>
    <div class="logo">Sephora</div>
    <div class="search">
      <input type="search" name="" id="" placeholder="Explore products you want ..." />
    </div>
    <div>
      <IconBtn />
    </div>
  </nav>
</template>

<script setup>
import IconBtn from "./IconBtn.vue";
</script>

<style scoped>
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 15px 20px;
}
.logo {
  font-size: 30px;
  font-weight: 600;
}
.search input {
  width: 800px;
  height: 40px;
  border: none;
  outline: none;
  padding: 0px 20px;
  background-color: #f2f0f0c8;
  border-radius: 20px;
}
</style>
