<template>
    <div class="card pb-3">
        <div v-if="profile?.name" class="pb-2">
            <div class="img d-flex justify-content-center align-items-center">
                <img class="w-100 rounded rounded-5"
                    src="https://static.vecteezy.com/system/resources/previews/018/765/757/original/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-sign-business-concept-vector.jpg"
                    alt="">
            </div>
            <div class="info">
                <span>{{ profile.name }}</span>
                <div class="text-center">
                    <div style="font-size:10px">
                        {{ profile.email }}
                    </div>
                    <!-- <div style="font-size:10px">
                        09769274236
                    </div> -->
                </div>
            </div>
            <div class="flex flex-col">
                <Link :href="route('profile.page')">
                Update
                </Link>
                <Link @click="logout">
                Logout
                </Link>
            </div>
        </div>
        <div v-else class="d-flex justify-center">
            <div class="mt-3">
                <div class="text-center" style="font-size:13px">
                    You are not logged in
                </div>
                <div class="flex justify-center" style="margin-top:-10px">
                    <Link :href="route('loginPage')">
                    login
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import IconBtn from './IconBtn.vue';
import { Link, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { ref, onMounted } from 'vue'

const props = defineProps({
    profile: Object
})

const logout = () => {
    router.post(route('logout'), {}, {
        onSuccess: () => {
            router.visit(route('home'));
        }
    });
}

</script>

<style scoped>
.card {
    width: 190px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    /* background: #f2f2f3; */
    border-radius: 12px;
    /* box-shadow: inset 5px 5px 10px #a9a9aa77,
        inset -5px -5px 10px #ffffff7e; */
}

.card .img {
    height: 100px;
    margin-top: 1.6em;
    margin-left: 5px;
    aspect-ratio: 1;
    border-radius: 30%;
    background: #f2f2f3;
    margin-bottom: 0.4em;
    box-shadow: -5px -5px 8px #ffffff7a,
        5px 5px 8px #a9a9aa7a;
}

.card .info {
    text-align: center;
    margin-top: 0.4em;
    margin-bottom: 20px;
    background: linear-gradient(120deg, #fe919d, #fe919d);
    background-clip: border-box;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.card .info>span {
    font-weight: bold;
    font-size: 1.2em;
}

.card a {
    margin-top: 1em;
    color: #fff;
    text-decoration: none;
    background: linear-gradient(90deg, #fe919d, #fe919d);
    padding: .5em 2em;
    border-radius: 0.7em;
}

.card a:active {
    box-shadow: inset 3px 3px 3px #0056ff,
        inset -3px -3px 3px #00c2ff;
}
</style>
