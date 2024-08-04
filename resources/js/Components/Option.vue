<script setup lang="ts">
import Button from 'primevue/button';

const emit = defineEmits(['update:modelValue'])

withDefaults(defineProps<{
    modelValue: any,
    options: {
        label: string,
        value: string
    }[]
}>(), {})

const changeValue = (val: any) => {
    emit('update:modelValue', val)
}

</script>
<template>
    <div class="flex gap-2 bg-gray-200 p-1 rounded-xl">
        <Button v-for="item in options" :label="item.label" size="small" @click="changeValue(item.value)"
            :severity="`${modelValue === item.value ? 'contrast' : 'secondary'}`" />
    </div>
</template>