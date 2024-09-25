<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6 border border-danger rounded-3 p-3">
            <form @submit.prevent="submit">
                <h4 class="text-center">Create Category</h4>
                <v-row>
                    <v-col cols="12">
                        <v-textarea autofocus rows="1" v-model="form.name" variant="outlined" label="Name"
                            hide-details></v-textarea>
                        <div v-if="form.errors.name" class="text-sm mt-2 text-red-400">
                            {{ form.errors.name }}
                        </div>
                    </v-col>

                    <v-col cols="12">
                        <v-file-input @change="onFileChange" @input="form.image = $event.target.files[0]"
                            :show-size="1000" color="deep-purple-accent-4" label="File input"
                            placeholder="Select your files" chips prepend-icon="mdi-camera" variant="outlined" clearable
                            @click:clear="clearImage"></v-file-input>

                        <div class="preview flex justify-center">
                            <v-img class="rounded-lg mb-4" :height="300" cover v-if="formImageUrl"
                                :src="formImageUrl" />
                        </div>
                    </v-col>

                </v-row>
                <div class="d-flex ">
                    <button class="btn w-100 rounded-lg my-2 me-2 text-white"
                        style="background-color: #2a9d8f;">Back</button>
                    <button class="btn w-100 rounded-lg my-2 text-white"
                        style="background-color:#f77f00">Submit</button>
                </div>
            </form>
        </div>
    </div>

</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { post } from '../../Composables/httpMethod.js';

const form = useForm({
    name: '',
    image: null,
})

const formImageUrl = ref(null);

const onFileChange = (e) => {
    const file = e.target.files[0];
    formImageUrl.value = URL.createObjectURL(file);
}
const clearImage = () => {
    formImageUrl.value = null;
    form.image = null;
}
const submit = () => {
    post(form, route("categories.store"));
}
</script>

<style lang="scss" scoped></style>
