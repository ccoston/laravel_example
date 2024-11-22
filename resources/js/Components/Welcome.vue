<script setup>
import { Link } from '@inertiajs/vue3';
import List from './List.vue'
import ListItemCustomer from './ListItemCustomer.vue'
import ListItemProduct from './ListItemProduct.vue'

defineProps({
    latestOrdersCount: Number,
    topThreeProducts: Object,
    topThreeCustomers: Object
});
</script>

<template>
    <div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div id="OrdersContainer">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>

                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                        Orders in Past Seven Days
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 leading-relaxed">
                    There have been <span class="font-bold text-base text-slate-900">{{latestOrdersCount}}</span> orders in the past 7 days.
                </p>

                <p class="mt-4">
                    <Link :href="route('orders.index')" class="view-all-link inline-flex items-center font-semibold">
                        View all orders

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                </p>
            </div>

            <div id="ProductsContainer">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>

                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                        Top 3 Products In Last Seven Days
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 leading-relaxed">
                    <List>
                        <ListItemProduct v-for="product in topThreeProducts" :key="product.id" :product="product" />
                    </List>
                </p>

                <p class="mt-4">
                    <Link :href="route('products.index')" class="view-all-link inline-flex items-center font-semibold">
                        View all products

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                </p>
            </div>

            <div id="CustomersContainer">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>

                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                        Top Three Customers In Last Seven Days
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 leading-relaxed">
                    <List>
                        <ListItemCustomer v-for="customer in topThreeCustomers" :key="customer.id" :customer="customer" />
                    </List>
                </p>
                <p class="mt-4">
                    <Link :href="route('customers.index')" class="view-all-link inline-flex items-center font-semibold">
                        View all customers

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>
