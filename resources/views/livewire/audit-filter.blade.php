<div>
    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">


            <input wire:model.live="search" type="text" placeholder="Buscar evento ou usuário"
                class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />


            <select wire:model.live="event"
                class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                <option value="">Todos Eventos</option>
                <option value="created">Criado</option>
                <option value="updated">Atualizado</option>
                <option value="deleted">Excluído</option>
            </select>

            <select wire:model.live="user"
                class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                <option value="">Todos Usuários</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>


            <input wire:model.live="date_from" type="date"
                class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
            <input wire:model.live="date_to" type="date"
                class="px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
        </div>




        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border rounded-lg">

                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                            ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                            Usuário</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                            Evento</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                            Tabela</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                            Old Values</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                            New Values</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-200 uppercase">
                            Data</th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                    @forelse ($audits as $audit)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $audit->id }}</td>

                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                {{ $audit->user_name ?? 'Sistema' }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                @if ($audit->event == 'created')
                                    <span
                                        class="px-2 py-1 text-xs rounded bg-green-100 text-white dark:bg-green-900 dark:text-white">
                                        {{ $audit->event }}
                                    </span>
                                @elseif ($audit->event == 'updated')
                                    <span
                                        class="px-2 py-1 text-xs rounded bg-blue-100 text-white dark:bg-blue-900 dark:text-white">
                                        {{ $audit->event }}
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs rounded bg-red-100 text-white dark:bg-red-900 dark:text-white">
                                        {{ $audit->event }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                {{ class_basename($audit->auditable_type) }} (ID {{ $audit->auditable_id }})
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200 max-w-xs truncate">

                                <button
                                    onclick="document.getElementById('old-{{ $audit->id }}').classList.toggle('hidden')"
                                    class="text-indigo-600 dark:text-indigo-400 hover:underline text-xs">
                                    Ver
                                </button>

                                <div id="old-{{ $audit->id }}"
                                    class="hidden mt-2 p-3 bg-gray-100 dark:bg-gray-700 rounded text-xs">
                                    <pre class="whitespace-pre-wrap text-gray-800 dark:text-gray-100">
{{ json_encode(json_decode($audit->old_values), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                                    </pre>
                                </div>
                            </td>

                            {{-- NEW VALUES --}}
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200 max-w-xs truncate">
                                <button
                                    onclick="document.getElementById('new-{{ $audit->id }}').classList.toggle('hidden')"
                                    class="text-indigo-600 dark:text-indigo-400 hover:underline text-xs">
                                    Ver
                                </button>

                                <div id="new-{{ $audit->id }}"
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
                            <td colspan="7" class="text-center py-6 text-gray-600 dark:text-gray-300">
                                Nenhum registro encontrado.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>


        <div class="mt-4">
            {{ $audits->links() }}
