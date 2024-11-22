<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';
import moment from 'moment-timezone';

defineProps({
    bestSellers: Object
});
</script>
<template>
    <AppLayout title="Best Sellers">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Best Sellers
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                    <div class="px-6 py-4">
                        <div class="divide-y divide-gray-200">
                            <div v-for="product in bestSellers" :key="product.id" class="flex items-center py-2">
                                <div class="w-1/2 flex items-center">
                                    <div class="w-auto float-left">
                                        <Link :href="route('products.show', product.id)">
                                            <img :src="product.image_url" class="h-10 w-auto mr-6 object-cover" alt="">
                                        </Link>
                                    </div>
                                    <div class="w-auto">
                                        <Link :href="route('products.show', product.id)" v-html="product.name " />
                                    </div>
                                </div>
                                <div class="w-1/4 text-right">
                                    <label class="text-gray-700 font-bold">Price</label>
                                    <div class="text-gray-500">${{ product.price }}</div>
                                </div>
                                <div class="w-1/4 text-right">
                                    <label class="text-gray-700 font-bold">Quantity Sold</label>
                                    <div class="text-gray-500">{{ product.total_quantity }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
