<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="col-md-6 border border-danger rounded-3 p-3">
            <form @submit.prevent="submit">
                <h4 class="text-center">Create Product</h4>
                <v-row>
                    <v-col cols="12">
                        <v-textarea autofocus rows="1" v-model="form.name" variant="outlined" label="Name" hide-details
                        ></v-textarea>
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
                        <v-file-input :show-size="1000" color="deep-purple-accent-4" label="File input"
                            @input="imageBox.image = $event.target.files[0]" placeholder="Select your files" chips
                            prepend-icon="mdi-camera" variant="outlined" counter multiple></v-file-input>
                    </v-col>

                    <v-col cols="12">
                        <button type="btn"
                            class="my-3 ms-2 bg-red-500 inline-flex items-center px-5 py-3 border rounded-md font-semibold text-xs tracking-widest text-white transition ease-in-out duration-150"
                            @click="addImage"><font-awesome-icon icon="fa-solid fa-plus" class="me-2" /> Add
                            Image</button>
                    </v-col>

                </v-row>
                <button class="btn w-100 rounded-lg text-white my-2" style="background-color:#ff595e;">Submit</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    description: "",
    price: "",
    discount_price: "",
    images: [],
});

const imagesBoxes = ref([{
    'image': null,
}]);

const addImage = () => {
    imagesBoxes.value.push({
        'file': null
    });
};


const submit = () => {
    form.images = imagesBoxes.value.map(box => box.image);

    form.post("/admin/categories");
};
</script>

<style lang="scss" scoped></style>
