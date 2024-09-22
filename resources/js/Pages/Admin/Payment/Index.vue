<template>
    <Layout>
        <Link :href="$route('payments.create')">
            <button class="btn mb-3 float-end text-white btn-sm" style="background-color:#ff006e;">
                + Add
            </button>
        </Link>

        <table class="table table-bordered">
            <thead>
                <tr>
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
                            <v-textarea
                                autofocus
                                rows="1"
                                width="200"
                                v-model="form.name"
                                variant="outlined"
                                label="Name"
                                hide-details
                                required
                            ></v-textarea>
                        </div>
                    </td>
                    <td>
                        <v-col cols="6">
                            <v-switch @change="logSwitchValue(payment.id)" v-model="switchValue[payment.id]" color="primary" label="on"></v-switch>
                        </v-col>
                    </td>
                    <td>
                        <form @submit.prevent="deletePayment(payment.id)">
                            <button
                                @click="editPayment(payment)"
                                v-if="editId !== payment.id"
                                class="btn btn-warning btn-sm me-2"
                            >
                                <font-awesome-icon icon="fa-regular fa-pen-to-square" />
                            </button>
                            <button
                                @click="savePayment(payment.id)"
                                v-else
                                class="btn btn-success btn-sm me-2"
                            >
                                Save
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <font-awesome-icon icon="fa-solid fa-trash" />
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
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { update } from '../../Composables/httpMethod.js';
import { del } from '../../Composables/httpMethod.js';

const props = defineProps({
    payments: Array,
});

// Initialize switchValue with default states
const switchValue = ref({});
props.payments.forEach(payment => {
    switchValue.value[payment.id] = true; // or false based on your initial state
});

const logSwitchValue = (id) => {
    console.log(`Current state is: ${switchValue.value[id]}`);
};

// Form state to hold the current payment's name
const form = useForm({
    name: '',
});

const editPage = ref(false);
const editId = ref(null);  // To track which payment is being edited

// Function to edit the payment, sets the form.name to the selected payment's name
const editPayment = (payment) => {
    form.name = payment.name;
    editId.value = payment.id; // Use payment.id instead of index
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
