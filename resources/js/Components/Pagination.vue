<script setup lang="ts">
import { computed, defineProps, defineEmits } from 'vue'
import { Icon } from '@iconify/vue';
import type { Meta } from '@/types/datatable';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    links: {
        first: string;
        last: string;
        prev: string | null;
        next: string | null;
    },
    meta: Meta
}>()

const emit = defineEmits<{
    (e: 'page-changed', url: string): void
}>()

const displayLinks = computed(() => {
    if (!props.meta) return []

    const currentPage = props.meta.current_page
    const lastPage = props.meta.last_page

    let startPage = Math.max(currentPage - 3, 1)
    let endPage = Math.min(currentPage + 3, lastPage)

    if (endPage - startPage < 6) {
        if (currentPage < 5) {
            endPage = Math.min(startPage + 6, lastPage)
        } else {
            startPage = Math.max(endPage - 6, 1)
        }
    }

    return props.meta.links.slice(startPage, endPage + 1)
})

const changePage = (url: string | null) => {
    if (url) {
        emit('page-changed', url)
    }
}

const handleUpdatePerPage = (e: any) => {
    router.get('', { 'per_page': e.target.value })
}
</script>


<template>
    <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-center justify-between">
        <div class="text-neutral-500">
            Showing {{ meta.from }} to {{ meta.to }} of {{ meta.total }} data
        </div>
        <nav v-if="meta" class="flex gap-2">
            <select :value="meta.per_page"
                class="w-full rounded border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-400"
                @change="handleUpdatePerPage">
                <option v-for="data in ['5', '10', '25', '50']">
                    {{ data }}
                </option>
            </select>
            <ul class="pagination">
                <li :class="{ 'disabled': !links.first }" class="page-item">
                    <a class="page-link bg-gray-50 dark:bg-gray-700" @click.prevent="changePage(links.first)">
                        <Icon icon="mdi:chevron-double-left" />
                    </a>
                </li>
                <li :class="{ 'disabled': !meta.links[0].url }" class="page-item">
                    <a class="page-link bg-gray-50 dark:bg-gray-700" @click.prevent="changePage(meta.links[0].url)">
                        <Icon icon="mdi:chevron-left" />
                    </a>
                </li>

                <li v-for="link in displayLinks" :key="link.label"
                    :class="{ 'active': link.active, 'disabled': !link.url }" class="page-item">
                    <a class="page-link bg-gray-50 dark:bg-gray-700" @click.prevent="changePage(link.url)"
                        v-html="link.label"></a>
                </li>

                <li :class="{ 'disabled': !meta.links[meta.links.length - 1].url }" class="page-item">
                    <a class="page-link bg-gray-50 dark:bg-gray-700"
                        @click.prevent="changePage(meta.links[meta.links.length - 1].url)">
                        <Icon icon="mdi:chevron-right" />
                    </a>
                </li>
                <li :class="{ 'disabled': !links.last }" class="page-item">
                    <a class="page-link bg-gray-50 dark:bg-gray-700" @click.prevent="changePage(links.last)">
                        <Icon icon="mdi:chevron-double-right" />
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<style scoped>
.pagination {
    display: flex;
    list-style: none;
    padding-left: 0;
    align-items: center;
}

.page-item {
    margin: 0 2px;
}

.page-link {
    cursor: pointer;
    width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
}

.page-item.disabled .page-link {
    cursor: not-allowed;
}

.page-item.active .page-link {
    font-weight: bold;
    background-color: #262626;
    color: white;
}
</style>