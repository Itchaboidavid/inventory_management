<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    supplier: Object
})
</script>


<template>

    <Head :title="`${supplier.name} Supplier`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ `${supplier.name} Supplier` }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 w-1/2 mx-auto">
                        <h3 class="text-xl font-semibold text-center mb-4">{{ supplier.name }}</h3>
                        <div class="flex justify-between">
                            <div class="space-y-4">
                                <p class="space-x-1">
                                    <i class="fa-solid fa-user"></i>
                                    Name: <b>{{ supplier.name }}</b>
                                </p>
                                <p class="space-x-1">
                                    <i class="fa-solid fa-address-book"></i>
                                    Contact Person: <b>{{ supplier.contact_person }}</b>
                                </p>
                                <p class="space-x-1">
                                    <i class="fa-solid fa-phone"></i>
                                    Phone: <b>{{ supplier.phone }}</b>
                                </p>
                            </div>

                            <div class="space-y-4">
                                <p class="space-x-1">
                                    <i class="fa-solid fa-envelope"></i>
                                    Email: <b>{{ supplier.email }}</b>
                                </p>
                                <p class="space-x-1">
                                    <i class="fa-solid fa-location-dot"></i>
                                    Address: <b>{{ supplier.address }}</b>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
