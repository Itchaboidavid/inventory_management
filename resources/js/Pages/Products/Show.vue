<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    product: Object
})
</script>


<template>

    <Head :title="`${product.name}`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ product.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 w-1/2 mx-auto">
                        <h3 class="text-xl font-semibold text-center mb-4">{{ product.name }}</h3>
                        <div class="flex justify-between">
                            <div class="space-y-4">
                                <p class="space-x-1">
                                    <i class="fa-solid fa-icons"></i>
                                    Name: <b>{{ product.name }}</b>
                                </p>
                                <p class="space-x-1 text-wrap">
                                    <i class="fa-solid fa-circle-info"></i>
                                    Description: <br> <b class="text-sm">{{ product.description }}</b>
                                </p>
                                <p class="space-x-1">
                                    <i class="fa-solid fa-peso-sign"></i>
                                    Price: <b>{{ product.price }}</b>
                                </p>
                            </div>

                            <div class="space-y-4">
                                <p class="space-x-1">
                                    <i class="fa-solid fa-percent"></i>
                                    Quantity: <b>{{ product.quantity }}</b>
                                </p>
                                <p class="space-x-1">
                                    <i class="fa-solid fa-folder-open"></i>
                                    Category: <b>{{ product.category.name }}</b>
                                </p>
                                <p class="space-x-1">
                                    <i class="fa-solid fa-building"></i>
                                    Supplier: <b>{{ product.supplier.name }}</b>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
