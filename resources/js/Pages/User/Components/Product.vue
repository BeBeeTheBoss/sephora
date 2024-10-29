<template>
    <div :class="cardClass" style="position:relative;cursor:pointer;height:400px;">
        <!-- <IconBtn icon="fa-regular fa-heart" class=""
            style="background-color:rgba(255, 255, 255, 0.8);color:#fe919d;position:absolute;top:3px;right:3px" /> -->
        <img :class="imageClass" style="width:80%;height:60%;object-fit:cover;object-position:center;background-color:#F5F3F3" :src="image"
            alt="">
        <div class="card-body" style="max-height: 150px;">
            <span class="text-muted" style="font-size:12px">{{ categoryName }}<font-awesome-icon class="ms-2 me-1"
                    icon="fa-solid fa-fire" style="font-size: 13px;color:#fe919d" />{{ popular }}</span>
            <h6 class="card-title fw-bold">{{ truncatedName(name) }}</h6>
            <p class="card-text text-muted w-100" style="font-size:10px;white-space: pre;">
                {{ truncatedDescription(description) }}
            </p>
            <div class="flex justify-between">
            <div class="fw-bold d-flex align-items-center" style="color:#fe919d">{{ price }}Ks <span
                    v-if="discount_price > 0" class="text-decoration-line-through text-muted ms-1"
                    style="font-size:12px">{{ discount_price
                    }}</span>
            </div>
            <Link :href="'/product/detail/' + product_id"><button class="btn btn-secondary" @click.stop>Detail</button></Link>
        </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, ref } from "vue";

const props = defineProps({
    size: String,
    categoryName: String,
    name: String,
    description: String,
    price: Number,
    discount_price: Number,
    popular: Number,
    product_id : Number,
    image: String
});


const cardClass = ref('');
const imageClass = ref('');

const isPhoneSize = () => {
    if (props.size == "phone") {
        cardClass.value = "card shadow-sm width";
        imageClass.value = "height w-100 card-img-top"
    } else {
        cardClass.value = "card shadow-sm";
        imageClass.value = "w-100 card-img-top pc-height"
    }
}

isPhoneSize();

const truncatedDescription = (description) => {
    const words = description ? description.trim().split(/\s+/) : [];
    if (words.length > 20) {
        return words.slice(0, 4).join(' ') + '...';
    } else {
        return description;
    }
};

const truncatedName = (name) => {
    const words = name ? name.trim().split(/\s+/) : [];
    if (words.length > 10) {
        return words.slice(0, 5).join(' ') + '...';
    } else {
        return name;
    }
};



</script>

<style scoped>
.width {
    width: 300px;
}

.pc-height {
    height: 350px;
}

.height {
    height: 200px
}

.card-img-top {
    background-color: rgba(255, 255, 255, 0.477);
}
</style>
