<template>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" style="width: 100%">
        <div class="carousel-inner">\
            <div class="carousel-item active">
                <img class="w-100 rounded-2 shadow" :style="{ height }" style="object-fit: cover; object-position: top"
                    src="https://static.vecteezy.com/system/resources/previews/001/937/856/non_2x/paper-art-shopping-online-on-smartphone-sale-promotion-backgroud-banner-for-market-ecommerce-free-vector.jpg"
                    alt="" />
            </div>
            <div class="carousel-item">
                <img class="w-100 rounded-2 shadow" :style="{ height }" style="object-fit: cover; object-position: top"
                    src="https://static.vecteezy.com/system/resources/previews/002/006/774/non_2x/paper-art-shopping-online-on-smartphone-and-new-buy-sale-promotion-backgroud-for-banner-market-ecommerce-free-vector.jpg"
                    alt="" />
            </div>
            <div class="carousel-item">
                <img class="w-100 rounded-2 shadow" :style="{ height }" style="object-fit: cover; object-position: top"
                    src="https://static.vecteezy.com/system/resources/previews/015/614/507/non_2x/online-shopping-on-phone-buy-sell-business-digital-web-banner-application-money-advertising-payment-ecommerce-illustration-search-podium-vector.jpg"
                    alt="" />
            </div>
        </div>
        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button> -->
    </div>
</template>

<script setup>
defineProps({
    height: String,
});
</script>

<style></style>
