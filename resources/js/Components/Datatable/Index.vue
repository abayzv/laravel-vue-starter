<script setup lang="ts">
import Card from '@/Components/Card.vue';
import DatatableRow from '@/Components/Datatable/Row.vue'
import DatatableHeader from '@/Components/Datatable/Header.vue'
import DatatableData from '@/Components/Datatable/Data.vue'
import SplitButton from 'primevue/splitbutton';
import { PropType } from 'vue';
import { DatatableOptions } from '@/types/datatable';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    data: Object as PropType<DatatableOptions>
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
    console.log(evt)
}

const handleUpdateRow = (val: number) => {
    console.log(val, 'edit row')
}
</script>

<template>
    <Card>
        <template #header>
            <h1 class="font-bold text-xl">Management User</h1>
        </template>
        <table class="table">
            <thead>
                <DatatableRow>
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
                    <DatatableData v-for="(key, indexKey) in data?.column">
                        {{ formatValue(item[key], key, item) }}
                    </DatatableData>
                    <DatatableData class="text-end">
                        <SplitButton size="small" label="Action" :model="itemAction(item)" severity="secondary" />
                    </DatatableData>
                </DatatableRow>
            </tbody>
        </table>
        <template #footer>
            <!-- <Pagination :links="props.data?.links" :meta="props.data?.meta" /> -->
        </template>
    </Card>
</template>

<style scoped>
.table {
    width: 100%;
    border-collapse: collapse;
}
</style>