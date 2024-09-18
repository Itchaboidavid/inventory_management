<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    category: Object
})
</script>


<template>

    <Head :title="`${category.name} Category`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ `${category.name} category` }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 w-1/2 mx-auto">
                        <h3 class="text-xl font-semibold text-center mb-4">{{ category.name }}</h3>
                        <div>
                            <p class="space-x-1">
                                <i class="fa-solid fa-folder-open"></i>
                                Name: <b>{{ category.name }}</b>
                            </p>
                            <p class="space-x-1">
                                <i class="fa-solid fa-circle-info"></i>
                                Description: <b>{{ category.description }}</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
