<template>
    <div :class="cardClass" style="position:relative;cursor:pointer">
        <IconBtn icon="fa-regular fa-heart" class=""
            style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d;position:absolute;top:3px;right:3px;" />
        <img class="w-100 card-img-top" style="object-fit:cover;object-position:center;background-color:#F5F3F3"
            src="https://i.pinimg.com/564x/58/9d/1f/589d1fc969e66291e1de0fd1428ef250.jpg" alt="">
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

.card-img-top {
    background-color: rgba(255, 255, 255, 0.477);
}
</style>
