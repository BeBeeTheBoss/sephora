<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6 border border-danger rounded-3 p-3">
            <form @submit.prevent="updateCategory">
                <h4 class="text-center">Edit Category</h4>
                <v-row>
                    <v-col cols="12">
                        <v-textarea autofocus rows="1" v-model="form.name" variant="outlined" label="Name" hide-details
                            required></v-textarea>
                        <ErrorMessage :text="form.errors.name" />
                    </v-col>

                    <v-col cols="12">
                            <v-file-input chips prepend-icon="mdi-camera"
                                @change="onFileChange" @input="form.image = $event.target.files[0]" variant="outlined"
                                label="File" show-size clearable @click:clear="clearImage"></v-file-input>
                            <div class="preview flex justify-center position-relative">
                                <v-img class="rounded-lg mb-4" :width="1" :height="300" cover v-if="formImageUrl"
                                    :src="formImageUrl" />
                                <v-img class="rounded-lg mb-4" :width="1" :height="300" cover v-else-if="form.image"
                                    :src="form.image" />
                                    <div v-if="form.image" style="position:absolute;top:10px;right:10px">
                                <button @click="clearImage">
                                    <font-awesome-icon icon="fa-solid fa-circle-xmark" class="text-white fs-2" />
                                </button>
                            </div>
                            </div>
                        </v-col>
                </v-row>

                <button class="btn w-100 rounded-lg my-2 text-white" style="background-color:#ff595e;">Update</button>
            </form>
        </div>
    </div>

</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { update } from '../../Composables/httpMethod.js';
const props = defineProps({
    category: Object
});

const form = useForm({
    id : props.category.id,
    name: props.category.name,
    image: props.category.image,
    delete_images: []

});

const formImageUrl = ref(null);

const onFileChange = (e) => {
    const file = e.target.files[0];
    formImageUrl.value = URL.createObjectURL(file);
}
const clearImage = () => {

    if (form.image) {
        let imageName = form.image.name || formImageUrl.value.split('/').pop();
        if (!form.delete_images.includes(imageName)) {
            form.delete_images.push(imageName);
        }
    }
    formImageUrl.value = null;
    form.image = null;
}

const updateCategory = () => {
    update(form,route("categories.update", props.category.id))
};
</script>

<style scoped>
/* You can add styles here if needed */
</style>
