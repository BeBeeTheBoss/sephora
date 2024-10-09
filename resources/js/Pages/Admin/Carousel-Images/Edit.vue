<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6 border border-danger rounded-3 p-3">
            <form @submit.prevent="updateCategory">
                <h4 class="text-center">Edit Carousel Images</h4>
                <v-row>
                    <v-col cols="12">
                        <v-file-input chips prepend-icon="mdi-camera" @change="onFileChange"
                            @input="form.image = $event.target.files[0]" variant="outlined" label="File" show-size
                            clearable @click:clear="clearImage"></v-file-input>
                        <div class="preview flex justify-center">
                            <v-img class="rounded-lg mb-4" :width="1" :height="300" cover v-if="formImageUrl"
                                :src="formImageUrl" />
                            <v-img class="rounded-lg mb-4" :width="1" :height="300" cover v-else-if="form.image"
                                :src="form.image" />
                        </div>
                    </v-col>
                </v-row>
                <div class="d-flex ">
                    <Link class="btn btn-primary w-100 rounded-lg my-2 me-2" :href="$route('carousel_images.index')">Back</Link>
                    <button class="btn w-100 rounded-lg my-2 text-white"
                        style="background-color:#ff595e;">Update</button>
                </div>
            </form>
        </div>
    </div>

</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { update } from '../../Composables/httpMethod.js';
const props = defineProps({
    carouselImage: Object
});

const form = useForm({
    id: props.carouselImage.id,
    image: props.carouselImage.name,
});

const formImageUrl = ref(null);

const onFileChange = (e) => {
    const file = e.target.files[0];
    formImageUrl.value = URL.createObjectURL(file);
}
const clearImage = () => {
    formImageUrl.value = null;
    form.image = null;
}

const updateCategory = () => {
    update(form, route("carousel_images.update", props.carouselImage.id))
};
</script>

<style scoped>
/* You can add styles here if needed */
</style>
