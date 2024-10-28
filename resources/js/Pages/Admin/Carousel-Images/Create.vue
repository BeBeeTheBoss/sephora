<template>
    <Layout>
    <div class="container d-flex justify-content-center align-items-center" style="height:80vh;">
        <div class="col-md-6 border border-success shadow-lg rounded-3 p-3">
            <form @submit.prevent="submit">
                <h4 class="text-center">Create Carousel Image</h4>
                <v-row>
                    <v-col cols="12" :key="index">
                        <v-file-input @change="onFileChange($event,index)" @input="form.image = $event.target.files[0]"
                            :show-size="1000" color="deep-purple-accent-4" label="File input"
                            placeholder="Select your files" chips prepend-icon="mdi-camera" variant="outlined" clearable
                            @click:clear="clearImage"></v-file-input>

                        <div class="preview flex justify-center">
                            <v-img class="rounded-lg mb-4" :height="300" cover v-if="formImageUrl"
                                :src="formImageUrl" />
                        </div>

                    </v-col>
                </v-row>

                <button class="btn btn-success w-100 rounded-lg my-2 text-white">Submit</button>
            </form>
        </div>
    </div>
    </Layout>

</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue';
import { useToast } from 'vue-toastification';
import { post } from '../../Composables/httpMethod';

const form = useForm({
    image : null,
})

const toast = useToast()

const formImageUrl = ref(null);
const onFileChange = (e) => {
    const file = e.target.files[0];
        formImageUrl.value = URL.createObjectURL(file);
};

const clearImage = () => {
    formImageUrl.value = null;
};

const submit = () => {
    if(form.image == null){
        toast.warning('The image field is required');
    }
    post(form,route('carousel_images.store'));
};
</script>

<style lang="scss" scoped></style>
