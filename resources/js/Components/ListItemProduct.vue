<script setup>
import { Link } from '@inertiajs/vue3';

defineProps(['product'])
</script>

<template>
    <article class="flex items-center space-x-6 p-2">
        <Link :href="route('products.show', { id: product.id })">
            <img :src="product.image_url" alt="" width="60" class="flex-none bg-slate-100" />
        </Link>
        <div class="min-w-0 relative flex items-center flex-auto">
            <Link :href="route('products.show', { id: product.id })">
                <h2 class="truncate pr-20">{{ product.name }}</h2>
            </Link>
            <dl class="mt-2 flex flex-wrap text-sm leading-6 font-medium">
                <div class="absolute top-0 right-0 flex items-center space-x-1">
                    <dt class="text-grey-500">
                        <span class="sr-only">Sold in last seven days</span>
                    </dt>
                    <dd class="quantity">{{product.total_quantity}} sold</dd>
                </div>
            </dl>
        </div>
    </article>
</template>
