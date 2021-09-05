import {BaseEntity, DeepPartial, getConnection, ObjectType, PrimaryGeneratedColumn} from "typeorm";
import {RelationMetadata} from "typeorm/metadata/RelationMetadata";

export abstract class Model extends BaseEntity {
  @PrimaryGeneratedColumn()
  rowid!: number

  async load(relations: string|string[]): Promise<this> {
    const model = this.constructor.name
    const connection = getConnection()
    const { relations: availableRelations } = connection.getMetadata(model)

    if (! Array.isArray(relations)) {
      relations = [relations]
    }

    for (const relation of relations) {
      const relationData = availableRelations.find((o: RelationMetadata) => o.propertyName === relation)

      if (! relationData) {
        throw new Error(`Relationship '${relation}' could not be found on relation '${model}'.`)
      }

      const { relationType } = relationData

      const queryBuilder = connection.manager
        .createQueryBuilder()
        .relation(model, relation)
        .of(this)

      if (['one-to-one', 'many-to-one'].includes(relationType)) {
        // @ts-ignore
        this[relation] = await queryBuilder.loadOne()
        continue
      }

      if (['one-to-many', 'many-to-many'].includes(relationType)) {
        // @ts-ignore
        this[relation] = await queryBuilder.loadMany()
        continue;
      }

      throw new Error(`Unknown relationship type '${relationType}' on '${model}.${relation}'.`)
    }

    return this
  }

  static searchable_columns(): string[] {
    return []
  }

  static searchable(): boolean {
    return this.searchable_columns().length > 0
  }
}
