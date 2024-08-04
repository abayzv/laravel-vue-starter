<script setup lang="ts">
import Button from 'primevue/button';
import { onMounted, ref } from 'vue';

const props = withDefaults(defineProps<{
    name: string,
    modelValue: any,
    options?: {
        label: string,
        value: string
    }[]
    default: {
        search_by: string,
        query: any
    },
    interval: number
}>(), {
    name: 'query',
    interval: 700
})

const emit = defineEmits(['update:modelValue', 'submit'])

const searchBy = ref(props.default?.search_by || props.options?.[0].value || props.name)
const inputValue = ref(props.default?.query)
const inputRef = ref<HTMLInputElement | null>(null)

const debounce = (func: (...args: any[]) => void, wait: number) => {
    let timeout: ReturnType<typeof setTimeout>;
    return (...args: any[]) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => func(...args), wait);
    };
};

const handleUpdate = debounce((e: any) => {
    emit('update:modelValue', { search_by: searchBy.value, query: e.target.value })
}, props.interval);

const handleInput = (e: Event) => {
    const target = e.target as HTMLInputElement;
    inputValue.value = target.value;
    handleUpdate(e);
}

const handleSubmit = (e: any) => {
    emit('submit')
}

onMounted(() => {
    if (inputRef.value) {
        if (props.default.search_by) {
            inputRef.value.focus();
        }
    }
});
</script>

<template>
    <form @submit.prevent="handleSubmit" class="flex gap-2">
        <div class="flex border rounded-lg overflow-clip w-full">
            <select v-if="options?.length" v-model="searchBy"
                class="border-none focus:border-none focus:ring-0 focus:outline-none bg-gray-50">
                <option v-for="item in options" :value="item.value">{{ item.label }}</option>
            </select>
            <input ref="inputRef" :value="inputValue" @input="handleInput"
                class="border-none focus:border-none focus:ring-0 focus:outline-none" placeholder="Search..."
                type="text" />
        </div>
        <Button @click="handleSubmit" icon="pi pi-search" size="small" severity="secondary" />
    </form>
</template>
