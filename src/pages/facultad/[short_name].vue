<template>
  <template v-if="!faculty">
    <!-- TODO: 404 -->
  </template>

  <template v-else>
    <!-- TODO: Map -->

    <Card v-for="cafeteria in faculty?.cafeterias">
      <div class="w-full text-center mb-6">
        <h2 class="text-gray-700 text-2xl">
          {{ cafeteria.name }}
        </h2>
      </div>

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <div v-for="product in cafeteria.products" class="group col-span-1 p-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-xl border">
          <!-- TODO: On click open modal with price comparison -->
          <div class="h-full w-full flex flex-col justify-between">
            <div class="w-full overflow-hidden rounded-lg relative flex-grow-1">
              <img :src="product.image" :alt="`Imagen representativa de ${product.name}`" class="h-32 mx-auto rounded-lg" />
            </div>
            <div class="mt-4">
              <div class="flex">
                <div class="overflow-hidden w-full flex-grow-1">
                  <p :title="product.name" class="font-semibold whitespace-nowrap overflow-ellipsis w-full overflow-hidden">
                    {{ product.name }}
                  </p>
                  <p class="text-gray-500 dark:text-gray-200">
                    {{ currencyFormatter.format(product.price) }}
                  </p>
                </div>
                <div v-if="product.categories" class="ml-4 pt-0.5 flex-shrink-0">
                  <div class="w-auto h-auto px-1 py-0.5 rounded-lg bg-yellow-200 text-sm lig">
                    {{ product.categories[0].name }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Card>
  </template>
</template>

<script lang="ts">
  import { computed, defineComponent, PropType, ref } from 'vue'
  import { useMetadata } from '@/api/metadata'
  import { Faculty } from '@/api/models'
  import Card from '@/components/Card.vue'

  export default defineComponent({
    name: 'Faculty',
    components: { Card },
    props: {
      short_name: {
        type: String as PropType<string>,
        required: true,
      },
    },

    setup(props) {
      const faculty = ref<Faculty | null>(null)
      const meta = useMetadata()
      const currencyFormatter = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN',
      })

      function updateMetadata(): void {
        meta.set({
          title: faculty.value?.name ?? props.short_name,
          description: null,
        })
      }

      updateMetadata()

      Faculty.findOne({
        where: { short_name: props.short_name },
        relations: ['cafeterias', 'cafeterias.products', 'cafeterias.products.categories'],
      }).then((model: Faculty | undefined) => {
        faculty.value = model ?? null
        updateMetadata()
      })

      return {
        faculty,
        currencyFormatter,
      }
    },
  })
</script>

<route>
{
  name: 'faculty',
}
</route>
