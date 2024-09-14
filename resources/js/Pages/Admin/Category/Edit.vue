<template>
     <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-4 border border-danger rounded-3 p-3">
        <form @submit.prevent="update(props.category.id)">
            <h4 class="text-center">Edit Category</h4>
            <div class="form-group mb-2">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" v-model="form.name" class="form-control">
                <div v-if="form.errors.name" v-text="form.errors.name" class="text-danger"></div>
            </div>
            <div class="form-group mb-2">
                <label for="image" class="form-label fw-bold">Image</label>
                <input type="file" class="form-control" @change="handleChangeImage($event)">
                <img :src="`/storage/images/${form.image}`" alt="" style="width:100px;" class="mt-4">
                <div v-if="form.errors.image" v-text="form.errors.image" class="text-danger"></div>
            </div>
            <button class="btn btn-primary float-end my-2">Update</button>
        </form>
    </div>
    </div>
  </template>

  <script setup>
  import { useForm } from '@inertiajs/vue3';

  const props = defineProps({
    category: Object
  });

  const form = useForm({
    name: props.category.name,
    image : props.category.image,
  });

  const handleChangeImage = (e) => {
    form.image = e.target.files[0];
  }

  const update = (id) => {
    form.post(`/admin/categories/${id}/update`);
  };
  </script>

  <style scoped>
  /* You can add styles here if needed */
  </style>
