<script setup lang="ts">
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import Datatable from '@/Components/Datatable/Index.vue';
import { Head } from '@inertiajs/vue3';
import type { DatatableOptions } from '@/types/datatable';
import { computed, PropType } from 'vue';

const props = defineProps({
    data: Object,
    filters: Object,
})

const data = computed(() => {
    return {
        data: props.data?.data,
        column: ['name', 'role', 'created_at'],
        labels: {
            name: 'Nama',
            role: 'Role',
            created_at: 'Tanggal Pembuatan'
        },
        format: {
            created_at: (val: any) => new Date(val).toLocaleDateString(),
            role: (val: any) => {
                switch (val) {
                    case 'superadmin':
                        return `<span class="bg-purple-500 text-white py-2 px-5 rounded-full text-sm w-32 block text-center">${val}</span>`
                    case 'admin':
                        return `<span class="bg-sky-500 text-white py-2 px-5 rounded-full text-sm w-32 block text-center">${val}</span>`
                    case 'driver':
                        return `<span class="bg-yellow-500 text-white py-2 px-5 rounded-full text-sm w-32 block text-center">${val}</span>`
                    default:
                        return val
                }
            }
        },
        actions: [
            {
                label: 'Edit',
                icon: 'pi pi-pen-to-square',
                command: (item: any) => { console.log(item) }
            },
            {
                label: 'Delete',
                icon: 'pi pi-trash',
                command: (item: any) => { console.log(item) }
            }
        ],
        links: props.data?.links,
        meta: props.data?.meta,
        filters: props.filters
    } as DatatableOptions
})
</script>

<template>

    <Head title="Users" />

    <DefaultLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Datatable :data="data">
                    <template #title>
                        Management User
                    </template>
                </Datatable>
            </div>
        </div>
    </DefaultLayout>
</template>
