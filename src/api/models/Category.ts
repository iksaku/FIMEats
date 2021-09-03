import {Column, Entity, ManyToMany} from "typeorm";
import {Product} from "./Product";
import {Model} from "./Model";

@Entity({ name: 'categories' })
export class Category extends Model {
  @Column('varchar', { length: 255 })
  name!: string

  @ManyToMany(() => Product, product => product.categories)
  products?: Product[]

  static searchable_columns(): string[] {
    return ['name']
  }
}
