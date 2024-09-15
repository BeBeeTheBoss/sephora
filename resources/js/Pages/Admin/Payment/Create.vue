<template>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-4 border border-danger rounded-3 p-3">
        <form @submit.prevent="submit">
            <h4 class="text-center">Create Payment</h4>
            <div class="form-group mb-2">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" v-model="form.name" class="form-control">
                <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
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
})

const submit = () => {
    form.post('/admin/payments');
}
</script>

<style lang="scss" scoped>

</style>
