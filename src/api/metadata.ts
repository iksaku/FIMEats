import { reactive } from 'vue'

class Metadata {
  private readonly records: Record<string, unknown>

  public constructor() {
    this.records = reactive({})
  }

  public set(key: string | Record<string, any>, value: any = null): void {
    if (typeof key === 'string') {
      this.records[key] = value

      return
    }

    for (const [k, v] of Object.entries(key)) {
      this.set(k, v)
    }
  }

  public get(key: string): unknown {
    return this.records[key]
  }
}

const metadata = reactive(new Metadata())

export function useMetadata() {
  return metadata
}
