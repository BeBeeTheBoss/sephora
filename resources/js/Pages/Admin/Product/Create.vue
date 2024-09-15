<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-4 border border-danger rounded-3 p-3">
        <form @submit.prevent="submit">
            <h4 class="text-center">Create Product</h4>
            <div class="form-group mb-2">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" v-model="form.name" class="form-control">
                <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
            </div>
            <div class="form-group mb-2">
                <label for="name" class="form-label fw-bold">Description</label>
                <textarea name="" id="" rows="4" class="form-control" v-model="form.description"></textarea>
                <div v-if="form.errors.description" class="text-danger">{{ form.errors.description }}</div>
            </div>
            <div class="form-group mb-2">
                <label for="name" class="form-label fw-bold">Price</label>
                <input type="text" v-model="form.price" class="form-control">
                <div v-if="form.errors.price" class="text-danger">{{ form.errors.price }}</div>
            </div>
            <div class="form-group mb-2">
                <label for="name" class="form-label fw-bold">Discount Price</label>
                <input type="text" v-model="form.discount_price" class="form-control">
                <div v-if="form.errors.discount_price" class="text-danger">{{ form.errors.discount_price }}</div>
            </div>
            <div class="form-group mb-2">
                <label for="image" class="form-label fw-bold">Image</label>
                <input type="file" class="form-control" @change="handleFileChange">
            </div>
            <button class="btn btn-primary float-end my-2">Submit</button>
        </form>
    </div>
    </div>

</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name : '',
    description : '',
    price : '',
    discount_price : '',
    image : null,
})

const handleFileChange = (e) => {
    form.image = e.target.files[0];
}

const submit = () => {
    form.post('/admin/categories');
}
</script>

<style lang="scss" scoped>

</style>
