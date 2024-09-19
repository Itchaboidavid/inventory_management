<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast();

const props = defineProps({
    order: Object,
});

const form = useForm({
    product_id: props.order.id,
    quantity: props.order.quantity,
    price: props.order.price,
    status: props.order.status,
});

const computeTotal = () => {
    form.price = form.quantity * props.order.price;
}

const handleSubmit = () => {
    form.put(route('orders.update', props.order.id), {
        onSuccess: () => {
            toast.success('Order Updated Successfully');
            form.reset()
        }
    });
}
</script>

<template>

    <Head title="Edit Order" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Order</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold text-center mb-4">{{ order.product.name }} | {{ order.user.name
                            }}</h3>
                        <form class="w-1/2 mx-auto" @submit.prevent="handleSubmit">
                            <input type="hidden" v-model="form.product_id">
                            <div>
                                <InputLabel for="quantity" value="Quantity" />

                                <TextInput id="quantity" type="number" min='1' class="mt-1 block w-full"
                                    @change="computeTotal" v-model="form.quantity" autofocus />

                                <InputError class="mt-2" :message="form.errors.quantity" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="price" value="Price" />

                                <TextInput id="price" type="text" class="mt-1 block w-full" v-model="form.price"
                                    readonly />

                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="status" value="Status" />
                                <select name="status" id="status" v-model="form.status"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                    <option :value="form.status" selected>{{ order.status }}</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                    <option value="pending">Pending</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.category_id" />
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
