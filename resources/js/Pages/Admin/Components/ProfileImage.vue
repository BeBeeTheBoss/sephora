<template>
    <div class="dropdown">
        <div class="dropdown-toggle me-12" type="button" data-bs-toggle="dropdown">
        <img
            src="https://images.pexels.com/photos/1040881/pexels-photo-1040881.jpeg?auto=compress&cs=tinysrgb&w=600"
            alt="" aria-expanded="false" style="width:50px;height:50px;object-fit:cover;border-radius:50%;">

            <span class="mt-3">{{ profile?.name }}</span>
        </div>
        <ul class="dropdown-menu">
            <li>
                <Link class="dropdown-item" :href="$route('profile')"><font-awesome-icon class="me-2"
                    icon="fa-regular fa-user" /> My Profile</Link>
            </li>
            <li @click="logout"><a class="dropdown-item"><font-awesome-icon class="me-2"
                        icon="fa-solid fa-arrow-right-from-bracket" /> Logout</a></li>
        </ul>
    </div>
</template>

<script setup>
import { Link,router } from "@inertiajs/vue3";
import { route } from 'ziggy-js';

const props = defineProps({
    profile : Object
})

const logout = () => {
    router.post(route('logout'), {}, {
        onSuccess: () => {
            router.visit(route('home'));
        }
    });
};
</script>

<style lang="scss" scoped></style>
