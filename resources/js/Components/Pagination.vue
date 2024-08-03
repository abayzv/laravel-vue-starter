<template>
    <nav v-if="meta">
        <ul class="pagination">
            <li :class="{ 'disabled': !meta.links[0].url }" class="page-item">
                <a class="page-link" href="#" @click.prevent="changePage(meta.links[0].url)"
                    v-html="meta.links[0].label"></a>
            </li>

            <li v-for="link in displayLinks" :key="link.label" :class="{ 'active': link.active, 'disabled': !link.url }"
                class="page-item">
                <a class="page-link" href="#" @click.prevent="changePage(link.url)" v-html="link.label"></a>
            </li>

            <li :class="{ 'disabled': !meta.links[meta.links.length - 1].url }" class="page-item">
                <a class="page-link" href="#" @click.prevent="changePage(meta.links[meta.links.length - 1].url)"
                    v-html="meta.links[meta.links.length - 1].label"></a>
            </li>
        </ul>
    </nav>
</template>

<script setup lang="ts">
import { computed, defineProps, defineEmits } from 'vue'

interface Link {
    url: string | null;
    label: string;
    active: boolean;
}

interface Meta {
    current_page: number;
    from: number;
    last_page: number;
    links: Link[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}

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
</script>

<style scoped>
.pagination {
    display: flex;
    list-style: none;
    padding-left: 0;
}

.page-item {
    margin: 0 2px;
}

.page-link {
    cursor: pointer;
}

.page-item.disabled .page-link {
    cursor: not-allowed;
}

.page-item.active .page-link {
    font-weight: bold;
}
</style>