<script setup>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import { Link } from '@inertiajs/vue3';
    import moment from 'moment-timezone';
    import Pagination from "@/Components/Pagination.vue";

    defineProps({
        orders: Object
    });
</script>
<template>
    <AppLayout title="Orders">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="OrdersContainer" class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div v-for="order in orders.data" :key="order.id" class="order-row bg-white rounded-lg">
                        <!-- Card header -->
                        <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap justify-center sm:justify-start text-gray-500">
                            <!-- Order ID -->
                            <div class="w-full mb-2 sm:w-1/3  md:w-1/6 md:mb-0 lg:w-1/6">
                                <label class="font-bold text-gray-700 text-sm">ORDER #</label>
                                <div class="text-sm text-blue-600"><Link :href="route('orders.show', order.id)">{{ order.id }}</Link></div>
                            </div>
                            <!-- Status -->
                            <div class="w-full mb-2 sm:w-1/3  md:w-1/6 md:mb-0 lg:w-1/6">
                                <label class="font-bold text-gray-700 text-sm">STATUS</label>
                                <div >{{ order.status}}</div>
                            </div>
                            <!-- Customer Name -->
                            <div class="w-full mb-2 sm:w-1/3  md:w-1/6 md:mb-0 lg:w-1/6">
                                <label class="font-bold text-gray-700 text-sm">CUSTOMER</label>
                                <div >{{ order.customer.name}}</div>
                            </div>
                            <!-- Order Date -->
                            <div class="w-full mb-2 sm:w-1/3  md:w-1/6 md:mb-0 lg:w-1/6">
                                <label class="font-bold text-gray-700 text-sm">ORDER PLACED</label>
                                <div >{{ moment.utc(order.created_at).local().format('MMMM Do, YYYY') }}</div>
                            </div>
                            <!-- Items Ordered -->
                            <div class="w-full mb-2 sm:w-1/3  md:w-1/6 md:mb-0 lg:w-1/6">
                                <label class="font-bold text-gray-700 text-sm">ITEMS</label>
                                <div >{{ order.items.length }}</div>
                            </div>
                            <!-- Total -->
                            <div class="w-full mb-2 sm:w-1/3  md:w-1/6 md:mb-0 lg:w-1/6">
                                <label class="font-bold text-gray-700 text-sm">TOTAL</label>
                                <div >${{ order.total}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Pagination :links="orders.links"/>
            </div>
        </div>
    </AppLayout>
</template>
