<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
      <div class="col-md-6 border border-danger rounded-3 p-3">
        <form @submit.prevent="update">
          <h4 class="text-center">Edit Product</h4>
          <v-row>
            <!-- Category Selection -->
            <v-col cols="12">
              <v-select 
                label="Select Category" 
                v-model="form.category_id" 
                :items="props.categories"
                item-title="name" 
                item-value="id" 
                required
              />
              <ErrorMessage :text="form.errors.category_id" />
            </v-col>
  
            <!-- Product Fields (Name, Description, Price, etc.) -->
            <v-col cols="12">
              <v-textarea 
                autofocus 
                rows="1" 
                v-model="form.name" 
                variant="outlined" 
                label="Name" 
                hide-details
              />
              <ErrorMessage :text="form.errors.name" />
            </v-col>
  
            <v-col cols="12">
              <v-textarea 
                autofocus 
                rows="1" 
                v-model="form.description" 
                variant="outlined" 
                label="Description" 
                hide-details
              />
              <ErrorMessage :text="form.errors.description" />
            </v-col>
  
            <v-col cols="12">
              <v-textarea 
                autofocus 
                rows="1" 
                v-model="form.price" 
                variant="outlined" 
                label="Price" 
                hide-details
              />
              <ErrorMessage :text="form.errors.price" />
            </v-col>
  
            <v-col cols="12">
              <v-textarea 
                autofocus 
                rows="1" 
                v-model="form.discount_price" 
                variant="outlined" 
                label="Discount Price" 
                hide-details
              />
              <ErrorMessage :text="form.errors.discount_price" />
            </v-col>
  
            <!-- Existing Image Display -->
            <v-col cols="12">
              <div v-for="(image, imgIndex) in form.images" :key="imgIndex" class="position-relative me-3">
                <v-img 
                  class="rounded-lg mb-4 d-flex me-3 border position-relative" 
                  :width="250" 
                  :height="300" 
                  cover 
                  :src="image.image" 
                />
                <div style="position:absolute;top:10px;right:10px">
                  <button type="button" @click="deleteExistingImage(imgIndex)">
                    <font-awesome-icon icon="fa-solid fa-circle-xmark" class="fs-2" />
                  </button>
                </div>
              </div>
            </v-col>
  
            <!-- New Image Upload Inputs -->
            <v-col cols="12" v-for="(imageBox, index) in imagesBoxes" :key="index">
              <v-file-input 
                @change="onFileChange($event, index)" 
                :show-size="1000"
                color="deep-purple-accent-4" 
                label="File input" 
                placeholder="Select your files" 
                chips 
                prepend-icon="mdi-camera" 
                variant="outlined" 
                counter 
                @click:clear="clearNewImage(index)"
              />
              <v-img 
                v-if="formImageUrl[index]" 
                class="rounded-lg mb-4" 
                :width="250" 
                :height="300" 
                cover 
                :src="formImageUrl[index]" 
              />
            </v-col>
  
            <!-- Add More Images Button -->
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
            Update
          </button>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import { useForm } from "@inertiajs/vue3";
  
  const props = defineProps({
    categories: Object,
    product: Object
  });
  
  const formImageUrl = ref([]); // New image previews
  const deleteImages = ref([]);  // Images to delete
  
  const form = useForm({
    category_id: props.product.category_id,
    name: props.product.name,
    description: props.product.description,
    price: props.product.price,
    discount_price: props.product.discount_price,
    images: props.product.images, // Existing images from the product
  });
  
  const imagesBoxes = ref([{}]); // New images input boxes
  
  // Add new image box
  const addImage = () => {
    imagesBoxes.value.push({});
  };
  
  // Handle new file input change
  const onFileChange = (e, index) => {
    const file = e.target.files[0];
    if (file) {
      formImageUrl.value[index] = URL.createObjectURL(file); // Preview image
      imagesBoxes.value[index].images = file;               // Store the file
    }
  };
  
  // Clear new image input
  const clearNewImage = (index) => {
    formImageUrl.value.splice(index, 1);
    imagesBoxes.value.splice(index, 1);
  };
  
  // Delete an existing image
  const deleteExistingImage = (index) => {
    const image = form.images[index];
    if (image) {
      deleteImages.value.push(image.id); // Track image for deletion
      form.images.splice(index, 1);      // Remove from the display
    }
  };
  
  // Handle form update submission
  const update = () => {
    const formData = new FormData();
  
    // Append form fields
    formData.append('category_id', form.category_id);
    formData.append('name', form.name);
    formData.append('description', form.description);
    formData.append('price', form.price);
    formData.append('discount_price', form.discount_price);
  
    // Append images marked for deletion
    deleteImages.value.forEach(id => {
      formData.append('delete_images[]', id);
    });
  
    // Append existing images that haven't been deleted
    form.images.forEach((image, index) => {
      formData.append(`existing_images[${index}]`, image.id); // Append image ID
    });
  
    // Append new images
    imagesBoxes.value.forEach((imageBox, index) => {
      if (imageBox.images) {
        formData.append(`new_images[${index}]`, imageBox.images); // Append the new image file
      }
    });
  
    // Submit the form data
    form.transform(() => formData) // This will send the FormData directly.
      .post(route('products.update', props.product.id), {
        onSuccess: () => {
          // Handle success, e.g., redirect or show a success message
        },
        onError: (errors) => {
          // Handle validation or server errors
        }
      });
  };
  </script>
  
  <style lang="scss" scoped></style>
  