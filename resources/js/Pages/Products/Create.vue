<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const form = useForm({
    name: '',
    description: '',
    price: '',
    quantity: '',
    category_id: '',
    supplier_id: '',
});

const toast = useToast();

const handleSubmit = () => {
    form.post(route('products.store'), {
        onSuccess: () => {
            toast.success('Product Added Successfully');
            form.reset()
        }
    });
}

defineProps({
    suppliers: Array,
    categories: Array
});
</script>

<template>

    <Head title="Add Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Product</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold text-center mb-4">Add New Product Form</h3>
                        <form class="w-1/2 mx-auto" @submit.prevent="handleSubmit">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                    autofocus />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="description" value="Description" />

                                <TextInput id="description" type="text" class="mt-1 block w-full"
                                    v-model="form.description" />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="price" value="Price" />

                                <TextInput id="price" type="text" class="mt-1 block w-full" v-model="form.price" />

                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="quantity" value="Quantity" />

                                <TextInput id="quantity" type="number" class="mt-1 block w-full" min="1"
                                    v-model="form.quantity" />

                                <InputError class="mt-2" :message="form.errors.quantity" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="category_id" value="Category" />

                                <select name="category_id" id="category_id" v-model="form.category_id"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                    <option value="" selected>--- -- ---</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>

                                <InputError class="mt-2" :message="form.errors.category_id" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="supplier_id" value="Supplier" />

                                <select name="supplier_id" id="supplier_id" v-model="form.supplier_id"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                    <option value="" selected>--- -- ---</option>
                                    <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">
                                        {{ supplier.name }}
                                    </option>
                                </select>

                                <InputError class="mt-2" :message="form.errors.supplier_id" />
                            </div>

                            <div class="mt-4">
                                <PrimaryButton class="block w-full justify-center"
                                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Submit
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
