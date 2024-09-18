<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="col-md-6 border border-danger rounded-3 p-3">
            <form @submit.prevent="submit">
                <h4 class="text-center">Create Product</h4>
                <v-row>
                    <v-col cols="12">
                        <v-select label="Select Category" v-model="form.category_id" :items="props.categories"
                            item-title="name" item-value="id" required></v-select>
                        <ErrorMessage :text="form.errors.category_id" />
                    </v-col>

                    <v-col cols="12">
                        <v-textarea autofocus rows="1" v-model="form.name" variant="outlined" label="Name"
                            hide-details></v-textarea>
                        <ErrorMessage :text="form.errors.name" />
                    </v-col>

                    <v-col cols="12">
                        <v-textarea autofocus rows="1" v-model="form.description" variant="outlined" label="Description"
                            hide-details></v-textarea>
                        <ErrorMessage :text="form.errors.description" />
                    </v-col>

                    <v-col cols="12">
                        <v-textarea autofocus rows="1" v-model="form.price" variant="outlined" label="Price"
                            hide-details></v-textarea>
                        <ErrorMessage :text="form.errors.price" />
                    </v-col>

                    <v-col cols="12">
                        <v-textarea autofocus rows="1" v-model="form.discount_price" variant="outlined"
                            label="Discount Price" hide-details></v-textarea>
                        <ErrorMessage :text="form.errors.discount_price" />
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
                            class="my-3 ms-2 bg-red-500 inline-flex items-center px-5 py-3 border rounded-md font-semibold text-xs tracking-widest text-white transition ease-in-out duration-150"
                            @click="addImage">
                            <font-awesome-icon icon="fa-solid fa-plus" class="me-2" />
                            Add Image
                        </button>
                    </v-col>
                </v-row>
                <button class="btn w-100 rounded-lg text-white my-2" style="background-color: #ff595e">
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    categories : Object
});

const formImageUrl = ref([]);

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
    form.images = imagesBoxes.value.map((box) => box.images);
    form.post("/admin/products");
};
</script>

<style lang="scss" scoped></style>
