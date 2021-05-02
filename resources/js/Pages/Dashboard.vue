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
                                    <div v-if="show_message" class="p-3 bg-green-500 rounded text-white text-sm flex justify-between items-center">
                                        <span class="w-full">Estudante removido com sucesso!</span>
                                        <span class="w-6 font-bold cursor-pointer px-2" @click="show_message = false">-</span>
                                    </div>
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
                                            <tr v-for="estudante in estudantes.data" class="divide-x divide-gray-200" :key="estudante.id">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ estudante.nome }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                                    {{ estudante.serie_ingresso }}º ano
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-xs text-gray-900">{{ estudante.data_nascimento }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                                    {{ estudante.encarregado.nome }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap flex justify-around">
                                                    <inertia-link :href="route('estudante.edit', estudante.id)" class="bg-blue-500 p-2 rounded-full">
                                                        <PencilIcon class="text-white sm:text-sm h-5 w-5" aria-hidden="true" />
                                                    </inertia-link>
                                                    <span @click="onDelete(estudante.id)" class="bg-red-500 p-2 rounded-full cursor-pointer">
                                                        <TrashIcon class="text-white sm:text-sm h-5 w-5" aria-hidden="true" />
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <Pagination
                        :from="estudantes.from"
                        :to="estudantes.to"
                        :total="estudantes.total"
                        :previous="estudantes.prev_page_url"
                        :next="estudantes.next_page_url" />
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
        props: {
            estudantes: Object,
        },
        components: {
            AppLayout,
            Welcome,
            Pagination,
            SearchIcon,
            PencilIcon,
            TrashIcon
        },
        data () {
            return {
                show_message: false,
            }
        },
        methods: {
            onDelete(id){
                var dados = this;
                this.$inertia.delete(route('estudante.destroy', id), this.form, {
                    onSuccess(){
                        dados.show_message = true;
                    },
                    onError(errors){
                        dados.show_message = false;
                    },
                });
            }
        }
    }
</script>
