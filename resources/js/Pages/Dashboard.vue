<script setup lang="ts">
import Card from '@/Components/Card.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import type { DashboardData } from '@/types/dashboard';
import { computed, PropType, reactive, ref, watch } from 'vue';
import DatePicker from 'primevue/datepicker';
import Option from '@/Components/Option.vue';
import { Icon } from '@iconify/vue'
import CardInfo from '@/Components/CardInfo.vue';

const props = defineProps({
    data: Object as PropType<DashboardData>,
    query: Object
})

const state = reactive({
    tripEntryChartFilter: [
        {
            label: 'Weekly',
            value: 'weekly'
        },
        {
            label: 'Monthly',
            value: 'monthly'
        }
    ]
})

const filter = ref({
    tripEntryChart: {
        filter: props.query?.filter || 'weekly',
        month: props.query?.month || ''
    },
    driverDropChart: {
        driver_filter: props.query?.driver_filter || 'weekly',
        driver_month: props.query?.driver_month || ''
    }
})

const cardInfoData = computed(() => {
    return [
        {
            label: 'Total Trip',
            value: props.data?.totalTrips || 0,
            icon: 'mdi:truck-delivery'
        },
        {
            label: 'Total Outlet',
            value: props.data?.totalOutlets || 0,
            icon: 'mdi:store'
        },
        {
            label: 'Total Kendaraan',
            value: props.data?.totalVehicles || 0,
            icon: 'mdi:car'
        },
        {
            label: 'Total Driver',
            value: props.data?.totalDrivers || 0,
            icon: 'mdi:account'
        },
    ]
})

const tripEntryChartOption = computed(() => {
    return {
        options: {
            chart: {
                id: 'trip-entry-chart',
                stacked: true,
            },
            xaxis: {
                categories: props.data?.tripEntryCharts.categories,
                labels: {
                    rotate: 0,
                    alwaysRotate: true,
                    hideOverlappingLabels: true,
                },
                tickAmount: 4
            }
        },
        series: props.data?.tripEntryCharts.series
    }
})

// const driverDropChartOption = computed(() => {
//     return {
//         options: {
//             chart: {
//                 id: 'driver-drop-chart',
//                 type: 'bar',
//                 stacked: true,
//             },
//             xaxis: {
//                 categories: props.data?.driverDropCharts.categories
//             },
//             plotOptions: {
//                 bar: {
//                     horizontal: true
//                 }
//             }
//         },
//         series: props.data?.driverDropCharts.series
//     }
// })

watch(() => filter.value.tripEntryChart.filter, (val) => {
    router.get('', { filter: val })
})

watch(() => filter.value.tripEntryChart.month, (val) => {
    if (val && val !== '') {
        const date = new Date(val)
        const month = date.getMonth() + 1
        const year = date.getFullYear()

        router.get('', { month: `${year}-${month}` })
    }
})

watch(() => filter.value.driverDropChart.driver_filter, (val) => {
    router.get('', { driver_filter: val })
})

watch(() => filter.value.driverDropChart.driver_month, (val) => {
    if (val && val !== '') {
        const date = new Date(val)
        const month = date.getMonth() + 1
        const year = date.getFullYear()

        router.get('', { driver_month: `${year}-${month}` })
    }
})
</script>

<template>

    <Head title="Dashboard" />

    <DefaultLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-6">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-4 gap-5">
                    <CardInfo v-for="item in cardInfoData" :icon="item.icon" :label="item.label" :value="item.value" />
                </div>

                <div class="grid grid-cols-4 gap-5 mt-5">
                    <!-- Trip Entry Chart -->
                    <Card class="col-span-3">
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-lg font-bold">Drop List Graph</h2>
                            <div class="flex gap-2">
                                <DatePicker v-if="filter.tripEntryChart.filter === 'monthly'"
                                    v-model="filter.tripEntryChart.month" showIcon view="month" dateFormat="yy-mm">
                                </DatePicker>
                                <Option v-model="filter.tripEntryChart.filter" :options="state.tripEntryChartFilter" />
                            </div>
                        </div>
                        <apexchart width="100%" height="450" type="bar" :options="tripEntryChartOption.options"
                            :series="tripEntryChartOption.series"></apexchart>
                    </Card>
                    <!-- Driver Drop Chart -->
                    <!-- <Card>
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-lg font-bold">Driver Performance Graph</h2>
                            <div class="flex gap-2">
                                <DatePicker v-if="filter.driverDropChart.driver_filter === 'monthly'"
                                    v-model="filter.driverDropChart.driver_month" showIcon view="month"
                                    dateFormat="yy-mm">
                                </DatePicker>
                                <Option v-model="filter.driverDropChart.driver_filter"
                                    :options="state.tripEntryChartFilter" />
                            </div>
                        </div>
                        <apexchart width="100%" type="bar" :options="driverDropChartOption.options"
                            :series="driverDropChartOption.series"></apexchart>
                    </Card> -->
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
