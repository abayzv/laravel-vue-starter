<script setup lang="ts">
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import Datatable from '@/Components/Datatable/Index.vue';
import { Head } from '@inertiajs/vue3';
import type { DatatableOptions } from '@/types/datatable';
import { computed } from 'vue';

const props = defineProps({
    data: Object,
    filters: Object,
    search: Object
})

const data = computed(() => {
    return {
        data: props.data?.data,
        column: ['name', 'license_plate', 'trips_count'],
        labels: {
            name: 'Nama',
            license_plate: 'Plat Nomor',
            trips_count: 'Total Trip'
        },
        format: {},
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
        filters: props.filters,
        search: {
            default: {
                search_by: props.search?.data.search_by || '',
                query: props.search?.data.query
            },
            options: [
                {
                    label: 'Nama',
                    value: 'name'
                }
            ]
        }
    } as DatatableOptions
})
</script>

<template>

    <Head title="Vehicle" />

    <DefaultLayout>
        <div class="py-6">
            <div class="mx-auto sm:px-6 lg:px-8">
                <Datatable :data="data">
                    <template #title>
                        Management Vehicle
                    </template>
                </Datatable>
            </div>
        </div>
    </DefaultLayout>
</template>
