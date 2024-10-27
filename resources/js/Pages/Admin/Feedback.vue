<template>
    <Layout>
    <div class="container">
        <h3 class="text-center mt-3 text-[#ff006e]">FeedBacks</h3>
        <div class="row mt-5">
            <div class="col-md-6 gap-2 my-2" v-for="feedback in feedbacks" :key="feedback.id">
                <div class="card" style="border:2px solid #ff006e;">
                    <div class="card-header bg-white border-none d-flex">
                        <img class="rounded-circle me-3 border border-danger" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQG7WjONaOfilXR3bebrfe_zcjl58ZdAzJHYw&s" alt="" style="width:70px;">
                        <div class="">
                            <h3 class="fs-6">{{ feedback.user.name }}</h3>
                            <span style="font-size:14px;">{{ formatDate(feedback.created_at) }}</span>
                        </div>
                        <p class="ml-auto"><v-rating :length="5" :size="32" :model-value="feedback.star" readonly
                            active-color="primary" />
                        </p>
                    </div>
                    <div class="card-body">
                        {{ feedback.message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </Layout>
</template>

<script setup>
import Layout from './Layouts/Layout.vue'

const props = defineProps({
    'feedbacks' : Array
})

const formatDate = (dateString) => {
    // Create a new Date object from the dateString
    const date = new Date(dateString);

    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Format the date as per your requirement
    const formattedDate = `${date.getDate()}-${months[date.getMonth()]}-${date.getFullYear()}`;

    return formattedDate;
}


</script>

<style scoped></style>
