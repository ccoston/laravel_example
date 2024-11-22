<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    product: Object
});
</script>
<template>
    <AppLayout :title="product.name">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Product Detail
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 flex flex-col md:flex-row">
                    <div class="w-full md:w-1/2 px-3 mb-3">
                        <img :src="product.image_url" :alt="product.name">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <h1 class="font-large mb-6 text-3xl">
                            {{ product.name }}
                        </h1>
                        <div class="flex flex-col sm:flex-row justify-between content-end items-end mb-4">
                            <p class="w-100 sm:w-1/2 text-lg font-bold mb-2 sm:mb-0">${{ product.price }}</p>
                            <div class="w-100 sm:w-1/2 sm:text-right">
                                <p class="text-gray-500">
                                    <label class="text-gray-700 font-bold text-sm">SKU:</label> {{ product.sku }}
                                </p>
                                <p class="text-gray-500">
                                    <label class="text-gray-700 font-bold text-sm">SOLD IN LAST 7 DAYS:</label> {{product.lastSevenDaysCount}}
                                </p>
                            </div>
                        </div>
<!--                        <hr class="h-px mt-1 mb-4 bg-gray-200 border-0 dark:bg-gray-700">-->
                        <p class="text-gray-500">
                            {{ product.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
