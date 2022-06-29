export type FacultyMenu = {
    name: string
    short_name: string
    maps_url: string
    cafeterias: Cafeteria[]
}

type Cafeteria = {
    name: string
    products: Product[]
}

type Product = {
    name: string
    quantity?: number
    price: number
    image?: string
    categories: string[]
}
