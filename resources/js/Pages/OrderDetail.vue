<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';
import moment from 'moment-timezone';

defineProps({
    order: Object
});
</script>
<template>
    <AppLayout :title="'Order: ' + order.id">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Order Detail
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                    <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap text-gray-500">
                        <!-- Order ID -->
                        <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/6 mb-2">
                            <label class="font-bold text-gray-700">Order #</label>
                            <div>{{ order.id }}</div>
                        </div>
                        <!-- Order Placed -->
                        <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/6 mb-2">
                            <label class="font-bold text-gray-700">Order Placed</label>
                            <div>{{ moment.utc(order.created_at).local().format('MMMM Do YYYY')}}</div>
                        </div>
                        <!-- Total -->
                        <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/6 mb-2">
                            <label class="font-bold text-gray-700">Total</label>
                            <div>{{ order.total}}</div>
                        </div>
                        <!-- Status -->
                        <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/6 mb-2">
                            <label class="font-bold text-gray-700">Status</label>
                            <div>{{ order.status}}</div>
                        </div>
                        <!-- Customer -->
                        <div class="w-full sm:w-1/2 md:w-1/5 lg:w-1/6 mb-2">
                            <label class="font-bold text-gray-700">Customer</label>
                            <div>
                                <Link :href="route('customers.show', order.customer.id)">{{ order.customer.name}}</Link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                    <div class="px-6 py-4">
                        <div class="font-bold mb-2">Products Ordered</div>
                        <div class="divide-y divide-gray-200">
                            <div v-for="item in order.items" :key="item.id" class="flex items-center py-2">
                                <div class="w-1/2 flex items-center">
                                    <div class="w-auto float-left">
                                        <Link :href="route('products.show', item.product.id)">
                                            <img :src="item.product.image_url" class="h-10 w-auto mr-6 object-cover" alt="">
                                        </Link>
                                    </div>
                                    <div class="w-auto">
                                        <Link :href="route('products.show', item.product.id)" v-html="item.product.name " />
                                    </div>
                                </div>
                                <div class="w-1/4 text-right">
                                    <label class="text-gray-700 font-bold">Price</label>
                                    <div class="text-gray-500">${{ item.product.price }}</div>
                                </div>
                                <div class="w-1/4 text-right">
                                    <label class="text-gray-700 font-bold">Quantity</label>
                                    <div class="text-gray-500">{{ item.quantity }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
