<template>
    <div class="container d-flex justify-center items-center" style="min-height: 100vh;">
      <form @submit.prevent="update">
        <label>Edit Category</label>
        <div class="input-group">
          <input type="text" v-model="form.name" class="form-control" />
          <div v-if="form.errors.name" v-text="form.errors.name" class="text-danger"></div>
        </div>
        <button class="btn btn-primary">Update</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3';
  
  const props = defineProps({
    category: Object
  });
  
  const form = useForm({
    name: props.category.name
  });
  
  const update = () => {
    form.put(`/admin/categories/${props.category.id}/update`);
  };
  </script>
  
  <style scoped>
  /* You can add styles here if needed */
  </style>
  