<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    customers: Object
});
</script>
<template>
    <AppLayout title="Best Customers">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Best Customers
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div v-for="customer in customers" :key="customer.id" class="bg-white rounded-lg">
                        <!-- Card header -->
                        <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap justify-center sm:justify-between text-gray-500">
                            <!-- Customer Name -->
                            <div class="w-full mb-2 sm:w-1/2 md:w-1/4">
                                <label class="font-bold text-gray-700 text-sm">NAME</label>
                                <div class="sm:text-sm md:text-base"><Link :href="route('customers.show', customer.id)">{{ customer.name }}</Link></div>
                            </div>
                            <!-- Email -->
                            <div class="w-full mb-2 sm:w-1/2 md:w-1/3 overflow-hidden">
                                <label class="font-bold text-gray-700 text-sm">EMAIL</label>
                                <div class="sm:text-sm md:text-base">{{ customer.email }}</div>
                            </div>
                            <!-- Order Count -->
                            <div class="w-full mb-2 sm:w-1/2 md:w-1/6">
                                <label class="font-bold text-gray-700 text-sm">ORDERS</label>
                                <div class="sm:text-sm md:text-base">{{ customer.order_count }}</div>
                            </div>
                            <!-- Total -->
                            <div class="w-full mb-2 sm:w-1/2 md:w-1/6">
                                <label class="font-bold text-gray-700 text-sm">TOTAL</label>
                                <div class="sm:text-sm md:text-base">{{ customer.order_total }}</div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </AppLayout>
</template>
