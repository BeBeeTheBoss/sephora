<template>
    <Layout>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-6 border border-success rounded-3 p-3 shadow-lg">
                <form @submit.prevent="submit">
                    <h4 class="text-center">Create Product</h4>
                    <v-row>
                        <v-col cols="12">
                            <v-select label="Select Category" v-model="form.category_id" :items="props.categories"
                                item-title="name" item-value="id" required></v-select>
                        </v-col>

                        <v-col cols="12">
                            <v-textarea autofocus rows="1" v-model="form.name" variant="outlined" label="Name"
                                hide-details></v-textarea>
                        </v-col>

                        <v-col cols="12">
                            <v-textarea autofocus rows="1" v-model="form.description" variant="outlined"
                                label="Description" hide-details></v-textarea>
                        </v-col>

                        <v-col cols="12">
                            <v-textarea autofocus rows="1" v-model="form.price" variant="outlined" label="Price"
                                hide-details></v-textarea>
                        </v-col>

                        <v-col cols="12">
                            <v-textarea autofocus rows="1" v-model="form.discount_price" variant="outlined"
                                label="Discount Percent(%)" hide-details></v-textarea>
                        </v-col>
                        <v-col cols="12" v-for="(imageBox, index) in imagesBoxes" :key="index">
                            <v-file-input @change="onFileChange($event, index)" :show-size="1000"
                                color="deep-purple-accent-4" label="File input" placeholder="Select your files" chips
                                prepend-icon="mdi-camera" variant="outlined" counter multiple
                                @click:clear="clearImage(index)"></v-file-input>

                            <div class="preview flex justify-center">
                                <v-img class="rounded-lg mb-4" :height="300" cover v-if="formImageUrl[index]"
                                    :src="formImageUrl[index]" />
                            </div>
                        </v-col>

                        <v-col cols="12">
                            <button type="button"
                                class="my-3 ms-2 inline-flex items-center px-5 py-3 border rounded-md font-semibold text-xs tracking-widest text-white transition ease-in-out duration-150"
                                @click="addImage" style="background-color: green;">
                                <font-awesome-icon icon="fa-solid fa-plus" class="me-2" />
                                Add Image
                            </button>
                        </v-col>
                    </v-row>
                    <button class="btn btn-success w-100 rounded-lg text-white my-3 py-2">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import Layout from '../Layouts/Layout.vue';
import { post } from '../../Composables/httpMethod.js';
import { useToast } from 'vue-toastification';
const props = defineProps({
    categories: Object
});

const formImageUrl = ref([]);
const toast = useToast();
const form = useForm({
    category_id: "",
    name: "",
    description: "",
    price: "",
    discount_price: "",
    images: [],
});

const imagesBoxes = ref([
    {
        images: null,
    },
]);

const addImage = () => {
    imagesBoxes.value.push({
        images: null,
    });
};

const onFileChange = (e, index) => {
    const file = e.target.files[0];
    if (file) {
        formImageUrl.value[index] = URL.createObjectURL(file);
        imagesBoxes.value[index].images = file;
    }
};


const clearImage = (index) => {
    formImageUrl.value[index] = null;
    imagesBoxes.value[index].images = null;
};

const submit = () => {
    if (form.name == '' || form.description == '' || form.price == '' || form.images == []) {
        toast.warning('All fields are required');
        return;
    }
    form.images = imagesBoxes.value.map((box) => box.images);
    post(form, route("products.store"));
};
</script>

<style lang="scss" scoped></style>
