import {Column, Entity, JoinColumn, JoinTable, ManyToMany, ManyToOne} from "typeorm";
import {Cafeteria} from "./Cafeteria";
import {Category} from "./Category";
import {Model} from "./Model";

@Entity({ name: 'products' })
export class Product extends Model {
  @Column('varchar', { length: 255 })
  name!: string

  @Column('tinyint', { unsigned: true })
  quantity!: number

  @Column('decimal', { precision: 5, scale: 2, unsigned: true })
  price!: number

  @Column('varchar', { length: 255, nullable: true })
  image!: string

  @ManyToOne(() => Cafeteria, cafeteria => cafeteria.products)
  @JoinColumn({ name: 'cafeteria_id' })
  cafeteria?: Cafeteria

  @ManyToMany(() => Category, category => category.products)
  @JoinTable({ name: 'category_product', joinColumn: { name: 'product_id' }, inverseJoinColumn: { name: 'category_id' } })
  categories?: Category[]

  static searchable_columns(): string[] {
    return ['name']
  }
}
