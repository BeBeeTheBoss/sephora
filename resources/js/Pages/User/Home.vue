<template>
  <Layout>
    <div class="d-flex ps-5 mt-5">
      <div class="col-8">
        <Carousel />
      </div>
      <div class="col-4">
        <div class="row w-100 px-4">
            <div class="col-6">
                <ListHeader name="Popular" icon="fa-solid fa-arrow-up-right-dots"/>
            </div>
            <div class="col-6">
                <ListHeader name="Trending" icon="fa-solid fa-fire"/>
            </div>
            <div class="col-6">
                <ListHeader name="Best sellers" icon="fa-solid fa-basket-shopping"/>
            </div>
            <div class="col-6">
                <ListHeader name="New arrivals" icon="fa-solid fa-box-open"/>
            </div>
            <div class="col-6">
                <ListHeader name="Explore" icon="fa-solid fa-magnifying-glass"/>
            </div>
        </div>
        <div class="row w-100 px-4">
            <h5 class="fw-bold mb-2">Recommended for you</h5>
            <div class="row w-100">
                <div class="col-6" style="position:relative;cursor:pointer">
                    <img src="https://www.jarsking.com/wp-content/uploads/2023/05/HDPE-Cosmetic-Packaging-01.jpg" class="w-100 rounded" style="height: 125px; object-fit: cover; object-position: center;opacity:0.6">
                    <span class="fw-bold" style="position:absolute;top:50%;left:50%;transform: translate(-50%, -50%)">All-in-one set <font-awesome-icon icon="fa-solid fa-chevron-right" /></span>
                </div>
                <div class="col-6" style="position:relative;cursor:pointer">
                    <img src="https://www.hcpackaging.com/app/uploads/2022/04/1004x708_Lotus-Skincare-Collection.jpg" class="w-100 rounded" style="height: 125px; object-fit: cover; object-position: center;opacity:0.6">
                    <span class="fw-bold" style="position:absolute;top:50%;left:50%;transform: translate(-50%, -50%)">Skincare set <font-awesome-icon icon="fa-solid fa-chevron-right" /></span>
                </div>
            </div>
        </div>
      </div>
    </div>
    <h5 class=" mt-5 fw-bold px-5 mb-3">Categories</h5>
    <div class="row w-100 px-5">
        <div class="col-2">
            <Category name="Make-up" count="12" image="https://cdn.britannica.com/35/222035-131-9FC95B31/makeup-cosmetics.jpg"/>
        </div>
        <div class="col-2">
            <Category name="Lips-stick" count="24" image="https://images.beautybay.com/eoaaqxyywn6o/REBE1339F_1.jpg_s3.lmb_w21vua/6662e9208386291e7fc58e4c77fa5970/REBE1339F_1.jpg"/>
        </div>
        <div class="col-2">
            <Category name="Mockup" count="6" image="https://www.freemockupworld.com/wp-content/uploads/2021/06/White-Cosmetics-Bottle-Mockup-01.jpg"/>
        </div>
        <div class="col-2">
            <Category name="Skincare" count="34" image="https://pixpine.com/wp-content/uploads/2024/05/free-cosmetic-packaging-mockup-1.jpg"/>
        </div>
        <div class="col-2">
            <Category name="Perfume" count="9" image="https://www.reneecosmetics.in/cdn/shop/files/renee-eau-de-parfum-bloom-renee-cosmetics-1.jpg?v=1716270797"/>
        </div>
        <div class="col-2">
            <Category name="Highlighter" count="56" image="https://co.nice-cdn.com/upload/image/product/large/default/nui-cosmetics-natural-illusion-cream-piari-593932-en.webp"/>
        </div>
    </div>
  </Layout>
</template>

<script setup>
import ListHeader from "./Components/ListHeader.vue";
import Layout from "./Layouts/Layout.vue";
import Carousel from "./Components/Carousel.vue";
import Category from "./Components/Category.vue";
</script>

<style></style>
