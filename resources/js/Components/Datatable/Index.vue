<script setup lang="ts">
import Card from '@/Components/Card.vue';
import DatatableRow from '@/Components/Datatable/Row.vue'
import DatatableHeader from '@/Components/Datatable/Header.vue'
import DatatableData from '@/Components/Datatable/Data.vue'
import DatatableFilter from '@/Components/Datatable/Filter.vue'
import SplitButton from 'primevue/splitbutton';
import { PropType, reactive, ref, watch } from 'vue';
import { DatatableOptions } from '@/types/datatable';
import Pagination from '@/Components/Pagination.vue';
import { router } from '@inertiajs/vue3'
import Search from '@/Components/Search.vue';

const props = defineProps({
    data: {
        type: Object as PropType<DatatableOptions>,
        required: true
    }
})

const searchValue = ref()

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

watch(() => searchValue.value, (val) => {
    router.get('', val)
}, { deep: true })
</script>

<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg sm:rounded-lg">
        <!-- Header -->
        <div class="border-b dark:border-b-gray-700 flex items-center justify-between p-5">
            <div>
                <h1 class="font-bold text-xl">
                    <slot name="title" />
                </h1>
            </div>
            <div class="flex gap-2">
                <Search v-if="props.data?.search" v-model="searchValue" :name="props.data?.search?.name"
                    :options="props.data?.search?.options" :default="props.data?.search.default" />
                <DatatableFilter v-if="Object.keys(props.data?.filters?.data || {}).length"
                    :filters="props.data?.filters" />
            </div>
        </div>

        <!-- Body -->
        <div class="overflow-x-auto">
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
                        <DatatableData v-for="(key, indexKey) in data?.column" class="min-w-52 sm:min-w-max">
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
        <div class="border-t dark:border-t-gray-700 p-5">
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