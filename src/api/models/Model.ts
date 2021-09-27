import { BaseEntity, DeepPartial, getConnection, ObjectType, PrimaryGeneratedColumn } from 'typeorm'
import { RelationMetadata } from 'typeorm/metadata/RelationMetadata'

export abstract class Model extends BaseEntity {
  @PrimaryGeneratedColumn()
  rowid!: number
}
