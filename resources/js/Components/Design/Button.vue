<script setup lang="ts">
import Button from 'primevue/button';
</script>

<template>
    <div class="mt-5 space-y-3">
        <div class="flex gap-5 items-end">
            <Button label="Primary" />
            <Button label="Secondary" severity="secondary" />
            <Button label="Success" severity="success" />
            <Button label="Info" severity="info" />
            <Button label="Warn" severity="warn" />
            <Button label="Help" severity="help" />
            <Button label="Danger" severity="danger" />
            <Button label="Contrast" severity="contrast" />
        </div>
        <div class="flex gap-5 items-end">
            <Button label="Primary" rounded />
            <Button label="Secondary" severity="secondary" rounded />
            <Button label="Success" severity="success" rounded />
            <Button label="Info" severity="info" rounded />
            <Button label="Warn" severity="warn" rounded />
            <Button label="Help" severity="help" rounded />
            <Button label="Danger" severity="danger" rounded />
            <Button label="Contrast" severity="contrast" rounded />
        </div>
        <div class="flex gap-5 items-end">
            <Button label="Primary" outlined />
            <Button label="Secondary" severity="secondary" outlined />
            <Button label="Success" severity="success" outlined />
            <Button label="Info" severity="info" outlined />
            <Button label="Warn" severity="warn" outlined />
            <Button label="Help" severity="help" outlined />
            <Button label="Danger" severity="danger" outlined />
            <Button label="Contrast" severity="contrast" outlined />
        </div>
        <div class="flex gap-5 items-end">
            <Button icon="pi pi-check" aria-label="Filter" />
            <Button icon="pi pi-bookmark" severity="secondary" aria-label="Bookmark" />
            <Button icon="pi pi-search" severity="success" aria-label="Search" />
            <Button icon="pi pi-user" severity="info" aria-label="User" />
            <Button icon="pi pi-bell" severity="warn" aria-label="Notification" />
            <Button icon="pi pi-heart" severity="help" aria-label="Favorite" />
            <Button icon="pi pi-times" severity="danger" aria-label="Cancel" />
            <Button icon="pi pi-star" severity="contrast" aria-label="Star" />
        </div>
    </div>
</template>