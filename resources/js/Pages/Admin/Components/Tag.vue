<template>
    <div class="border rounded-lg shadow my-3 p-4 flex justify-between items-center">
        <div class="w-75">
            <div v-if="!editPage">
                {{ text }}
            </div>
            <div v-else class="w-100">
                <v-textarea autofocus rows="1" width="200" v-model="form.name" :color="$page.props.theme.color" variant="outlined"
                    label="Name" hide-details required></v-textarea>
            </div>
        </div>
        <div v-if="!editPage">
            <IconBtn v-bind="activatorProps" @click="editPage = !editPage" class="me-2 my-1"
                classes="bg-indigo-100 text-indigo-500" icon="fa-solid fa-pencil" />
            <v-dialog max-width="500">
                <template v-slot:activator="{ props: activatorProps }">
                    <IconBtn v-bind="activatorProps" class="me-2" classes="bg-red-100 text-red-500"
                        icon="fa-solid fa-trash-can" />
                </template>

                <template v-slot:default="{ isActive }">
                    <v-card title="Confirm to delete">
                        <v-card-text>
                            Are you sure you want to delete :
                            <span class="font-bold">{{ text }}</span>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <Button @click="$emit('Delete')" classes="mr-4 bg-red-300 text-red-800"
                                text="Delete" />
                            <Button @click="isActive.value = false" classes="border text-black" text="Cancel" />
                        </v-card-actions>
                    </v-card>
                </template>
            </v-dialog>
        </div>
        <div v-else>
            <IconBtn @click="editPage = !editPage" class="me-2"
                classes="bg-indigo-100 text-indigo-500" icon="fa-solid fa-xmark" />
            <IconBtn @click="$emit('Update',id,form.name),editPage = !editPage" class="me-2"
                classes="bg-green-100 text-green-500" icon="fa-solid fa-circle-up" />
        </div>
    </div>
</template>

<script setup>
import IconBtn from "@/Components/IconBtn.vue";
import Button from "@/Components/Button.vue";
import { ref } from "vue";
import {router,usePage,useForm} from '@inertiajs/vue3';

const props = defineProps({
    id : Number,
    text: String,
    tagType : String
});

const form = useForm({
    name : props.text
})

const editPage = ref(false);

</script>
