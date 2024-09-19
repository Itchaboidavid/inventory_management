<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import NavLink from '@/Components/NavLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const props = defineProps({
    product: Object,
    suppliers: Array,
    categories: Array
});

const form = useForm({
    name: props.product.name,
    description: props.product.description,
    price: props.product.price,
    quantity: props.product.quantity,
    category_id: props.product.category_id,
    supplier_id: props.product.supplier_id,
});

const toast = useToast();

const handleSubmit = () => {
    form.put(route('products.update', props.product.id), {
        onSuccess: () => {
            toast.success('Product Updated Successfully');
            form.reset()
        }
    });
}
</script>

<template>

    <Head title="Add Product" />

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
                        <NavLink :active="route().current('products.edit')">
                            Edit Product
                        </NavLink>
                    </li>
                </ul>
            </div>
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
                                    <option :value="form.category_id" selected>{{ product.category.name }}</option>
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
                                    <option :value="form.supplier_id" selected>{{ product.supplier.name }}</option>
                                    <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">
                                        {{ supplier.name }}
                                    </option>
                                </select>

                                <InputError class="mt-2" :message="form.errors.supplier_id" />
                            </div>

                            <div class="mt-4">
                                <PrimaryButton class="block w-full justify-center"
                                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
