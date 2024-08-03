export interface Data {
    [key: string]: any
}

export interface FormatValue {
    [key: string]: (val: any, item: any) => any
}

export interface Links {
    first: string,
    last: string,
    next: string,
    prev: string
}

export interface Meta {
    current_page: string,
    from: number,
    last_page: number,
    per_page: number,
    total: number
}

export interface Action {
    label: string,
    icon?: string,
    command: (item: any) => void
}

export interface DatatableOptions {
    column: string[],
    labels: Data,
    data: Data[] | never[],
    format?: FormatValue,
    actions?: Action[],
    links: Links,
    meta: Meta
}