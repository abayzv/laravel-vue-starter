<script setup lang="ts">
import Card from '@/Components/Card.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <DefaultLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto sm:px-6 lg:px-8">
                <Card>
                    <div class="text-gray-900 dark:text-gray-100">You're logged in!</div>
                </Card>
            </div>
        </div>
    </DefaultLayout>
</template>
