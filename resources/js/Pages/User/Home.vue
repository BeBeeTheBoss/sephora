<template>
    <Layout>
        <div class="row w-100 d-flex justify-content-center mt-lg-4 mt-md-4 mt-sm-3 mt-3">
            <div class="col-lg-8 col-md-10 col-sm-12 col-12">
                <Carousel class="d-lg-block d-md-block d-sm-none d-none ps-3" height="450px" />
                <Carousel class="d-lg-none d-md-none d-sm-block d-block" height="200px" style="margin-left: 15px" />
            </div>
            <div class="col-lg-4 col-md-10 col-sm-12 col-12 mt-lg-0 mt-md-3 mt-sm-3 mt-3">
                <div
                    class="row w-100 px-lg-4 px-md-2 px-sm-0 px-0 ps-lg-0 ps-md-0 ps-sm-3 ps-5 d-lg-flex d-md-flex d-sm-none d-none">
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <ListHeader name="Popular" icon="fa-solid fa-arrow-up-right-dots" />
                    </div>
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <ListHeader name="Trending" icon="fa-solid fa-fire" />
                    </div>
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <ListHeader name="Best sellers" icon="fa-solid fa-basket-shopping" />
                    </div>
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <ListHeader name="New arrivals" icon="fa-solid fa-box-open" />
                    </div>
                    <div class="col-lg-6 col-md-4 col-md-3 col-6 h-100" style="cursor:pointer">
                        <ListHeader name="Explore" icon="fa-solid fa-magnifying-glass" />
                    </div>
                </div>
                <div class="row w-100 d-lg-block d-md-block d-sm-none d-none">
                    <h5 class="fw-bold mb-2">Recommended for you</h5>
                    <div class="row w-100">
                        <div class="col-6" style="position: relative; cursor: pointer">
                            <img src="https://www.jarsking.com/wp-content/uploads/2023/05/HDPE-Cosmetic-Packaging-01.jpg"
                                class="w-100 rounded" style="
                  height: 100%;
                  object-fit: cover;
                  object-position: center;
                  opacity: 0.6;
                " />
                            <span class="fw-bold" style="
                  position: absolute;
                  top: 50%;
                  left: 50%;
                  transform: translate(-50%, -50%);
                ">All-in-one set <font-awesome-icon icon="fa-solid fa-chevron-right" /></span>
                        </div>
                        <div class="col-6" style="position: relative; cursor: pointer">
                            <img src="https://www.hcpackaging.com/app/uploads/2022/04/1004x708_Lotus-Skincare-Collection.jpg"
                                class="w-100 rounded" style="
                  height: 100%;
                  object-fit: cover;
                  object-position: center;
                  opacity: 0.6;
                " />
                            <span class="fw-bold" style="
                  position: absolute;
                  top: 50%;
                  left: 50%;
                  transform: translate(-50%, -50%);
                ">Skincare set <font-awesome-icon icon="fa-solid fa-chevron-right" /></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center px-lg-5 px-md-3 px-sm-2 px-2 mb-3">
            <h5 class="mt-lg-5 mt-md-4 mt-sm-2 mt-2 fw-bold">Categories</h5>
            <div class="text-muted">See all</div>
        </div>
        <div class="row w-100 px-5 d-lg-flex d-md-flex d-sm-none d-none">
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <Category name="Make-up" count="12"
                    image="https://cdn.britannica.com/35/222035-131-9FC95B31/makeup-cosmetics.jpg" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <Category name="Lips-stick" count="24"
                    image="https://images.beautybay.com/eoaaqxyywn6o/REBE1339F_1.jpg_s3.lmb_w21vua/6662e9208386291e7fc58e4c77fa5970/REBE1339F_1.jpg" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <Category name="Mockup" count="6"
                    image="https://www.freemockupworld.com/wp-content/uploads/2021/06/White-Cosmetics-Bottle-Mockup-01.jpg" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <Category name="Skincare" count="34"
                    image="https://pixpine.com/wp-content/uploads/2024/05/free-cosmetic-packaging-mockup-1.jpg" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <Category name="Perfume" count="9"
                    image="https://www.reneecosmetics.in/cdn/shop/files/renee-eau-de-parfum-bloom-renee-cosmetics-1.jpg?v=1716270797" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                <Category name="Highlighter" count="56"
                    image="https://co.nice-cdn.com/upload/image/product/large/default/nui-cosmetics-natural-illusion-cream-piari-593932-en.webp" />
            </div>
        </div>
        <div class="d-lg-none d-md-none d-sm-flex d-flex pb-3" style="overflow-x: scroll">
            <CategoryCircle width="100px" image="https://cdn.britannica.com/35/222035-131-9FC95B31/makeup-cosmetics.jpg"
                name="Make-up" />
            <CategoryCircle width="100px" name="Lips-stick"
                image="https://images.beautybay.com/eoaaqxyywn6o/REBE1339F_1.jpg_s3.lmb_w21vua/6662e9208386291e7fc58e4c77fa5970/REBE1339F_1.jpg" />
            <CategoryCircle width="100px" name="Mockup" count="6"
                image="https://www.freemockupworld.com/wp-content/uploads/2021/06/White-Cosmetics-Bottle-Mockup-01.jpg" />
            <CategoryCircle width="100px" name="Skincare" count="34"
                image="https://pixpine.com/wp-content/uploads/2024/05/free-cosmetic-packaging-mockup-1.jpg" />
            <CategoryCircle width="100px" name="Perfume" count="9"
                image="https://www.reneecosmetics.in/cdn/shop/files/renee-eau-de-parfum-bloom-renee-cosmetics-1.jpg?v=1716270797" />
            <CategoryCircle width="100px" name="Highlighter" count="56"
                image="https://co.nice-cdn.com/upload/image/product/large/default/nui-cosmetics-natural-illusion-cream-piari-593932-en.webp" />
        </div>
        <div class="d-lg-flex d-md-flex d-sm-none d-none justify-content-between align-items-center px-lg-5 px-md-3 px-sm-2 px-2 mb-3"
            style="margin-top:-10px">
            <h5 class="mt-lg-5 mt-md-4 mt-sm-2 mt-2 fw-bold">Products</h5>
            <div class="text-muted">See all</div>
        </div>
        <div class="row w-100 px-5 mb-5 d-lg-flex d-md-flex d-sm-none d-none">
            <div class="col-lg-3 col-md-4 mb-3">
                <Product />
            </div>
            <div class="col-lg-3 col-md-4 mb-3">
                <Product />
            </div>
            <div class="col-lg-3 col-md-4 mb-3">
                <Product />
            </div>
            <div class="col-lg-3 col-md-4 mb-3">
                <Product />
            </div>
            <div class="col-lg-3 col-md-4 mb-3">
                <Product />
            </div>
            <div class="col-lg-3 col-md-4 mb-3">
                <Product />
            </div>
            <div class="col-lg-3 col-md-4 mb-3">
                <Product />
            </div>
        </div>
        <div class="d-lg-none d-md-none d-sm-flex d-flex justify-content-between align-items-center px-lg-5 px-md-3 px-sm-2 px-2 mt-2 mb-3"
            style="margin-top:-10px">
            <h5 class="mt-lg-5 mt-md-4 mt-sm-2 mt-2 fw-bold">Trending</h5>
            <div class="text-muted">See all</div>
        </div>
        <div class="d-lg-none d-md-none d-sm-flex d-flex ps-3 pb-3 mb-5" style="overflow-x: scroll;">
            <div class="me-3">
                <Product size="phone" />
            </div>
            <div class="me-3">
                <Product size="phone" />
            </div>
            <div class="me-3">
                <Product size="phone" />
            </div>
            <div class="me-3">
                <Product size="phone" />
            </div>
            <div class="me-3">
                <Product size="phone" />
            </div>
        </div>
    </Layout>
</template>

<script setup>
import ListHeader from "./Components/ListHeader.vue";
import Layout from "./Layouts/Layout.vue";
import Carousel from "./Components/Carousel.vue";
import Category from "./Components/Category.vue";
import CategoryCircle from "./Components/CategoryCircle.vue";
import Product from "./Components/Product.vue";
</script>

<style scoped>
--webkit-scrollbar {
    display: none;
}
</style>
