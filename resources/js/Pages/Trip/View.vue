<script setup lang="ts">
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import Datatable from '@/Components/Datatable/Index.vue';
import { Head } from '@inertiajs/vue3';
import type { DatatableOptions } from '@/types/datatable';
import { computed } from 'vue';

const props = defineProps({
    data: Object,
    filters: Object,
})

const data = computed(() => {
    return {
        data: props.data?.data,
        column: ['driver', 'stock', 'departure_date', 'departure_time', 'vehicle'],
        labels: {
            driver: 'Driver',
            departure_date: 'Tanggal Berangkat',
            departure_time: 'Jam Berangkat',
            vehicle: 'Kendaraan',
            stock: 'Stock'
        },
        format: {
            driver: (val: any) => val.name,
            vehicle: (val: any) => val.name
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

    <Head title="Trips" />

    <DefaultLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Datatable :data="data">
                    <template #title>
                        Management Trip
                    </template>
                </Datatable>
            </div>
        </div>
    </DefaultLayout>
</template>
