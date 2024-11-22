<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';
import moment from 'moment-timezone';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    customer: Object,
    orders: Object,
    topProduct: Object
});
</script>
<template>
    <AppLayout :title="'Customer: ' + customer.name">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Customer Detail
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-wrap">
                <div class="w-full sm:w-2/3 lg:w-1/2 bg-white shadow overflow-hidden sm:rounded-lg mb-4 flex flex-wrap">
                    <div class="w-full sm:w-1/2 px-6 sm:pr-1 py-4 mb-4 flex flex-wrap text-gray-500">
                        <div class="w-full mb-4">
                            <label class="font-bold text-gray-700 text-sm">NAME</label>
                            <div>{{ customer.name }}</div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="font-bold text-gray-700 text-sm">EMAIL</label>
                            <div>{{ customer.email }}</div>
                        </div>
                        <div class="w-full mb-4">
                            <label class="font-bold text-gray-700 text-sm">TOTAL PURCHASES</label>
                            <div>{{ customer.total }}</div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 px-6 sm:pl-1 py-4 mb-4 flex flex-wrap">
                        <label class="font-bold text-gray-700 text-sm">TOP PRODUCT <span>({{ topProduct.total_quantity }} ordered)</span></label>
                        <div class="w-full">
                            <Link :href="route('products.show', topProduct.id)">
                                <img :src="topProduct.image_url" class=" w-full mr-6 object-cover" alt="">
                            </Link>
                        </div>
                        <div class="w-full">
                            <Link :href="route('products.show', topProduct.id)" v-html="topProduct.name " />
                        </div>
                    </div>

                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div v-for="order in orders.data" :key="order.id" class="bg-white rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap text-gray-500">
                            <!-- Order ID -->
                            <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/5">
                                <label class="font-bold text-gray-700 text-sm">ORDER #</label>
                                <div><Link :href="route('orders.show', order.id)">{{ order.id }}</Link></div>
                            </div>
                            <!-- Order Placed -->
                            <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/5">
                                <label class="font-bold text-gray-700 text-sm">ORDER PLACED</label>
                                <div>{{ moment.utc(order.created_at).local().format('MMMM Do, YYYY') }}</div>
                            </div>
                            <!-- Items Ordered -->
                            <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/5">
                                <label class="font-bold text-gray-700 text-sm">ITEMS</label>
                                <div>{{ order.items.length }}</div>
                            </div>
                            <!-- Total -->
                            <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/5">
                                <label class="font-bold text-gray-700 text-sm">TOTAL</label>
                                <div>${{ order.total}}</div>
                            </div>
                            <!-- Status -->
                            <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/5">
                                <label class="font-bold text-gray-700 text-sm">STATUS</label>
                                <div>{{ order.status}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <Pagination :links="orders.links"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
