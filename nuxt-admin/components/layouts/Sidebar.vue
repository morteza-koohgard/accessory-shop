<template>
    <div class="w-full grid grid-cols-1 gap-y-2 p-4">
        <NuxtLink v-for="item in sidebarItems" :key="item" :to="item.link" class="w-full text-sky-700 dark:text-gray-200 hover:bg-sky-200 hover:text-sky-800 dark:hover:bg-sky-700 dark:hover:text-sky-300 rounded-md p-2">
            {{ item.title }}
        </NuxtLink>
    </div>
</template>

<script setup>
const sidebarItems = reactive([
    {
        title: 'Dashboard',
        link: '/'
    },
    {
        title: 'Users',
        link: '/users'
    },
    {
        title: 'Products',
        link: '/posts'
    },
    {
        title: 'Product categories',
        link: '/product-categories'
    },
    {
        title: 'Product categories',
        link: '/product-categories'
    },
    {
        title: 'Product images',
        link: '/product-images'
    },
])
</script>