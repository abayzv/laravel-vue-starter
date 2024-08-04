<script setup lang="ts">
import Card from './Card.vue';
import { Icon } from '@iconify/vue'

withDefaults(defineProps<{
    label: string,
    value: number,
    icon: string
}>(), {})

</script>
<template>
    <Card>
        <div class="flex gap-5 items-center">
            <div class="size-16 bg-primary text-white flex items-center justify-center rounded">
                <Icon :icon="icon" width="30" />
            </div>
            <div>
                <h5 class="text-xl text-neutral-500">{{ label }}</h5>
                <div class="text-3xl font-bold">{{ value }}</div>
            </div>
        </div>
    </Card>
</template>