<script setup lang="ts">
import { computed, defineProps, withDefaults } from 'vue';
const props = withDefaults(defineProps<{
    variant: 'solid' | 'outline',
    color: 'primary' | 'success' | 'info' | 'danger' | 'warning' | 'gray',
    size: 'xs' | 'sm' | 'base' | 'lg' | 'xl'
}>(), {
    variant: 'solid',
    color: 'primary',
    size: 'base'
})

const color = computed(() => {
    switch (props.color) {
        case 'primary':
            return {
                bg: 'bg-primary',
                text: 'text-primary',
                border: 'border-primary',
                hoverbg: 'hover:bg-green-500'
            }
        case 'success':
            return {
                bg: 'bg-green-500',
                text: 'text-green-500',
                border: 'border-green-500',
                hoverbg: 'hover:bg-green-500'
            }
        case 'info':
            return {
                bg: 'bg-sky-500',
                text: 'text-sky-500',
                border: 'border-sky-500',
                hoverbg: 'hover:bg-sky-500'
            }
        case 'danger':
            return {
                bg: 'bg-red-500',
                text: 'text-red-500',
                border: 'border-red-500',
                hoverbg: 'hover:bg-red-500'
            }
        case 'warning':
            return {
                bg: 'bg-yellow-500',
                text: 'text-yellow-500',
                border: 'border-yellow-500',
                hoverbg: 'hover:bg-yellow-500'
            }
        case 'gray':
            return {
                bg: 'bg-gray-500',
                text: 'text-gray-500',
                border: 'border-gray-500',
                hoverbg: 'hover:bg-gray-500'
            }
    }
})

const size = computed(() => {
    switch (props.size) {
        case 'base':
            return 'text-base rounded-base p-2 px-5'
        case 'xs':
            return 'text-xs rounded-base py-1 px-5'
        case 'sm':
            return 'text-sm rounded-base py-1 px-5'
        case 'lg':
            return 'text-lg rounded-base py-3 px-6'
        case 'xl':
            return 'text-xl rounded-base py-4 px-8'
    }
})

const variant = computed(() => {
    switch (props.variant) {
        case 'solid':
            return `${size.value} flex items-center ${color.value?.bg} text-white hover:bg-opacity-80 disabled:cursor-not-allowed`
        case 'outline':
            return `${size.value} flex items-center border ${color.value?.border} ${color.value?.text} ${color.value?.hoverbg} hover:bg-opacity-10 disabled:cursor-not-allowed`
    }
})
</script>

<template>
    <button :class="variant" v-bind="$attrs">
        <slot />
    </button>
</template>