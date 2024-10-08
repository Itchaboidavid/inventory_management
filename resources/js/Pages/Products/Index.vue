<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useToast } from 'vue-toastification';
import { Teleport } from 'vue';
import { onMounted } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

// onMounted(() => {
//     $('#productsTable').DataTable();
// });

defineProps({
    products: Array
});

const toast = useToast();
const form = useForm({});
const page = usePage();
const user = page.props.auth.user;

const isModalOpen = ref(false);
const selectedProduct = ref(null);

const orderForm = useForm({
    product_id: '',
    quantity: '',
    price: '',
    status: ''
});

const totalPrice = () => {
    if (selectedProduct) {
        orderForm.price = orderForm.quantity * selectedProduct.value.price;
    }
}

const openModal = (product) => {
    selectedProduct.value = product;
    orderForm.product_id = selectedProduct.value.id
    orderForm.quantity = 1; // Reset quantity on modal open
    totalPrice(); // Calculate price when opening
    isModalOpen.value = true;
}

const placeOrder = () => {
    orderForm.post(route('orders.store'), {
        onSuccess: () => {
            toast.success('Order was placed');
            isModalOpen.value = false; // Close modal after successful order
        },
        onError: () => toast.fail("We can't process your order.")
    });
}

const deleteProduct = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        form.delete(route('products.destroy', id), {
            onSuccess: () => toast.success('Product Deleted Successfully')
        });
    }
}
</script>


<template>

    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
                <Link :href="route('products.create')" v-if="user.role === 'admin'">
                <PrimaryButton>Add New Product</PrimaryButton>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                    <div
                        class="p-6 text-gray-900 overflow-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 place-items-center gap-y-10">

                        <!-- <div class="flex justify-between items-center mb-10">
                            <h3 class="text-lg font-semibold"><i class="fa-solid fa-table"></i> Products Table</h3>
                            <Link :href="route('products.create')" v-if="user.role === 'admin'">
                            <PrimaryButton>Add New Product</PrimaryButton>
                            </Link>
                        </div>

                        <table id="productsTable" class="display">
                            <thead>
                                <tr>
                                    <th><i class="fa-solid fa-icons"></i> &nbsp;Name</th>
                                    <th><i class="fa-solid fa-circle-info"></i> &nbsp;Description</th>
                                    <th><i class="fa-solid fa-peso-sign"></i> &nbsp;Price</th>
                                    <th><i class="fa-solid fa-percent"></i> &nbsp;Quantity</th>
                                    <th><i class="fa-solid fa-folder-open"></i> &nbsp;Category</th>
                                    <th><i class="fa-solid fa-building"></i> &nbsp;Supplier</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, index) in products" :key="index">
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.description }}</td>
                                    <td>{{ product.price }}</td>
                                    <td>{{ product.quantity }}</td>
                                    <td>{{ product.category.name }}</td>
                                    <td>{{ product.supplier.name }}</td>
                                    <td v-if="user.role === 'admin'">
                                        <Dropdown align="right" width="48">
                                            <template #trigger>
                                                <span class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-400 focus:outline-none transition ease-in-out duration-150">
                                                        Action

                                                        <svg class="ms-2 -me-0.5 h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            </template>

                                            <template #content>
                                                <DropdownLink :href="route('products.show', product.id)">
                                                    <span class="text-blue-500">Show</span>
                                                </DropdownLink>
                                                <DropdownLink :href="route('products.edit', product.id)">
                                                    <span class="text-green-500">Edit</span>
                                                </DropdownLink>
                                                <button type="button" @click="deleteProduct(product.id)"
                                                    class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                    <span class="text-red-500">Delete</span>
                                                </button>
                                            </template>
                                        </Dropdown>
                                    </td>
                                    <td v-else>
                                        <button class="btn btn-primary text-white"
                                            @click="openModal(product)">Order</button>
                                        <Teleport to="body">
                                            <div class="modal" :class="{ 'modal-open': isModalOpen }">
                                                <div class="modal-box">
                                                    <h3 class="font-bold text-lg text-slate-200 text-center">
                                                        {{ selectedProduct?.name }}
                                                    </h3>
                                                    <form @submit.prevent="placeOrder">
                                                        <input type="hidden" v-model="orderForm.product_id">
                                                        <div class="mt-4">
                                                            <InputLabel for="quantity" value="Quantity"
                                                                class="text-slate-200" />

                                                            <TextInput id="quantity" type="number" min="1"
                                                                @change="totalPrice"
                                                                class="mt-1 block w-full text-slate-900"
                                                                v-model="orderForm.quantity" />

                                                            <InputError class="mt-2"
                                                                :message="orderForm.errors.quantity" />
                                                        </div>

                                                        <div class="mt-4">
                                                            <InputLabel for="price" value="Total Price"
                                                                class="text-slate-200" />

                                                            <TextInput id="price" type="text" readonly
                                                                class="mt-1 block w-full text-slate-900"
                                                                v-model="orderForm.price" />

                                                            <InputError class="mt-2"
                                                                :message="orderForm.errors.price" />
                                                        </div>

                                                        <div class="mt-4">
                                                            <InputLabel for="status" value="Order Status" />

                                                            <select name="status" id="status" v-model="orderForm.status"
                                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full text-slate-900 ">
                                                                <option value="" selected>--- -- ---</option>
                                                                <option value="pending">Pending</option>
                                                                <option value="shipped">Shipped</option>
                                                                <option value="completed">Completed</option>
                                                            </select>

                                                            <InputError class="mt-2"
                                                                :message="orderForm.errors.status" />
                                                        </div>

                                                        <div class="mt-4">
                                                            <PrimaryButton class="block w-full justify-center"
                                                                :class="{ 'opacity-25': form.processing }"
                                                                :disabled="form.processing">
                                                                Place Order
                                                            </PrimaryButton>
                                                        </div>
                                                    </form>
                                                    <div class="modal-action">
                                                        <button @click="isModalOpen = false" class="btn">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </Teleport>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                        <div v-for="(product, index) in products" :key="index"
                            class="card bg-base-100 max-w-sm md:max-w-xs shadow-xl text-slate-200 h-full">
                            <figure class="h-[200px] relative">
                                <img :src="`/storage/${product.image_path}`" :alt="product.name"
                                    class="object-cover w-full" />

                                <details v-if="user.role === 'admin'" class="dropdown absolute top-0 left-0 z-10">
                                    <summary class="btn btn-ghost p-2 pt-0 text-slate-900 m-1 text-lg">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </summary>
                                    <ul class="menu dropdown-content bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                                        <DropdownLink :href="route('products.show', product.id)">
                                            <span class="text-white">Show</span>
                                        </DropdownLink>
                                        <DropdownLink :href="route('products.edit', product.id)">
                                            <span class="text-white">Edit</span>
                                        </DropdownLink>
                                        <button type="button" @click="deleteProduct(product.id)"
                                            class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                            <span class="text-white">Delete</span>
                                        </button>
                                    </ul>
                                </details>
                            </figure>
                            <div class="card-body">
                                <!-- Product Title -->
                                <h2 class="card-title flex items-center justify-between">
                                    {{ product.name }}
                                    <div class="badge badge-secondary">NEW</div>
                                </h2>
                                <!-- Product Description -->
                                <p>{{ `${product.description.slice(0, 100)}...` }}</p>

                                <!-- Product Category -->
                                <div class="card-actions justify-end py-3">
                                    <div class="badge badge-outline">{{ product.category.name }}</div>
                                </div>
                                <!-- Order Button -->
                                <div class="card-footer border-t pt-5">
                                    <PrimaryButton class="justify-center w-full block" @click="openModal(product)">
                                        Order
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Teleport to="body">
            <div class="modal" :class="{ 'modal-open': isModalOpen }">
                <div class="modal-box">
                    <h3 class="font-bold text-lg text-slate-200 text-center">
                        {{ selectedProduct?.name }}
                    </h3>
                    <form @submit.prevent="placeOrder">
                        <input type="hidden" v-model="orderForm.product_id">
                        <div class="mt-4">
                            <InputLabel for="quantity" value="Quantity" class="text-slate-200" />

                            <TextInput id="quantity" type="number" min="1" @change="totalPrice"
                                class="mt-1 block w-full text-slate-900" v-model="orderForm.quantity" />

                            <InputError class="mt-2" :message="orderForm.errors.quantity" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="price" value="Total Price" class="text-slate-200" />

                            <TextInput id="price" type="text" readonly class="mt-1 block w-full text-slate-900"
                                v-model="orderForm.price" />

                            <InputError class="mt-2" :message="orderForm.errors.price" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="status" value="Order Status" />

                            <select name="status" id="status" v-model="orderForm.status"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full text-slate-900 ">
                                <option value="" selected>--- -- ---</option>
                                <option value="pending">Pending</option>
                                <option value="shipped">Shipped</option>
                                <option value="completed">Completed</option>
                            </select>

                            <InputError class="mt-2" :message="orderForm.errors.status" />
                        </div>

                        <div class="mt-4">
                            <PrimaryButton class="block w-full justify-center"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Place Order
                            </PrimaryButton>
                        </div>
                    </form>
                    <div class="modal-action">
                        <button @click="isModalOpen = false" class="btn">Close</button>
                    </div>
                </div>
            </div>
        </Teleport>
    </AuthenticatedLayout>
</template>
