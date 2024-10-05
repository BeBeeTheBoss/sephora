<template>
    <Navbar />
    <div class="container row py-4">
        <h3 ref="titleRef" class="section-title"></h3>
        <div class="col-md-4 product-card" v-for="product in trending_products" :key="product.id">
            <Carousel :from="'productCarousel' + product.id" :images="product.images" height="300px" />
            <div class="card-body">
                <h5 class="card-title">{{ product.name }}</h5>
                <p class="card-text">
                    {{ product.description }}
                </p>
                <p class="card-price">${{ product.price }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref,onMounted} from 'vue';
import Carousel from "./Components/Carousel.vue";
import Navbar from './Components/Navbar.vue';
const props = defineProps({
    trending_products: Array
})

const titleRef = ref(null);

// Colors for each letter in "Trending Products"
const rainbowColors = ['#FF0000', '#FF7F00', '#FFFF00', '#00FF00', '#0000FF', '#4B0082', '#9400D3', '#FF1493'];

const applyRainbowColors = () => {
    const titleText = "Trending Products";
    const titleElement = titleRef.value;
    titleElement.innerHTML = '';

    // Loop through each letter and apply a color
    for (let i = 0; i < titleText.length; i++) {
        const letterSpan = document.createElement('span');
        letterSpan.textContent = titleText[i];


        if (i < 8) {
            letterSpan.style.color = rainbowColors[i % rainbowColors.length];
        }

        titleElement.appendChild(letterSpan);
    }
};

onMounted(() => {
    applyRainbowColors();
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap');

.section-title {
    font-family: "Permanent Marker", cursive;
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    color: #333;
}

.product-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
    margin-bottom: 1.5rem;
    max-width: 320px;
    cursor: pointer;
}

.product-card:hover{
    transform: translateY(-5px);

}
.card-body {
    padding: 1rem;
    font-family: 'Poppins', sans-serif;
}



.card-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #e74c3c;
}
</style>
