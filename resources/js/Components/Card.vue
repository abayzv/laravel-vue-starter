<script setup lang="ts"></script>
<template>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <!-- Header -->
        <div v-if="$slots.header" class="border-b">
            <slot name="header" />
        </div>

        <!-- Body -->
        <div class="p-4 sm:p-8">
            <slot />
        </div>

        <!-- Footer -->
        <div v-if="$slots.footer">
            <slot name="footer" />
        </div>
    </div>
</template>