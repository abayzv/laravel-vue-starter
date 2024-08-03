<script setup lang="ts">
import Button from "primevue/button";
// import Select from 'primevue/select';
import Popover from "primevue/popover";
import { PropType, watch } from "vue";
import { ref } from "vue";
import type { Filters } from "@/types/datatable";
import { router } from '@inertiajs/vue3'

const props = defineProps({
    filters: {
        type: Object as PropType<Filters>,
        required: true
    }
})

const op = ref();

const toggle = (event: any) => {
    op.value.toggle(event);
}

const filter = ref<any>({})

const reset = () => {
    router.visit(route(route().current() || ''))
}

const getFilter = () => {
    router.get('', filter.value)
}

const handleUpdateSelect = (e: any, target: any) => {
    filter.value[target] = e.target.value
}

// watch(() => filter.value, (val) => {
//     router.get('', val)
// }, { deep: true })
</script>

<template>
    <div class="card flex justify-center">
        <Button type="button" size="small" icon="pi pi-filter" label="Filter" @click="toggle" severity="secondary" />

        <Popover ref="op">
            <div class="flex flex-col gap-4 w-[25rem] p-3">
                <div v-for="item in filters?.data">
                    <span class="font-medium block mb-2">{{ item.label }}</span>
                    <select v-if="item.type == 'select'"
                        class="w-full rounded border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-400"
                        @change="(e) => handleUpdateSelect(e, item.name)" :value="filters.default[item.name] || ''">
                        <option :value="''" readonly disabled>Pilih {{ item.label }}</option>
                        <option v-for="data in item.data" :value="data.value">
                            {{ data.label }}
                        </option>
                    </select>
                    <input v-else type="date" :value="filters.default[item.name]"
                        @change="(e) => handleUpdateSelect(e, item.name)"
                        class="w-full rounded border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-400" />
                </div>
                <div class="flex gap-2">
                    <Button class="w-full" type="button" size="small" icon="pi pi-filter" label="Submit"
                        severity="secondary" @click="getFilter" />
                    <Button class="w-full" type="button" size="small" icon="pi pi-times" label="Reset"
                        severity="secondary" @click="reset" />
                </div>
            </div>
        </Popover>
    </div>
</template>
