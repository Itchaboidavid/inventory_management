<script setup>
import NavLink from '@/Components/NavLink.vue';
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
            <div class="breadcrumbs text-sm text-slate-900">
                <ul>
                    <li>
                        <NavLink :href="route('products.index')" :active="route().current('products.index')">
                            Products
                        </NavLink>
                    </li>
                    <li>
                        <NavLink :active="route().current('products.show')">
                            {{ product.name }}
                        </NavLink>
                    </li>
                </ul>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 md:grid-cols-2 bg-base-100 shadow-xl w-1/2 mx-auto">
                            <figure>
                                <img :src="`/storage/${product.image_path}`" :alt="product.name"
                                    class="object-cover w-full h-full" />
                            </figure>
                            <div class="card-body text-slate-200">
                                <h2 class="card-title">{{ product.name }}</h2>
                                <p>Description: <b>{{ product.description }}</b></p>
                                <p class="text-justify">Price: <b>{{ product.price }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
