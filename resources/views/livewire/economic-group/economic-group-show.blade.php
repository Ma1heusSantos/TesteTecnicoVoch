<div>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between h-10">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Grupo Econômico') }}
                </h2>

                <div class="flex">
                    <input wire:model.live="search" type="text" placeholder="Pesquisar"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        text-gray-900 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 transition duration-200" />

                    <a href="{{ route('economicGroup.create') }}"
                        class="bg-blue-600 mx-2 w-96 hover:bg-blue-700 active:bg-blue-800
                        text-white font-medium py-3 px-6 rounded-lg shadow-lg
                        hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-300 
                        transition-all duration-300 inline-flex items-center justify-center text-center">
                        + Adicionar
                    </a>
                </div>
            </div>
        </x-slot>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">

                    @if (isset($economicGroup) && !$economicGroup->isEmpty())
                        <div class="overflow-x-auto">

                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border rounded-lg">

                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                            Nome
                                        </th>

                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                            Editar
                                        </th>

                                        <th
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                            Excluir
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                                    @foreach ($economicGroup as $group)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                                {{ $group->nome ?? 'Não informado' }}
                                            </td>

                                            <td class="px-4 py-3">
                                                <a href="{{ route('economicGroup.edit', $group->id) }}"
                                                    class="text-yellow-600 dark:text-yellow-400 hover:underline text-sm">
                                                    Editar
                                                </a>
                                            </td>

                                            <td class="px-4 py-3">
                                                <a href="{{ route('economicGroup.destroy', $group->id) }}"
                                                    class="text-red-600 dark:text-red-400 hover:underline text-sm">
                                                    Excluir
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    @else
                        <div class="p-6 text-gray-700 dark:text-gray-300 text-lg">
                            Nenhum grupo encontrado.
                        </div>
                    @endif

                </div>

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
