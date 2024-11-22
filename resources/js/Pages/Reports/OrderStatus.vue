<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';
import moment from 'moment-timezone';

defineProps({
    orderStatusCounts: Object
});
</script>
<template>
    <AppLayout title="Order Status">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Order Status
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
                <div class="w-full sm:w-1/2 bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="text-left py-2 px-4 font-bold bg-gray-200 text-gray-600 border border-gray-300">Status</th>
                                <th class="text-left py-2 px-4 font-bold bg-gray-200 text-gray-600 border border-gray-300">Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(status, index) in orderStatusCounts" :key="index">
                                <td class="py-2 px-4 border border-gray-300">{{ status.status }}</td>
                                <td class="py-2 px-4 border border-gray-300">{{ status.count }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
