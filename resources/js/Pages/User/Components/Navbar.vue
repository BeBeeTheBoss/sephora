<template>
    <nav class="position-sticky top-0 border pb-3" style="z-index:2;background-color:white">
        <div class="d-flex justify-content-between align-items-center pt-3">
            <div class="logo col-2 ps-4 flex align-items-center d-lg-flex d-md-flex d-sm-none d-none">
                <img src="https://iconape.com/wp-content/png_logo_vector/shopping-and-ecommerce-28.png"
                    style="width: 40px" />
                <div style="color: #fe919d">Sep</div>
                hora
            </div>
            <div class="logo col-2 ps-4 flex align-items-center d-lg-none d-md-none d-sm-flex d-flex"
                style="font-size:20px">
                <img src="https://iconape.com/wp-content/png_logo_vector/shopping-and-ecommerce-28.png"
                    style="width: 30px" />
                <div style="color: #fe919d">Sep</div>
                hora
            </div>
            <div class="search col-lg-8 col-md-6 d-lg-block d-md-block d-sm-none d-none">
                <input type="search" name="" id="" placeholder="Explore products you want ..." />
            </div>
            <div class="col-2 d-flex justify-content-end pe-0 d-lg-flex d-md-flex d-sm-none d-none">
                <IconBtn icon="fa-regular fa-heart" count="9" />
                <IconBtn icon="fa-solid fa-cart-shopping" count="12" />
                <IconBtn icon="fa-regular fa-user" />
            </div>
            <div class="col-2 d-flex justify-content-end pe-0 d-lg-none d-md-none d-sm-flex d-flex">
                <IconBtn icon="fa-solid fa-bars" />
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
