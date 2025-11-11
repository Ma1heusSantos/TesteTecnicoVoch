<div>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between h-10">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Adicionar uma Unidade:') }}
                </h2>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                    <form wire:submit.prevent="submit">
                        <div class="mb-4">
                            <label for="nomeFantasia"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-medium my-3">Nome
                                fantasia:</label>
                            <input type="text" id="nomeFantasia" wire:model="nomeFantasia"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 transition duration-200 @error('nome')  @enderror"
                                placeholder="Ex:  Voch Tecnologia e Sistemas de Informacao Ltda" />
                            @error('nomeFantasia')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="razaoSocial"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-medium my-3">Razão
                                Social:</label>
                            <input type="text" id="razaoSocial" wire:model="razaoSocial"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 transition duration-200 @error('nome')  @enderror"
                                placeholder="Ex: Voch Tech" />
                            @error('razaoSocial')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label for="cnpj"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-medium my-3">CNPJ:</label>
                            <input type="text" id="cnpj" wire:model="cnpj"
                                class="cnpj w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 transition duration-200 @error('cnpj')  @enderror"
                                placeholder="Ex: 00.000.000/0000-00" />
                            @error('cnpj')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="mb-4">
                            <label for="flag"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-medium my-3">
                                Bandeira:</label>
                            <select id="flag" wire:model="flag"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 transition duration-200 @error('nome')  @enderror">
                                <option value="" selected>Selecione uma bandeira</option>
                                @foreach ($flags as $flag)
                                    <option value="{{ $flag->id }}">{{ $flag->nome }}</option>
                                @endforeach
                            </select>
                            @error('flag')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
