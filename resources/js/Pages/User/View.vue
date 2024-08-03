<script setup lang="ts">
import Card from '@/Components/Card.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    users: Object
})
</script>

<template>

    <Head title="Users" />

    <DefaultLayout>
        <div class="py-6">
            <div class="mx-auto sm:px-6 lg:px-8">
                <Card>
                    <div class="text-gray-900 dark:text-gray-100">You're logged in!</div>
                </Card>
            </div>
        </div>
    </DefaultLayout>
</template>
