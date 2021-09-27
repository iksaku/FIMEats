import { Column, Entity, JoinColumn, ManyToOne, OneToMany } from 'typeorm'
import { Faculty } from './Faculty'
import { Product } from './Product'
import { Model } from './Model'

@Entity({ name: 'cafeterias' })
export class Cafeteria extends Model {
  @Column('varchar', { length: 255 })
  name!: string

  @Column('unsigned big int')
  faculty_id!: number

  @ManyToOne(() => Faculty, (faculty) => faculty.cafeterias)
  @JoinColumn({ name: 'faculty_id' })
  faculty?: Faculty

  @OneToMany(() => Product, (product) => product.cafeteria)
  products?: Product[]

  static searchable_columns(): string[] {
    return ['name']
  }
}
