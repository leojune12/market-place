<script setup>
    import { Link } from '@inertiajs/inertia-vue3'

    defineProps({
        href: {
            type: String,
            default: '/',
        },
        type: {
            type: String,
            default: 'primary',
        },
    });

    const classes = {
        primary: 'flex justify-center items-center px-4 h-10 bg-blue-600 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-700 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-blue-700 transition ease-in-out duration-150',
        success: 'flex justify-center items-center px-4 h-10 bg-green-600 dark:bg-green-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-green-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700 dark:focus:bg-white active:bg-green-700 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-green-700 transition ease-in-out duration-150',
        secondary: 'flex justify-center items-center px-4 h-10 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150',
    }
</script>

<template>
    <Link
        :href="href"
        :type="type"
        :class="classes[type]"
    >
        <slot />
    </Link>
</template>
