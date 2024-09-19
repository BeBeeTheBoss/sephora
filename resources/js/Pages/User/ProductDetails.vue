<template>
    <div class="mt-2 ps-2 pt-2 pb-3" @click="back">
        <font-awesome-icon icon="fa-solid fa-arrow-left" class="me-2" />
        <span class="fw-bold">Back to home</span>
    </div>
    <div>
        <Carousel height="300px" />
        <div style="position:relative;cursor:pointer">
            <div class="card-body px-3 pt-3">
                <div class="flex justify-between items-center">
                    <span class="text-muted" style="font-size:12px">Shirt <font-awesome-icon class="ms-2 me-1"
                            icon="fa-solid fa-fire" style="font-size: 13px;color:#fe919d" />12</span>
                    <IconBtn icon="fa-regular fa-heart"
                        style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d" />
                </div>
                <h5 class="card-title fw-bold">Oversized T-shirt</h5>
                <p class="card-text text-muted" style="font-size:10px">Some quick example text to build on the card
                    title
                    and make up the bulk of
                    the
                    card's content.</p>
                <div class="fw-bold d-flex align-items-center" style="color:#fe919d">$23000 <span
                        class="text-decoration-line-through text-muted ms-1" style="font-size:12px">$25000</span>
                </div>
            </div>
            <div class="flex items-center">
                <div class="col-5 flex justify-center items-center mt-3">
                    <IconBtn icon="fas fa-circle-minus" />
                    <input type="text" class="form-control w-25" value="1">
                    <IconBtn icon="fas fa-circle-plus" />
                </div>
                <div class="pt-3 col-7 pe-3">
                    <button class="btn w-100 fw-bold" style="background-color:#fe919d;color:white">
                        <font-awesome-icon icon="fa-solid fa-cart-shopping" class="me-2"></font-awesome-icon>
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Carousel from './Components/Carousel.vue';
import IconBtn from './Components/IconBtn.vue';

const back = () => {
    window.history.back();
}

</script>

<style></style>
