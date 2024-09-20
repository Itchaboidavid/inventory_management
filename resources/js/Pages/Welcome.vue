<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Sari-Store" />
    <header>
        <nav class="shadow-lg">
            <div class="navbar max-w-screen-lg mx-auto">
                <div class="flex-1">
                    <Link class="btn btn-ghost text-xl">Sari-Store</Link>
                </div>
                <div class="flex-none">
                    <ul class="menu menu-horizontal space-x-5">
                        <li>
                            <Link :href="route('login')">Login</Link>
                        </li>
                        <li>
                            <Link :href="route('register')">Register</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="hero min-h-screen" style="background-image: url('/storage/images/sari-store-1.jpg');">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-slate-200 text-center">
                <div class="max-w-screen-lg">
                    <h1 class="mb-5 text-4xl md:text-5xl font-bold" style="text-shadow: 1px 1px 1px black;">Welcome to
                        <span class="text-accent tracking-wider">Sari-Store</span>!
                    </h1>
                    <p class="mb-5 max-w-screen-sm text-md px-6 md:text-lg md:p-0"
                        style="text-shadow: 1px 1px 1px black;">
                        Discover the convenience of your local Sari-Sari store, where community meets essentials. From
                        everyday household items to your favorite snacks and beverages, we’ve got you covered. Shop with
                        us and experience the warmth and service that’s just around the corner.
                    </p>
                    <Link :href="route('login')">
                    <PrimaryButton>
                        Get Started
                    </PrimaryButton>
                    </Link>

                </div>
            </div>
        </section>
        <!-- ---------------------------------------------------------------------------------------------------------------------------- -->
        <section class="hero bg-base-100 min-h-screen" style="text-shadow: 1px 1px 3px black;">
            <div
                class="grid grid-cols-1 place-items-center text-center space-y-6 md:grid-cols-2 md:text-start max-w-screen-lg mx-auto">
                <img src="storage/images/lolo_store.jpg" class="max-w-sm rounded-lg shadow-2xl" />
                <div>
                    <h2 class="text-3xl md:text-5xl font-bold">Your One-Stop <br> <span
                            class="text-accent tracking-wider">Sari-Sari
                            Store!</span></h2>
                    <p class="px-10 py-5 text-md md:text-lg md:px-0 md:py-6 max-w-screen-sm text-justify">
                        Discover a wide variety of everyday essentials at your trusted neighborhood Sari-Sari store!
                        From snacks and drinks to household items, we bring convenience right to your doorstep. Shop
                        with us for all your daily needs, delivered with a smile.
                    </p>
                </div>
            </div>
        </section>

        <!-- ---------------------------------------------------------------------------------------------------------------------------- -->
        <section class="hero bg-base-200 min-h-screen" style="text-shadow: 1px 1px 3px black;">
            <div
                class="grid grid-cols-1 place-items-center text-center space-y-6 md:grid-cols-2 md:text-start max-w-screen-lg mx-auto">
                <div>
                    <h2 class="text-3xl md:text-5xl font-bold">
                        I am
                        <span class="text-accent tracking-widest">Sari</span>
                        and this is my
                        <span class="text-accent tracking-widest">Store</span>.
                    </h2>
                    <p class="px-10 py-5 text-md md:text-lg md:px-0 md:py-6 md:pe-5 max-w-screen-sm text-justify">
                        I built this store from a small dream, with the goal of serving my community. Now, it's a place
                        where neighbors can find everything they need, from snacks to essentials—always with a personal
                        touch and a friendly smile.
                    </p>
                </div>
                <img src="storage/images/sari.jpg" class="max-w-md rounded-lg shadow-2xl h-[300px]" />
            </div>
        </section>
    </main>
    <!-- ---------------------------------------------------------------------------------------------------------------------------- -->
    <footer class="footer bg-base-100 text-base-content p-10">
        <aside>
            <svg width="50" height="50" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                clip-rule="evenodd" class="fill-current">
                <path
                    d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z">
                </path>
            </svg>
            <p>
                Sari-Store Industries Ltd.
                <br />
                Providing reliable supplies since 2015
            </p>
        </aside>
        <nav>
            <h6 class="footer-title">Products</h6>
            <a class="link link-hover">Snacks</a>
            <a class="link link-hover">Beverages</a>
            <a class="link link-hover">Household Items</a>
            <a class="link link-hover">Personal Care</a>
        </nav>
        <nav>
            <h6 class="footer-title">Store</h6>
            <a class="link link-hover">About Us</a>
            <a class="link link-hover">Contact</a>
            <a class="link link-hover">Store Hours</a>
            <a class="link link-hover">Our Story</a>
        </nav>
        <nav>
            <h6 class="footer-title">Customer Care</h6>
            <a class="link link-hover">Return Policy</a>
            <a class="link link-hover">Privacy Policy</a>
            <a class="link link-hover">Terms of Service</a>
        </nav>

    </footer>

</template>
