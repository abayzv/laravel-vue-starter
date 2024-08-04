export interface DashboardData {
    totalTrips: number,
    totalDrivers: number,
    totalVehicles: number,
    totalOutlets: number,
    tripEntryCharts: {
        categories: string[],
        series: {
            name: string,
            data: number[]
        }[]
    }
    driverDropCharts: {
        categories: string[],
        series: {
            name: string,
            data: number[]
        }[]
    }
}