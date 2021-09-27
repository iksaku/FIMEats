<template>
  <header class="w-full z-30 sticky top-0 inset-x-0 text-gray-100 bg-green-700 px-6 py-2 shadow">
    <nav class="w-full flex items-center justify-between">
      <router-link :to="{ name: 'index' }">
        <h1 class="text-2xl font-bold inline-block align-middle">FIMEats</h1>
      </router-link>

      <div class="hidden sm:flex items-center space-x-10">
        <router-link
          :to="{ name: 'index', hash: '#facultades' }"
          class="inline-block flex-none"
          aria-label="Ir a la pantalla de selección de facultades."
        >
          Selecciona tu Facultad
        </router-link>

        <a
          class="inline-flex items-center flex-none space-x-1"
          href="https://github.com/iksaku/FIMEats"
          target="_blank"
          rel="noopener"
          aria-label="Ir al repositorio de Github de FIMEats."
        >
          <span>Contribuye en Github</span>

          <GithubIcon class="w-5 h-5" />
        </a>
      </div>

      <div class="flex items-center justify-end sm:hidden">
        <button class="focus:outline-none" @click="open = !open">
          <MenuIcon class="w-8 h-8" />
        </button>

        <div class="relative">
          <transition
            enter-active-class="transform duration-200"
            enter-from-class="-translate-y-4 opacity-0"
            leave-active-class="transform duration-200"
            leave-to-class="-translate-y-4 opacity-0"
          >
            <div
              v-show="open"
              @click="open = false"
              class="w-56 z-40 absolute top-0 right-0 text-center text-gray-800 bg-white mt-3 border rounded-lg shadow divide-y divide-gray-300"
            >
              <router-link
                :to="{ name: 'index', hash: '#facultades' }"
                class="w-full block whitespace-no-wrap px-4 py-2"
                aria-label="Ir a la pantalla de selección de facultades."
              >
                Selecciona tu Facultad
              </router-link>

              <a
                class="w-full flex items-center whitespace-no-wrap space-x-1 px-4 py-2"
                href="https://github.com/iksaku/FIMEats"
                target="_blank"
                rel="noopener"
                aria-label="Ir al repositorio de Github de FIMEats"
              >
                <GithubIcon class="w-5 h-5" />

                <span> Contribuye en Github </span>
              </a>
            </div>
          </transition>
        </div>
      </div>
    </nav>
  </header>

  <div class="flex-grow">
    <div class="w-full py-8">
      <div class="max-w-xl mx-auto text-center">
        <h1 class="text-gray-700 text-4xl">
          <slot name="title">
            {{ title }}
          </slot>
        </h1>

        <template v-if="description">
          <hr class="w-full my-4 border-t-2" />

          <p class="text-gray-700 text-xl">
            {{ description }}
          </p>
        </template>
      </div>
    </div>

    <div class="container md:max-w-6xl mx-auto p-4">
      <router-view />
    </div>
  </div>
</template>

<script lang="ts">
  import { computed, defineComponent, ref } from 'vue'
  import { useMetadata } from '@/api/metadata'
  import GithubIcon from '@/components/icons/Github.svg'
  import MenuIcon from '@/components/icons/Menu.svg'

  export default defineComponent({
    name: 'App',

    components: {
      GithubIcon,
      MenuIcon,
    },

    setup() {
      const meta = useMetadata()

      return {
        title: computed(() => meta.get('title') ?? 'FIMEats'),
        description: computed(() => meta.get('description')),
        open: ref<boolean>(false),
      }
    },
  })
</script>
