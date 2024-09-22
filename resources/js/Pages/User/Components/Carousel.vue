<template>
    <div :id="id" class="carousel slide" data-bs-ride="carousel" style="width: 100%">
        <div class="carousel-inner" @click=show>
            <div class="carousel-item" :class="isActive(index)" v-for="(image, index) in images" :key="index">
                <img class="w-100 rounded-2 shadow" :style="{ height }" style="object-fit: cover; object-position: top"
                    :src="image.image" alt="" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" :data-bs-target="'#' + id" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" :data-bs-target="'#' + id" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
const props = defineProps({
    height: String,
    images: Object,
    from: String
});

const id = ref(null);

const isActive = (index) => {
    return index == 0 ? "active" : "";
}

const show = () => {
    id.value
}

onMounted(() => {

    if (props.from == 'ads') {
        id.value = "adsCarousel"
    } else if (props.from == 'phone') {
        id.value = "phoneCarousel"
    } else {
        id.value = props.from
    }
})


</script>

<style></style>
