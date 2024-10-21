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

            <div class="col-md-9">
                <h5 class="text-center">Daily Sales</h5>
                <canvas id="daily_sales"></canvas>
            </div>

        </div>
    </Layout>
</template>

<script setup>
import Layout from './Layouts/Layout.vue'
import { ref, onMounted } from 'vue';
import Chart from "chart.js/auto";

const props = defineProps({
    dashboardCards: Array,
    orderProducts: Array,
    tokens : Array
})

onMounted(() => {

    // Daily Sales
    const ctx = document.getElementById('daily_sales');

    const labelsByDay = [
        "1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th", "9th", "10th",
        "11th", "12th", "13th", "14th", "15th", "16th", "17th", "18th", "19th",
        "20th", "21st", "22nd", "23rd", "24th", "25th", "26th", "27th", "28th",
        "29th", "30th", "31st"
    ];

    function getSalesByDay(orderProducts) {
        const now = new Date();
        const currentMonth = now.getMonth();
        const currentYear = now.getFullYear();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const revenueByDay = Array(daysInMonth).fill(0);

        orderProducts.forEach((order) => {
            const createdAt = new Date(order.created_at);
            if (createdAt.getMonth() === currentMonth && createdAt.getFullYear() === currentYear) {
                const dayIndex = createdAt.getDate() - 1;
                revenueByDay[dayIndex] += parseFloat(order.total_price); // Sum up the total_amount for the day
            }
        });

        return revenueByDay;
    }

    const salesByDay = props.orderProducts;
    const dailySalesByDay = getSalesByDay(salesByDay);

    const dynamicSalesData = {
        labels: labelsByDay.slice(0, dailySalesByDay.length),
        datasets: [
            {
                label: "Daily Sales",
                data: dailySalesByDay,
                fill: false,
                borderColor: 'rgb(255,102,204)',
                tension: 0.1
            },
        ],
    };

if (ctx) {
    const myChart = new Chart(ctx, {
        type: "bar",
        data: {
            ...dynamicSalesData,
            datasets: dynamicSalesData.datasets.map(dataset => ({
                ...dataset,
                backgroundColor: 'rgba(75, 192, 192, 0.2)', 
                borderColor: 'rgba(75, 192, 192, 1)', 
                borderWidth: 1
            }))
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });
}


//User Activity
const ctx2 = document.getElementById('user_activity');


function getActivityByDay(tokens) {
    const now = new Date();
    const currentMonth = now.getMonth();
    const currentYear = now.getFullYear();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    const activityByDay = Array(daysInMonth).fill(0);

    tokens.forEach((token) => {
        const createdAt = new Date(token.created_at);
        if (createdAt.getMonth() === currentMonth && createdAt.getFullYear() === currentYear) {
            const dayIndex = createdAt.getDate() - 1;
            activityByDay[dayIndex]++;
        }
    });

    return activityByDay;
}

const activityByDay = props.orderProducts;
const userActivityByDay = getActivityByDay(activityByDay);

const dynamicActivityData = {
    labels: labelsByDay.slice(0, userActivityByDay.length),
    datasets: [
        {
            label: "Daily Sales",
            data: dailySalesByDay,
            fill: false,
            borderColor: 'rgb(255,102,204)',
            tension: 0.1
        },
    ],
};

if (ctx2) {
const myChart = new Chart(ctx2, {
    type: "bar",
    data: {
        ...dynamicActivityData,
        datasets: dynamicActivityData.datasets.map(dataset => ({
            ...dataset,
            backgroundColor: 'rgba(75, 192, 192, 0.2)', 
            borderColor: 'rgba(75, 192, 192, 1)', 
            borderWidth: 1
        }))
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    },
});
}



});

</script>


<style scoped></style>
