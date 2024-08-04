<script setup lang="ts">
import { onMounted, onUpdated, ref } from 'vue';

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
    }
}>(), {
    name: 'query'
})

const emit = defineEmits(['update:modelValue'])

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
}, 300);

const handleInput = (e: Event) => {
    const target = e.target as HTMLInputElement;
    inputValue.value = target.value;
    handleUpdate(e);
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
    <div class="flex border rounded-lg overflow-clip w-full">
        <select v-if="options?.length" v-model="searchBy"
            class="border-none focus:border-none focus:ring-0 focus:outline-none bg-gray-50">
            <option v-for="item in options" :value="item.value">{{ item.label }}</option>
        </select>
        <input ref="inputRef" :value="inputValue" @input="handleInput"
            class="border-none focus:border-none focus:ring-0 focus:outline-none" placeholder="Search..." type="text" />
    </div>
</template>
