<template>
    <Layout>
        <div class="row my-3">
            <div v-for="card in cards" :key="card.id" class="col-md-3">
                <div class="card bg-gradient-to-r from-pink-200 via-purple-200 to-indigo-200 p-6 rounded-md shadow-md">
                    <div class="border-none text-purple-700 text-lg font-semibold">
                        
                        {{ card.title }}
                    </div>
                    <div class="card-body ">
                    <h6 class="text-purple-700">{{ card.count }}</h6>
                    </div>
                </div>
            </div>

        </div>
        <div class="row flex justify-center">
            <div class="col-md-6">
                <h5 class="text-center">Daily New Order</h5>
                <canvas id="daily_new_order"></canvas>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from './Layouts/Layout.vue'
import { ref,onMounted } from 'vue';
import Chart from "chart.js/auto";

const props = defineProps({
    orders: Array,
    dashboardCards : Array
})
const cards = ref(props.dashboardCards);

onMounted(() => {
    const ctx = document.getElementById('daily_new_order');

    const labelsByDay = [
        "1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th", "9th", "10th",
        "11th", "12th", "13th", "14th", "15th", "16th", "17th", "18th", "19th",
        "20th", "21st", "22nd", "23rd", "24th", "25th", "26th", "27th", "28th",
        "29th", "30th", "31st"
    ];

    function getOrdersCountByDay(orders) {
        const now = new Date();
        const currentMonth = now.getMonth();
        const currentYear = now.getFullYear();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const counts = Array(daysInMonth).fill(0);

        orders.forEach((order) => {
            const createdAt = new Date(order.created_at);
            if (createdAt.getMonth() === currentMonth && createdAt.getFullYear() === currentYear) {
                const dayIndex = createdAt.getDate() - 1;
                counts[dayIndex]++;
            }
        });

        return counts;
    }

    const ordersByDay = props.orders;
    const orderCountsByDay = getOrdersCountByDay(ordersByDay);

    const dynamicDataByDay = {
        labels: labelsByDay.slice(0, orderCountsByDay.length),
        datasets: [
            {
                label: "Daily New orders",
                data: orderCountsByDay,
                fill: false,
                borderColor: 'rgb(255,102,204)',
                tension: 0.1
            },
        ],
    };

    const myChart = new Chart(ctx, {
        type: "line",
        data: dynamicDataByDay,
    });
})

</script>


<style scoped></style>
