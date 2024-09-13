<template>
    <div class="container d-flex justify-center items-center" style="min-height:100vh;">
        <form @submit.prevent="submit">
            <label for="">Create Category</label>
            <div class="input-group">
                <input type="text" v-model="form.name" class="form-control">
                <div v-if="form.errors.name" v-text="form.errors.name" class="text-danger"></div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';


const form = useForm({
    name : ''
})

const submit = () => {
    form.post('store');
}
</script>

<style lang="scss" scoped>

</style>