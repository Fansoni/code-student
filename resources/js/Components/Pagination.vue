<template>
  <div class="bg-white px-4 py-3 flex items-center justify-between sm:px-6">
    <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Exibindo
          {{ ' ' }}
          <span class="font-medium">{{ from }}</span>
          {{ ' ' }}
          até
          {{ ' ' }}
          <span class="font-medium">{{ to }}</span>
          {{ ' ' }}
          de
          {{ ' ' }}
          <span class="font-medium">{{ total }}</span>
          {{ ' ' }}
          resultados
        </p>
      </div>
      <div>
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
            <inertia-link :href="previous" :class="{'pointer-events-none': (previous == null)}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Anterior</span>
                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
            </inertia-link>
            <inertia-link :href="next??'#'" :class="{'pointer-events-none': (next == null)}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Próximo</span>
                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
            </inertia-link>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'

export default {
    props: {
        from: Number,
        to: Number,
        total: Number,
        previous: null,
        next: null,
    },
    components: {
        ChevronLeftIcon,
        ChevronRightIcon,
    },
}
</script>
