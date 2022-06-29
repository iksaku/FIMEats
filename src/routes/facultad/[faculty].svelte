<script>
    import Card from '$components/Card.svelte'
    import Header from '../../components/Header.svelte'

    export let faculty

    export const currencyFormatter = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN'
    })
</script>

<Header title={faculty.name} seoDescription="Cafeterías en la {faculty.name}." seoImage={faculty.logo} />

<!-- TODO: Lazy loading Google Maps -->

{#each (faculty.cafeterias ?? []) as cafeteria (cafeteria.id)}
    <Card>
        <div class='w-full text-center mb-6'>
            <h2 class='text-gray-700 text-2xl'>
                { cafeteria.name }
            </h2>
        </div>
        <div class='grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4'>
            {#each (cafeteria.products ?? []) as product (product.id)}
                <div class='group col-span-1 p-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-xl border'>
                    <!-- TODO: On click open modal with price comparison -->
                    <div class='h-full w-full flex flex-col justify-between'>
                        <div class='w-full overflow-hidden rounded-lg relative flex-grow-1'>
                            <!--<img src="{ product.image }" alt="{`Imagen representativa de ${product.name}`}" class="h-32 mx-auto rounded-lg" />-->
                            <div class='h-32 mx-auto rounded-lg'></div>
                        </div>
                        <div class='mt-4'>
                            <div class='flex'>
                                <div class='overflow-hidden w-full flex-grow-1'>
                                    <p title={ product.name }
                                       class='font-semibold whitespace-nowrap overflow-ellipsis w-full overflow-hidden'>
                                        { product.name }
                                    </p>
                                    <p class='text-gray-500 dark:text-gray-200'>
                                        { currencyFormatter.format(product.price) }
                                    </p>
                                </div>
                                {#if product.categories}
                                    <div class='ml-4 pt-0.5 flex-shrink-0'>
                                        <div class='w-auto h-auto px-1 py-0.5 rounded-lg bg-yellow-200 text-sm lig'>
                                            { product.categories[0].name }
                                        </div>
                                    </div>
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
            {/each}
        </div>
    </Card>
{/each}
