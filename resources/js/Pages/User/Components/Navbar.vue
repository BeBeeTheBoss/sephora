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
                <div class="me-3 d-flex align-items-center navIcon" :class="isActive('/')" style="cursor:pointer">
                    <Link href="/" style="color:black">
                    <IconBtn icon="fa-solid fa-home" />
                    </Link>
                    <!-- <span>Orders</span> -->
                </div>
                <div class="me-3 d-flex align-items-center navIcon" :class="isActive('/cart')" style="cursor:pointer">
                    <Link href="/cart" style="color:black">
                    <IconBtn icon="fa-solid fa-cart-shopping" v-if="cartCount" :count="cartCount" />
                    <IconBtn icon="fa-solid fa-cart-shopping" v-else />
                    </Link>
                    <!-- <span>Cart</span> -->
                </div>
                <div class="me-3 d-flex align-items-center navIcon" :class="isActive('/orders')" style="cursor:pointer">
                    <Link href="/orders" style="color:black">
                    <IconBtn icon="fa-solid fa-bag-shopping" v-if="orderCount" :count="orderCount" />
                    <IconBtn icon="fa-solid fa-bag-shopping" v-else />
                    </Link>
                    <!-- <span>Orders</span> -->
                </div>
                <div class="me-3 d-flex align-items-center navIcon" :class="isActive('/wish-lists')"
                    style="cursor:pointer">
                    <Link href="/wish-lists" style="color:black">
                    <IconBtn icon="fa-regular fa-heart" v-if="wishlistsCount" :count="wishlistsCount" />
                    <IconBtn icon="fa-regular fa-heart" v-else />
                    </Link>
                    <!-- <span>Wishlists</span> -->
                </div>
            </div>
            <div
                class="search col-lg-5 col-md-6 d-lg-flex d-md-flex align-items-center d-sm-none d-none pe-4 justify-content-end">
                <Search @seachInput="sendToLayout" />
                <!-- <div class="d-flex align-items-center" style="cursor:pointer">
                    <IconBtn icon="fa-regular fa-bell" count="1" />
                </div> -->
                <div class="dropdown">
                    <IconBtn icon="fa-regular fa-user" data-bs-toggle="dropdown" />
                    <ul class="dropdown-menu h-100 pt-0">
                        <ProfileIcon :profile="profile" />
                    </ul>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-end pe-2 d-lg-none d-md-none d-sm-flex d-flex">
                <Link :href="'/orders/all'">
                <IconBtn icon="fa-solid fa-bag-shopping" v-if="ordersCount" :count="ordersCount"
                    data-bs-target="#offcanvasExample" />
                <IconBtn icon="fa-solid fa-bag-shopping" v-else data-bs-target="#offcanvasExample" />
                </Link>
                <!-- <IconBtn icon="fa-regular fa-bell" count="3" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" /> -->
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
import { router, Link } from "@inertiajs/vue3";
import axios from "axios";
import { ref, onMounted, provide } from 'vue'

const emit = defineEmits(['searchInput']);

const data = ref('');
const sendToLayout = (input) => {
    emit('searchInput', input)
}

const isActive = (path) => {

    return router.page.url == path ? 'navIconActive' : "";

}


const profile = ref(null);
const wishlistsCount = ref(null);
const cartCount = ref(null);
const ordersCount = ref(null);

onMounted(() => {
    axios.get('/profile').then(response => {
        profile.value = response.data
    })
    axios.get('/wishlists-count').then(response => {
        wishlistsCount.value = response.data
    })
    axios.get('/cart-count').then(response => {
        cartCount.value = response.data
    })
    axios.get('/orders-count').then(response => {
        ordersCount.value = response.data
    })
})

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
