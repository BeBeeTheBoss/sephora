<template>
    <Layout>
        <Link :href="$route('payments.create')">
        <button class="btn mb-3 float-end" style="border:1px solid #ff006e;">
            + Create New </button>
        </Link>

        <table class="table">
            <thead>
                <tr class="table-danger">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Is Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(payment, index) in payments" :key="payment.id">
                    <td>{{ index + 1 }}</td>
                    <td>
                        <div v-if="!editPage || editId !== payment.id">
                            {{ payment.name }}
                        </div>
                        <div v-else>
                            <v-textarea autofocus rows="1" width="200" v-model="form.name" variant="outlined"
                                label="Name" hide-details required></v-textarea>
                        </div>
                    </td>
                    <td>
                        <v-col cols="6">
                            <p class="d-none">{{ payment.is_active = payment.is_active ? true : false }}</p>
                            <v-switch @change="changeSwitchValue(payment.is_active, payment.id)" focused="true"
                                v-model="payment.is_active" color="primary"></v-switch>
                        </v-col>
                    </td>
                    <td>
                        <form @submit.prevent="deletePayment(payment.id)">
                            <button @click="editPayment(payment)" v-if="editId !== payment.id"
                                class="btn border btn-sm me-2">
                                Edit
                            </button>
                            <button @click="savePayment(payment.id)" v-else class="btn btn-success btn-sm me-2">
                                Save
                            </button>
                            <button class="btn btn-sm" style="border:1px solid #ff0054;">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </Layout>
</template>

<script setup>
import Layout from '../Layouts/Layout.vue';
import { ref } from 'vue';
import { update } from '../../Composables/httpMethod.js';
import { del } from '../../Composables/httpMethod.js';
import { useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
    payments: Array,
});

const form = useForm({
    name : ''
})


const changeSwitchValue = (is_active, id) => {
    const formForSwitch = useForm({
        id: id,
        is_active: is_active
    })
    let options = {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Congrats, it's successful!", {autoClose: 6000})
        }
    }
    formForSwitch.post(route('payments.toggle'),options);
};

const editPage = ref(false);
const editId = ref(null);

const editPayment = (payment) => {
    form.name = payment.name;
    editId.value = payment.id;
    editPage.value = true;
};

// Function to save the payment
const savePayment = (id) => {
    editPage.value = false;
    editId.value = null;
    update(form, route('payments.update', id));
};

// Function to delete the payment
const deletePayment = (id) => {
    del(form, route('payments.destroy', id));
};
</script>


<style lang="scss" scoped></style>
