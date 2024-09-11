<template>
    <div :class="cardClass" style="position:relative;cursor:pointer">
        <IconBtn icon="fa-regular fa-heart"
            style="color:#fe919d;position:absolute;background-color:#F5F3F3;top:0;right:0" />
        <img class="w-100 card-img-top" style="object-fit:cover;object-position:center;background-color:#F5F3F3"
            src="https://mackweldon.com/cdn/shop/products/M01T12-TN_Front.png?v=1638913612" alt="">
        <div class="card-body">
            <span class="text-muted" style="font-size:12px">Shirt <font-awesome-icon class="ms-2 me-1"
                    icon="fa-solid fa-fire" style="font-size: 13px;color:#fe919d" />12</span>
            <h5 class="card-title fw-bold">Oversized T-shirt</h5>
            <p class="card-text text-muted" style="font-size:10px">Some quick example text to build on the card title
                and make up the bulk of
                the
                card's content.</p>
            <div class="fw-bold d-flex align-items-center" style="color:#fe919d">$23000 <span
                    class="text-decoration-line-through text-muted ms-1" style="font-size:12px">$25000</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import IconBtn from './IconBtn.vue';
import { defineProps, ref } from "vue";

const props = defineProps({
    size: String
});

const cardClass = ref('');

const isPhoneSize = () => {
    if (props.size == "phone") {
        cardClass.value = "card shadow-sm width";
    } else {
        cardClass.value = "card shadow-sm";
    }
}

isPhoneSize();

</script>

<style scoped>
.width {
    width: 300px;
}
</style>
