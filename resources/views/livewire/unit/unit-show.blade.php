<div>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between h-10">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Unidades') }}
                </h2>
                <div class="flex">
                    <input wire:model.live="search" type="text" placeholder="Pesquisar"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 transition duration-200" />
                    <a href="{{ route('unit.create') }}"
                        class="bg-blue-600 mx-2 w-96 hover:bg-blue-700 active:bg-blue-800 text-white font-medium py-3 px-6 rounded-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-300 inline-flex items-center justify-center text-center">
                        + Adicionar
                    </a>

                </div>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session()->has('message'))
                @endif
                @if (isset($unit) && !$unit->isEmpty())
                    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                        <table class="min-w-full text-base text-left text-gray-500 dark:text-gray-100">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-lg font-semibold text-gray-700 dark:text-gray-100 text-center">

                                        Nome Fantasia:</th>
                                    <th
                                        class="px-6 py-4 text-lg font-semibold text-gray-700 dark:text-gray-100 text-center">

                                        Razão Social:</th>
                                    <th
                                        class="px-6 py-4 text-lg font-semibold text-gray-700 dark:text-gray-100 text-center">
                                        CNPJ:</th>
                                    <th
                                        class="px-6 py-4 text-lg font-semibold text-gray-700 dark:text-gray-100 text-center">
                                        Bandeira:
                                    </th>
                                    <th
                                        class="px-6 py-4 text-lg font-semibold text-gray-700 dark:text-gray-100 text-center">
                                        Ações:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unit as $group)
                                    <tr
                                        class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 text-base text-center text-gray-900 dark:text-gray-100">
                                            {{ $group->nome_fantasia ?? 'não informado' }}</td>
                                        <td class="px-6 py-4 text-base text-center text-gray-900 dark:text-gray-100">
                                            {{ $group->razao_social ?? 'não informado' }}</td>
                                        <td class="px-6 py-4 text-base text-center text-gray-900 dark:text-gray-100">
                                            {{ $group->cnpj ?? 'não informado' }}</td>
                                        <td class="px-6 py-4 text-base text-center text-gray-900 dark:text-gray-100">
                                            {{ $group->flag->nome ?? 'não informado' }}</td>
                                        <td class="px-6 py-4 text-base text-center">
                                            <a href="{{ route('unit.edit', $group->id) }}"
                                                class="bg-yellow-500 mr-4 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-md shadow-sm transition duration-200 text-xs">
                                                Editar
                                            </a>
                                            <a href="{{ route('unit.destroy', $group->id) }}"
                                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm transition duration-200 text-xs">
                                                Excluir
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900 dark:text-gray-100 text-lg">
                            Nenhuma Unidade encontrada.
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session()->has('global-success'))
                    Swal.fire({
                        title: 'Sucesso!',
                        text: "{{ session('message') }}",
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                @elseif (session()->has('global-error'))
                    Swal.fire({
                        title: 'Erro!',
                        text: "{{ session('message') }}",
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                @endif
            });
        </script>
    </x-app-layout>
</div>
