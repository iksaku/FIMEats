<script>
    import Logo from '$assets/logo.svg'

    export let title = 'FIMEats'
    export let description = null

    export let seoImage = Logo
    export let seoDescription = description ?? 'La comida que buscas, en el lugar que la buscas.'

    const seoTitle = title === 'FIMEats' ? title : `${title} | FIMEats`
</script>

<svelte:head>
    <title>{seoTitle}</title>
    <meta name="title" content={seoTitle}>
    <meta name="description" content={seoDescription}>
    <meta name="og:description" content={seoDescription}>
    <meta name="og:type" content="website">
    <meta name="og:site_name" content="FIMEats">
    <meta name="og:image" content={seoImage}>
    <!--<meta name="og:url" content={import.meta.url}>-->
    <meta name="og:locale" content="es_MX">
</svelte:head>

<div class='flex-grow'>
    <div class='w-full py-8'>
        <div class='max-w-xl mx-auto text-center'>
            <h1 class='text-gray-700 text-4xl'>
                { title }
            </h1>

            {#if (description)}
                <hr class='w-full my-4 border-t-2' />

                <p class='text-gray-700 text-xl'>
                    { description }
                </p>
            {/if}
        </div>
    </div>

    <div class='container md:max-w-6xl mx-auto p-4'>
        <slot />
    </div>
</div>
