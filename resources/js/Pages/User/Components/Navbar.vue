<template>
    <nav class="position-sticky top-0 border pb-3" style="z-index:2;background-color:white">
        <div class="d-flex justify-content-between align-items-center pt-3">
            <div class="logo col-2 ps-4 flex align-items-center d-lg-flex d-md-flex d-sm-none d-none"
                style="font-size:25px">
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
            <div class="col-5 d-flex justify-content-end pe-0 d-lg-flex d-md-flex d-sm-none d-none"
                style="position:absolute;left:50%;transform:translate(-76%,0)">
                <div class="me-3 d-flex align-items-center navIcon navIconActive" style="cursor:pointer">
                    <IconBtn icon="fa-solid fa-home" />
                    <!-- <span>Orders</span> -->
                </div>
                <div class="me-3 d-flex align-items-center navIcon" style="cursor:pointer">
                    <IconBtn icon="fa-solid fa-bag-shopping" count="2" />
                    <!-- <span>Orders</span> -->
                </div>
                <div class="me-3 d-flex align-items-center navIcon" style="cursor:pointer">
                    <IconBtn icon="fa-solid fa-cart-shopping" count="12" />
                    <!-- <span>Cart</span> -->
                </div>
                <div class="me-3 d-flex align-items-center navIcon" style="cursor:pointer">
                    <IconBtn icon="fa-regular fa-heart" count="9" />
                    <!-- <span>Wishlists</span> -->
                </div>
            </div>
            <div
                class="search col-lg-5 col-md-6 d-lg-flex d-md-flex align-items-center d-sm-none d-none pe-4 justify-content-end">
                <Search />
                <div class="d-flex align-items-center" style="cursor:pointer">
                    <IconBtn icon="fa-regular fa-bell" count="1" />
                </div>
                <div class="dropdown">
                    <div style="cursor:pointer">
                        <IconBtn icon="fa-regular fa-user" data-bs-toggle="dropdown" />
                        <!-- <span>Profile</span> -->
                    </div>
                    <ul class="dropdown-menu h-100 pt-0">
                        <ProfileIcon />
                    </ul>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-end pe-0 d-lg-none d-md-none d-sm-flex d-flex">
                <IconBtn icon="fa-solid fa-bars" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" />
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        </div>
    </div>
</template>

<script setup>
import IconBtn from "./IconBtn.vue";
import ProfileIcon from "./ProfileIcon.vue";
import Search from "./Search.vue";
</script>

<style scoped>
.navIcon {
    border-bottom: solid 0px #fe919d;
    border-left: solid 1.7px #f5f2eb00;
    border-right: solid 1.7px #f5f2eb00;
    transition: 0.1s ease-in-out;
}

.navIconActive {
    border-left: solid 1.7px #efede8;
    border-right: solid 1.7px #efede8;
    border-bottom: solid 5px #fe919d;
    border-radius: 10px;
}

.navIcon:hover {
    border-left: solid 1.7px #efede8;
    border-right: solid 1.7px #efede8;
    border-bottom: solid 5px #fe919d;
    border-radius: 10px;
}

.activePage {
    color: #fe919d !important;
}

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
