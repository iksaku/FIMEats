import { BaseEntity, PrimaryGeneratedColumn } from 'typeorm'

export abstract class Model extends BaseEntity {
  @PrimaryGeneratedColumn()
  rowid!: number
}
