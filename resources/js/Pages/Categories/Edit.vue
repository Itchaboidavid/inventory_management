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
    category: Object
})

const form = useForm({
    name: props.category.name,
    description: props.category.description,
});

const toast = useToast();

const handleSubmit = () => {
    form.put(route('categories.update', props.category.id), {
        onSuccess: () => {
            toast.success('Category Updated Successfully');
            form.reset()
        }
    });
}
</script>


<template>

    <Head title="Edit Category" />

    <AuthenticatedLayout>
        <template #header>
            <div class="breadcrumbs text-sm text-slate-900">
                <ul>
                    <li>
                        <NavLink :href="route('categories.index')" :active="route().current('categories.index')">
                            Categories
                        </NavLink>
                    </li>
                    <li>
                        <NavLink :active="route().current('categories.edit')">
                            Edit Category
                        </NavLink>
                    </li>
                </ul>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold text-center mb-4">Edit Category Form</h3>
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
