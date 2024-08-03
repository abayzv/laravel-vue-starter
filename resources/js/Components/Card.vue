<script setup lang="ts"></script>
<template>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <!-- Header -->
        <div v-if="$slots.header" class="border-b dark:border-b-gray-700 p-2 sm:p-4">
            <slot name="header" />
        </div>

        <!-- Body -->
        <div class="p-4 sm:p-8">
            <slot />
        </div>

        <!-- Footer -->
        <div v-if="$slots.footer" class="border-t dark:border-t-gray-700 p-2 sm:p-4">
            <slot name="footer" />
        </div>
    </div>
</template>