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
    contact_person: '',
    phone: '',
    email: '',
    address: ''
});

const toast = useToast();

const handleSubmit = () => {
    form.post(route('suppliers.store'), {
        onFinish: () => {
            toast.success('Supplier Added Successfully');
            form.reset()
        }
    });
}
</script>


<template>

    <Head title="Add Supplier" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Supplier</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold text-center mb-4">Add New Supplier Form</h3>
                        <form class="w-1/2 mx-auto" @submit.prevent="handleSubmit">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                    autofocus />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="contact_person" value="Contact Person" />

                                <TextInput id="contact_person" type="text" class="mt-1 block w-full"
                                    v-model="form.contact_person" />

                                <InputError class="mt-2" :message="form.errors.contact_person" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="phone" value="Phone" />

                                <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" />

                                <InputError class="mt-2" :message="form.errors.phone" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />

                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="address" value="Address" />

                                <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" />

                                <InputError class="mt-2" :message="form.errors.address" />
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
