<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cadastrar Estudante
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-10 bg-white border-b border-gray-200">
                        <div v-if="message != null" class="p-3 bg-green-500 rounded text-white text-sm flex justify-between items-center">
                            <span class="w-full">Estudante cadastrar com sucesso!</span>
                            <span class="w-6 font-bold cursor-pointer px-2" @click="message = null">-</span>
                        </div>
                        <div class="px-1 py-5">
                            <form @submit.prevent="onSubmit">
                                <div class="grid grid-cols-12 gap-y-3 gap-x-2">
                                    <div class="col-span-12 sm:col-span-12">
                                        <p class="font-bold">Dados do Estudante</p>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <label for="titulo" class="block text-sm font-medium text-gray-700">Nome <span class="text-red-600">*</span> </label>
                                        <input type="text"
                                        v-model.trim="form.nome"
                                        formControlName="nome"
                                        id="nome"
                                        placeholder="Ex: John Doe"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.nome" class="block text-sm font-medium text-red-600">{{ errors.nome }}</label>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="serie_ingresso" class="block text-sm font-medium text-gray-700">Série de Ingresso<span class="text-red-600">*</span> </label>
                                        <select v-model="form.serie_ingresso" id="serie_ingresso" formControlName="serie_ingresso" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="null" disabled>Selecione a série</option>
                                            <option v-for="serie in [1,2,3,4,5,6,7,8,9]" :key="serie" :value="serie" >{{ serie }}º ano</option>
                                        </select>
                                        <label v-if="errors.serie_ingresso" class="block text-sm font-medium text-red-600">{{ errors.serie_ingresso }}</label>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento <span class="text-red-600">*</span> </label>
                                        <input type="date"
                                        v-model="form.data_nascimento" id="data_nascimento" formControlName="data_nascimento"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.data_nascimento" class="block text-sm font-medium text-red-600">{{ errors.data_nascimento }}</label>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <p class="font-bold">Endereço</p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="cep" class="block text-sm font-medium text-gray-700">CEP<span class="text-red-600">*</span> </label>
                                        <input type="text"
                                        v-model.trim="form.cep"
                                        formControlName="cep"
                                        id="cep"
                                        placeholder="#####-###"
                                        v-mask="'#####-###'"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.cep" class="block text-sm font-medium text-red-600">{{ errors.cep }}</label>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado <span class="text-red-600">*</span> </label>
                                        <input type="text"
                                        v-model.trim="form.estado"
                                        formControlName="estado"
                                        id="estado"
                                        placeholder="Ex: São Paulo"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.estado" class="block text-sm font-medium text-red-600">{{ errors.estado }}</label>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade<span class="text-red-600">*</span> </label>
                                        <input type="text"
                                        v-model.trim="form.cidade"
                                        formControlName="cidade"
                                        id="cidade"
                                        placeholder="Ex: Cidade"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.cidade" class="block text-sm font-medium text-red-600">{{ errors.cidade }}</label>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro <span class="text-red-600">*</span> </label>
                                        <input type="text"
                                        v-model.trim="form.bairro"
                                        formControlName="bairro"
                                        id="bairro"
                                        placeholder="Qual o bairro onde vives?"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.bairro" class="block text-sm font-medium text-red-600">{{ errors.bairro }}</label>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <label for="rua" class="block text-sm font-medium text-gray-700">Rua <span class="text-red-600">*</span> </label>
                                        <input type="text"
                                        v-model.trim="form.rua"
                                        formControlName="rua"
                                        id="rua"
                                        placeholder="Ex: Avenida ..."
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.rua" class="block text-sm font-medium text-red-600">{{ errors.rua }}</label>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="numero" class="block text-sm font-medium text-gray-700">Número<span class="text-red-600">*</span> </label>
                                        <input type="number"
                                        v-model.trim="form.numero"
                                        formControlName="numero"
                                        id="numero"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.numero" class="block text-sm font-medium text-red-600">{{ errors.numero }}</label>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="complemento" class="block text-sm font-medium text-gray-700">Complemento <span class="text-red-600">*</span> </label>
                                        <input type="text"
                                        v-model.trim="form.complemento"
                                        formControlName="complemento"
                                        id="complemento"
                                        placeholder="Ex: Mais detalhes"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.complemento" class="block text-sm font-medium text-red-600">{{ errors.complemento }}</label>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <p class="font-bold">Dados da Mãe</p>
                                    </div>
                                    <div class="col-span-12 sm:col-span-12">
                                        <label for="nome_mae" class="block text-sm font-medium text-gray-700">Nome <span class="text-red-600">*</span> </label>
                                        <input type="text"
                                        v-model.trim="form.nome_mae"
                                        formControlName="nome_mae"
                                        id="nome_mae"
                                        placeholder="Ex: Joana Doe"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.nome_mae" class="block text-sm font-medium text-red-600">{{ errors.nome_mae }}</label>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="cpf_mae" class="block text-sm font-medium text-gray-700">CPF<span class="text-red-600">*</span> </label>
                                        <input type="text"
                                        v-model.trim="form.cpf_mae"
                                        formControlName="cpf_mae"
                                        id="cpf_mae"
                                        placeholder="###.###.###-##"
                                        v-mask="'###.###.###-##'"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.cpf_mae" class="block text-sm font-medium text-red-600">{{ errors.cpf_mae }}</label>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="data_preferencial_mae" class="block text-sm font-medium text-gray-700">Data de pagamento <span class="text-red-600">*</span> </label>
                                        <input type="date"
                                        v-model="form.data_preferencial_mae" id="data_preferencial_mae" formControlName="data_preferencial_mae"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                        <label v-if="errors.data_preferencial_mae" class="block text-sm font-medium text-red-600">{{ errors.data_preferencial_mae }}</label>
                                    </div>
                                    <button type="button" @click="limparDados" class="col-span-6 sm:col-span-6 px-5 py-3 mt-2 border border-black text-base font-medium rounded-md hover:bg-gray-200">
                                        Limpar Dados
                                    </button>
                                    <button type="submit" class="col-span-6 sm:col-span-6 px-5 py-3 mt-2 border border-transparent text-base font-medium rounded-md text-white bg-yellow-700 hover:bg-yellow-800">
                                        Salvar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            errors: Object,
        },
        components: {
            AppLayout,
        },
        data () {
            return {
                show_message: false,
                form: {
                    nome: null,
                    data_nascimento: null,
                    serie_ingresso: null,
                    cep: null,
                    rua: null,
                    numero: null,
                    complemento: null,
                    bairro: null,
                    cidade: null,
                    estado: null,
                    nome_mae: null,
                    cpf_mae: null,
                    data_preferencial_mae: null,
                }
            }
        },
        methods: {
            limparDados(){
                this.form.nome = null;
                this.form.data_nascimento = null;
                this.form.serie_ingresso = null;
                this.form.cep = null;
                this.form.rua = null;
                this.form.numero = null;
                this.form.complemento = null;
                this.form.bairro = null;
                this.form.cidade = null;
                this.form.estado = null;
                this.form.nome_mae = null;
                this.form.cpf_mae = null;
                this.form.data_preferencial_mae = null;
            },
            onSubmit(){
                var dados = this;
                this.$inertia.post(route('estudante.store'), this.form, {
                    onSuccess(){
                        dados.show_message = true;
                        dados.limparDados();
                    },
                    onError(errors){
                        dados.show_message = false;
                    },
                });
            }
        }
    }
</script>
