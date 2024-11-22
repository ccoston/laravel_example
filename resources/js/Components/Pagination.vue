<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array
});
</script>
<template>
    <div v-if="links.length > 3" class="pagination w-full mt-4">
        <div class="flex flex-wrap mb-2 justify-center items-center">
            <template v-for="(link, k) in links" :key="k">
                <div v-if="link.url === null"  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white" :class="{ 'active': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>

<style lang="scss">
    .pagination {
        a {
            color: grey;

            &.active {
                background-color: #ff0000;
                color: white;
            }
        }
    }
</style>

