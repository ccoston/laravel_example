<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    products: Object
});
</script>
<template>
    <AppLayout title="Products">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div v-if="products" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                        <template v-for="product in products.data" :key="product.id">
                            <div class="product-item overflow-hidden">
                                <Link :href="route('products.show', { id: product.id })" class="product-image">
                                    <img :src="product.image_url" class="h-40 w-full object-cover" alt="">
                                </Link>
                                <div class="p-4 mb-6">
                                    <Link :href="route('products.show', { id: product.id })" class="product-name">
                                        <h3 class="mb-2">{{ product.name }}</h3>
                                    </Link>
                                    <div class="product-price text-gray-500">${{ product.price }}</div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Pagination :links="products.links"/>
            </div>
        </div>
    </AppLayout>
</template>
