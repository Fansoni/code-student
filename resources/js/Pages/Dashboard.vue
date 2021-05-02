<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Estudantes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-10 bg-white border-b border-gray-200">
                        <div class="flex justify-between mt-4 mb-2">
                            <div class="w-20 mx-1">
                                <label for="country" class="block text-sm font-bold text-gray-700">Mostrar</label>
                                <select id="country" name="country" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>25</option>
                                </select>
                            </div>
                            <div class="w-full mx-1 relative">
                                <div>
                                    <label for="price" class="block text-sm font-bold text-gray-700">Pesquisar Estudante</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <SearchIcon class="text-gray-500 sm:text-sm h-6 w-4" aria-hidden="true" />
                                        </div>
                                        <input type="text" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-200 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Pesquisar..." />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 pt-5 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden border-b border-l border-r border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr class="divide-x divide-gray-200">
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">
                                                Nome
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">
                                                Série de Ingresso
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">
                                                Data de Nascimento
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">
                                                Encarregado
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">
                                                Operações
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="convite in ['Normal', 'VIP', 'Tipo desconhecido']" class="divide-x divide-gray-200" :key="convite">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ convite }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                                    19.000,00 KZ
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-xs text-gray-900">0 / 100</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                                    Encerrado
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap flex justify-around">
                                                    <a href="#" class="bg-blue-500 p-2 rounded-full">
                                                        <PencilIcon class="text-white sm:text-sm h-5 w-5" aria-hidden="true" />
                                                    </a>
                                                    <a href="#" class="bg-red-500 p-2 rounded-full">
                                                        <TrashIcon class="text-white sm:text-sm h-5 w-5" aria-hidden="true" />
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <Pagination />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Pagination from '@/Components/Pagination'
    import { SearchIcon, PencilIcon } from '@heroicons/vue/outline'
    import { TrashIcon } from '@heroicons/vue/solid'

    export default {
        components: {
            AppLayout,
            Welcome,
            Pagination,
            SearchIcon,
            PencilIcon,
            TrashIcon
        },
    }
</script>
