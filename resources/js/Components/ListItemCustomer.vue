<script setup>
import { Link } from '@inertiajs/vue3';

defineProps(['customer'])
</script>

<template>
    <article class="flex items-start space-x-6 p-2">
        <div class="min-w-0 relative flex-auto text-gray-700">
            <h2 class="truncate pr-20"><Link :href="route('customers.show', customer.id)">{{ customer.name }}</Link></h2>
            <dl class="mt-2 flex flex-wrap text-sm leading-6 font-medium">
                <div class="absolute top-0 right-0 flex items-center space-x-1">
                    <dt class="text-gray-500">
                        <span class="sr-only">Total sales in last seven days</span>
                    </dt>
                    <dd class="total">${{customer.order_total}}</dd>
                </div>
            </dl>
        </div>
    </article>
</template>
