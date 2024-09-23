<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

google.charts.load('current', { packages: ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

const props = defineProps({
    pendingOrders: Number,
    shippedOrders: Number,
    completedOrders: Number,
    cancelledOrders: Number,
})

function drawChart() {

    // Set Data
    const data = google.visualization.arrayToDataTable([
        ['Order Status', 'Count'],
        ['Pending', props.pendingOrders],
        ['Shipped', props.shippedOrders],
        ['Completed', props.completedOrders],
        ['Cancelled', props.cancelledOrders],
    ]);

    // Set Options
    const options = {
        title: 'Order Status',
        is3D: true
    };

    // Draw
    const chart = new google.visualization.PieChart(document.getElementById('orderStatusChart'));
    chart.draw(data, options);

}
</script>

<template>

    <Head title="User Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div id="orderStatusChart" style="max-width:700px; height:400px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
