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
    supplier: Object
});

const toast = useToast();

const form = useForm({
    name: props.supplier.name,
    contact_person: props.supplier.contact_person,
    phone: props.supplier.phone,
    email: props.supplier.email,
    address: props.supplier.address
});

const handleSubmit = () => {
    form.put(route('suppliers.update', props.supplier.id), {
        onSuccess: () => {
            toast.success('Supplier Updated Successfully');
            form.reset();
        }
    });
}
</script>


<template>

    <Head title="Edit Supplier" />

    <AuthenticatedLayout>
        <template #header>
            <div class="breadcrumbs text-sm text-slate-900">
                <ul>
                    <li>
                        <NavLink :href="route('suppliers.index')" :active="route().current('suppliers.index')">
                            Suppliers
                        </NavLink>
                    </li>
                    <li>
                        <NavLink :active="route().current('suppliers.edit')">
                            Edit Supplier
                        </NavLink>
                    </li>
                </ul>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold text-center mb-4">Edit Supplier Form</h3>
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
