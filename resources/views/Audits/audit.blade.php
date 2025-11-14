<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Auditoria do Sistema
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">


                <form method="GET" class="mb-4">
                    <div class="flex flex-col sm:flex-row gap-3">

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Buscar por evento, usuário ou URL..."
                            class="w-full px-4 py-2 border border-gray-300 text-gray-900
                                   dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600
                                   rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />

                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Buscar
                        </button>
                    </div>
                </form>


                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border rounded-lg">


                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                    ID</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                    Usuário</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                    Evento</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                    Tabela</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                    Novos Valores</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                                    Data</th>
                            </tr>
                        </thead>


                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse($audits as $audit)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">


                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                        {{ $audit->id }}
                                    </td>


                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                        {{ $audit->user_id ?? 'Sistema' }}
                                    </td>


                                    <td class="px-4 py-3 text-sm">
                                        <span
                                            class="px-2 py-1 text-xs rounded bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300">
                                            {{ $audit->event }}
                                        </span>
                                    </td>


                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                        {{ class_basename($audit->auditable_type) }}
                                        (ID {{ $audit->auditable_id }})
                                    </td>


                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200 max-w-xs truncate">

                                        <button
                                            onclick="document.getElementById('audit-{{ $audit->id }}').classList.toggle('hidden')"
                                            class="text-indigo-600 dark:text-indigo-400 hover:underline text-xs">
                                            Ver
                                        </button>

                                        <div id="audit-{{ $audit->id }}"
                                            class="hidden mt-2 p-3 bg-gray-100 dark:bg-gray-700 rounded text-xs">

                                            <pre class="whitespace-pre-wrap text-gray-800 dark:text-gray-100">
{{ json_encode(json_decode($audit->new_values), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                                            </pre>
                                        </div>

                                    </td>


                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                        {{ \Carbon\Carbon::parse($audit->created_at)->format('d/m/Y H:i') }}
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-600 dark:text-gray-300">
                                        Nenhum registro de auditoria encontrado.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>


                <div class="mt-4">
                    {{ $audits->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
