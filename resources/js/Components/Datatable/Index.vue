<script setup lang="ts">
import Card from '@/Components/Card.vue';
import DatatableRow from '@/Components/Datatable/Row.vue'
import DatatableHeader from '@/Components/Datatable/Header.vue'
import DatatableData from '@/Components/Datatable/Data.vue'
import DatatableFilter from '@/Components/Datatable/Filter.vue'
import SplitButton from 'primevue/splitbutton';
import { PropType } from 'vue';
import { DatatableOptions } from '@/types/datatable';
import Pagination from '@/Components/Pagination.vue';
import { router } from '@inertiajs/vue3'

const props = defineProps({
    data: {
        type: Object as PropType<DatatableOptions>,
        required: true
    }
})

const formatValue = (value: any, key: any, item: any) => {
    if (props.data?.format && typeof props.data?.format[key] === 'function') {
        return props.data?.format[key](value, item);
    }
    return value;
}

const itemAction = (item: any) => {
    return props.data?.actions?.map((action: any) => ({
        label: action.label,
        icon: action.icon,
        command: () => action.command(item)
    }))
}

const handleUpdatePage = (evt: any) => {
    router.visit(evt)
}

</script>

<template>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <!-- Header -->
        <div class="border-b dark:border-b-gray-700 flex items-center justify-between p-2 sm:p-4">
            <h1 class="font-bold text-xl">
                <slot name="title" />
            </h1>
            <DatatableFilter :filters="props.data?.filters" />
        </div>

        <!-- Body -->
        <div>
            <table class="table">
                <thead>
                    <DatatableRow>
                        <DatatableHeader>
                            #
                        </DatatableHeader>
                        <DatatableHeader v-for="item in data?.column">
                            {{ data?.labels[item] || item }}
                        </DatatableHeader>
                        <DatatableHeader class="text-end">
                            Action
                        </DatatableHeader>
                    </DatatableRow>
                </thead>
                <tbody>
                    <DatatableRow v-for="(item, index) in data?.data">
                        <DatatableData>
                            {{ props.data?.meta.from + index }}.
                        </DatatableData>
                        <DatatableData v-for="(key, indexKey) in data?.column">
                            <span v-html="formatValue(item[key], key, item)"></span>
                        </DatatableData>
                        <DatatableData class="text-end">
                            <SplitButton size="small" label="Action" :model="itemAction(item)" severity="secondary" />
                        </DatatableData>
                    </DatatableRow>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="border-t dark:border-t-gray-700 p-2 sm:p-4">
            <Pagination :links="props.data?.links" :meta="props.data?.meta" @page-changed="handleUpdatePage" />
        </div>
    </div>
</template>

<style scoped>
.table {
    width: 100%;
    border-collapse: collapse;
}
</style>