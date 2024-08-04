<script setup lang="ts">
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import Datatable from '@/Components/Datatable/Index.vue';
import { Head } from '@inertiajs/vue3';
import type { DatatableOptions } from '@/types/datatable';
import { computed } from 'vue';
import toTitleCase from '@/Utils/toTitleCase';
import formatDate from '@/Utils/formatDate';

const props = defineProps({
    data: Object,
    filters: Object,
})

const data = computed(() => {
    return {
        data: props.data?.data,
        column: ['outlet', 'quantity', 'price', 'total', 'paid_status', 'payment_method', 'created_at'],
        labels: {
            outlet: 'Nama Outlet',
            quantity: 'Stock Terjual',
            price: 'Harga',
            total: 'Total',
            paid_status: 'Status Pembayaran',
            payment_method: 'Pembayaran',
            created_at: 'Tanggal Input'
        },
        format: {
            outlet: (val: any) => val.name,
            price: (val: any) => `Rp. ${Number(val).toLocaleString()}`,
            total: (val: any, item: any) => `Rp. ${(Number(item.quantity) * Number(item.price)).toLocaleString()}`,
            paid_status: (val: any) => {
                switch (val) {
                    case 0:
                        return `<span class="bg-red-500 py-2 px-5 text-white rounded-lg text-sm">Belum dibayar</span>`
                    case 1:
                        return `<span class="bg-green-500 py-2 px-5 text-white rounded-lg text-sm">Lunas</span>`
                }
            },
            payment_method: (val: any, item: any) => item.paid_status ? toTitleCase(val) : '-',
            created_at: (val: any) => formatDate(val)
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
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <Datatable :data="data">
                    <template #title>
                        Drop List
                    </template>
                </Datatable>
            </div>
        </div>
    </DefaultLayout>
</template>
