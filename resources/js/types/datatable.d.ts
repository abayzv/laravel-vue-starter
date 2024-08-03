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
    current_page: number;
    from: number;
    last_page: number;
    links: Link[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}

export interface Filters {
    [key: string]: any
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
    meta: Meta,
    filters?: Filter
}