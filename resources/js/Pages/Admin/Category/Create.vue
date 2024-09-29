<template>
   <Layout>
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-8 col-lg-6 border border-success rounded-3 p-4 shadow-lg">
            <form @submit.prevent="submit">
                <h4 class="text-center mb-4 text-success">Create Category</h4>
                <v-row>
                    <v-col cols="12">
                        <v-textarea
                            autofocus
                            rows="2"
                            v-model="form.name"
                            variant="outlined"
                            label="Category Name"
                            hide-details
                            class="mb-3"
                        ></v-textarea>
                       
                    </v-col>

                    <v-col cols="12">
                        <v-file-input
                            @change="onFileChange"
                            @input="form.image = $event.target.files[0]"
                            :show-size="1000"
                            color="deep-purple-accent-4"
                            label="Upload Image"
                            placeholder="Select an image for the category"
                            chips
                            prepend-icon="mdi-camera"
                            variant="outlined"
                            clearable
                            @click:clear="clearImage"
                            class="mb-3"
                        ></v-file-input>

                        <div class="preview flex justify-center mb-4">
                            <v-img
                                class="rounded-lg"
                                :height="300"
                                cover
                                v-if="formImageUrl"
                                :src="formImageUrl"
                            />
                        </div>
                    </v-col>
                </v-row>
                
                <div class="d-flex justify-content-between">
                    <button
                        class="btn btn-success w-100 rounded-lg my-2 text-white"
                        style="background-color: #4caf50; border: none;"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</Layout>


</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { post } from '../../Composables/httpMethod.js';
import Layout from '../Layouts/Layout.vue';
// import { toast } from 'vue3-toastify';
// import 'vue3-toastify/dist/index.css';

import { useToast } from 'vue-toastification';


const form = useForm({
    name: '',
    image: null,
})

const formImageUrl = ref(null);
const toast = useToast()

const onFileChange = (e) => {
    const file = e.target.files[0];
    formImageUrl.value = URL.createObjectURL(file);
}
const clearImage = () => {
    formImageUrl.value = null;
    form.image = null;
}
const submit = () => {

    if (form.name == '') {
        toast.warning('The name field is required');
    } else {
        post(form, route("categories.store"));
    }
}
</script>

<style lang="scss" scoped></style>
