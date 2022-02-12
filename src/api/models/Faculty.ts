import { Column, Entity, JoinColumn, OneToMany } from 'typeorm'
import { Cafeteria } from './Cafeteria'
import { Model } from './Model'

@Entity({ name: 'faculties' })
export class Faculty extends Model {
  @Column('varchar', { length: 255 })
  name!: string

  @Column('varchar', { length: 255 })
  short_name!: string

  @Column('varchar', { length: 255, nullable: true })
  logo!: string

  @Column('varchar', { length: 255, nullable: true })
  maps_url!: string

  @OneToMany(() => Cafeteria, (cafeteria) => cafeteria.faculty)
  @JoinColumn({ name: 'cafeteria_id' })
  cafeterias?: Cafeteria[]

  static searchable_columns(): string[] {
    return ['name', 'short_name']
  }

  get logoUrl(): string {
    return new URL(`../../assets/logos/${this.logo}`, import.meta.url).href
  }
}
