<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

$(document).ready(function () {
    $('#staffTable').DataTable();
});


defineProps({
    staff: Array
})
</script>


<template>

    <Head title="Staff" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Staff</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-10">
                            <h3 class="text-lg font-semibold"><i class="fa-solid fa-table"></i> Staff Table</h3>
                        </div>

                        <table id="staffTable" class="display">
                            <thead>
                                <tr>
                                    <th><i class="fa-solid fa-user"></i> &nbsp;Name</th>
                                    <th><i class="fa-solid fa-at"></i> &nbsp;Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(staf, index) in staff" :key="index">
                                    <td>{{ staf.name }}</td>
                                    <td>{{ staf.email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
