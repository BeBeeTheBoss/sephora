<template>
  <nav>
    <div class="d-flex justify-content-between align-items-center pt-3">
      <div class="logo col-2 ps-4">Sephora</div>
      <div class="search col-8">
        <input type="search" name="" id="" placeholder="Explore products you want ..." />
      </div>
      <div class="col-2 d-flex justify-content-center">
        <IconBtn icon="fa-regular fa-heart" count="9" />
        <IconBtn icon="fa-solid fa-cart-shopping" count="12" />
        <IconBtn icon="fa-regular fa-user" />
      </div>
    </div>
  </nav>
</template>

<script setup>
import IconBtn from "./IconBtn.vue";
</script>

<style scoped>
.logo {
  font-size: 30px;
  font-weight: 600;
}
.search input {
  width: 100%;
  height: 40px;
  border: none;
  outline: none;
  padding: 0px 20px;
  background-color: #f2f0f0c8;
  border-radius: 20px;
}
</style>
