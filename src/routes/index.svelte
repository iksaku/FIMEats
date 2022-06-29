<script>
    import Card from '$components/Card.svelte'
    import Header from '../components/Header.svelte'

    export let faculties
</script>

<Header description='La comida que buscas, en el lugar que la buscas.' />

<Card>
    <div class='w-full text-center mb-6'>
        <h2 id='facultades' class='text-gray-700 text-2xl'>
            Selecciona tu Facultad
        </h2>
    </div>

    <ul class='grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4'>
        {#each faculties as faculty (faculty.id)}
            <li class='col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200'>
                <a href='/facultad/{faculty.short_name}'>
                    <div class='flex-1 flex flex-col p-8'>
                        <img class='w-32 h-32 mx-auto flex-shrink-0 object-contain' src={faculty.logo} alt='' />
                        <h3 class='mt-6 text-gray-900 text-sm font-medium'>{ faculty.name }</h3>
                        <dl class='mt-1 flex-grow flex flex-col justify-between'>
                            <dt class='sr-only'>{ faculty.short_name }</dt>
                            <dd class='mt-3'>
                                <span
                                    class='px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full'>{ faculty.short_name }</span>
                            </dd>
                        </dl>
                    </div>
                </a>
            </li>
        {/each}
    </ul>
</Card>
