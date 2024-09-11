<template>
  <Layout>
    <div class="d-flex justify-content-between mt-4 ps-3">
      <div class="col-8">
        <img
          class="w-100 rounded shadow"
          style="object-fit: cover; object-position: top"
          src="https://static.vecteezy.com/system/resources/previews/002/006/775/non_2x/paper-art-shopping-online-on-smartphone-and-new-buy-sale-promotion-backgroud-for-banner-market-ecommerce-free-vector.jpg"
          alt=""
        />
      </div>
      <div class="col-4">
        <div class="row">
          <div class="col-6 py-1">
            <Category />
          </div>
        </div>
        <!-- <div class="d-flex ps-2">
          <div class="col-6 py-1">
            <Category />
          </div>
        </div> -->
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from "./Layouts/Layout.vue";
import Category from "./Components/Category.vue";
</script>

<style></style>
