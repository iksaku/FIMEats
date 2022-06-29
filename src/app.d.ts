/// <reference types="@sveltejs/kit" />

// See https://kit.svelte.dev/docs/types#the-app-namespace
// for information about these interfaces
declare namespace App {
    // interface Locals {}
    // interface Platform {}
    // interface Session {}
    // interface Stuff {}
}

declare module 'knex/types/tables' {
    interface IModel {
        id: number
    }

    interface IFaculty extends IModel {
        name: string
        short_name: string
    }

    interface ICafeteria extends IModel {
        faculty_id: number
        name: string
    }

    interface IProduct extends IModel {
        cafeteria_id: number
        name: string
        price: number
        quantity?: number
        image?: string
    }

    interface ICategory extends IModel {
        name: number
    }

    interface IPivotCategoryProduct {
        category_id: number
        product_id: number
    }

    interface Tables {
        faculties: IFaculty
        cafeterias: ICafeteria
        products: IProduct
        categories: ICategory
        category_product: IPivotCategoryProduct
    }
}
