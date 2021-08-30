export type FacultyMenu = {
  name: string
  short_name: string
  logo: string
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
  categories: Category[]
}

type Category = {
  name: string
}
