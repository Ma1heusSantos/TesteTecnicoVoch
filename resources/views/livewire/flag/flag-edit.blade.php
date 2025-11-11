<div>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between h-10">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Editar uma Bandeira') }}
                </h2>
            </div>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                    <form wire:submit.prevent="submit">
                        <div class="mb-4">
                            <label for="nome"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-medium my-3">Nome
                                do Grupo Econômico</label>
                            <input type="text" id="nome" wire:model="nome"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 transition duration-200 @error('nome')  @enderror" />
                            @error('nome')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="group"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-medium my-3">Nome do Grupo
                                Econômico:</label>
                            <select id="group" wire:model="group"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 transition duration-200 @error('nome')  @enderror">
                                <option value="" selected>Selecione o Grupo Econômico</option>
                                @foreach ($economicGroup as $group)
                                    <option value="{{ $group->id }}">{{ $group->nome }}</option>
                                @endforeach
                            </select>
                            @error('group')
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
