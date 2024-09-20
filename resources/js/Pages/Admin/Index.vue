<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    products: Array
})

//Google Chart
google.charts.load('current', { packages: ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    // Set Data
    const data = google.visualization.arrayToDataTable([
        ['Month', 'Orders'],
        ['January', 55],
        ['February', 49],
        ['March', 44],
        ['April', 24],
        ['June', 15],
        ['July', 2],
        ['August', 23],
        ['September', 14],
        ['October', 671],
        ['November', 71],
        ['December', 88]
    ]);

    // Set Options
    const options = {
        title: 'Orders for Year 2024'
    };

    // Draw
    const chart = new google.visualization.BarChart(document.getElementById('orderChart'));
    chart.draw(data, options);

    //-----------------------------------------------------------------------------------------------------//

    // Product Data
    const productData = google.visualization.arrayToDataTable([
        ['Product', 'Stock'],
        ...props.products.map(product => [product.name, product.quantity])
    ]);

    // Set Options
    const productOptions = {
        title: 'Product Stock',
        is3D: true
    };

    // Draw
    const productChart = new google.visualization.PieChart(document.getElementById('productChart'));
    productChart.draw(productData, productOptions);


}
</script>

<template>

    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div id="orderChart" class="h-[350px] border shadow-lg"></div>
                        <div id="productChart" class="h-[350px] border shadow-lg"></div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
