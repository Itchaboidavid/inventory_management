<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

$(document).ready(function () {
    $('#productsTable').DataTable();
});

const toast = useToast();
const form = useForm({});

const deleteProduct = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        form.delete(route('products.destroy', id), {
            onSuccess: () => toast.success('Product Deleted Successfully')
        });
    }
}


defineProps({
    products: Array
})
</script>


<template>

    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 overflow-auto">
                        <div class="flex justify-between items-center mb-10">
                            <h3 class="text-lg font-semibold"><i class="fa-solid fa-table"></i> Products Table</h3>

                            <Link :href="route('products.create')">
                            <PrimaryButton>Add New Product</PrimaryButton>
                            </Link>

                        </div>

                        <table id="productsTable" class="display">
                            <thead>
                                <tr>
                                    <th><i class="fa-solid fa-icons"></i> &nbsp;Name</th>
                                    <th><i class="fa-solid fa-circle-info"></i> &nbsp;Description</th>
                                    <th><i class="fa-solid fa-peso-sign"></i> &nbsp;Price</th>
                                    <th><i class="fa-solid fa-percent"></i> &nbsp;Quantity</th>
                                    <th><i class="fa-solid fa-folder-open"></i> &nbsp;Category</th>
                                    <th><i class="fa-solid fa-building"></i> &nbsp;Supplier</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, index) in products" :key="index">
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.description }}</td>
                                    <td>{{ product.price }}</td>
                                    <td>{{ product.quantity }}</td>
                                    <td>{{ product.category.name }}</td>
                                    <td>{{ product.supplier.name }}</td>
                                    <td>
                                        <Dropdown align="right" width="48">
                                            <template #trigger>
                                                <span class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-400 focus:outline-none transition ease-in-out duration-150">
                                                        Action

                                                        <svg class="ms-2 -me-0.5 h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            </template>

                                            <template #content>
                                                <DropdownLink :href="route('products.show', product.id)">
                                                    <span class="text-blue-500">Show</span>
                                                </DropdownLink>
                                                <DropdownLink :href="route('products.edit', product.id)">
                                                    <span class="text-green-500">Edit</span>
                                                </DropdownLink>
                                                <button type="button" @click="deleteProduct(product.id)"
                                                    class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                    <span class="text-red-500">Delete</span>
                                                </button>
                                            </template>
                                        </Dropdown>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
