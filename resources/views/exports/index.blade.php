<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Exportações de Colaboradores
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">

        @if (session('success'))
            <div class="p-3 bg-green-100 text-green-700 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($exports as $export)
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded mb-3 flex justify-between items-center">

                @if ($export->status === 'completed')
                    <a href="{{ asset('storage/' . $export->file_path) }}" class="text-indigo-600 font-semibold" download>
                        Baixar Arquivo
                    </a>
                @else
                    <span class="text-gray-500 flex items-center gap-2">
                        <span
                            class="animate-spin h-4 w-4 border-2 border-gray-400 border-t-transparent rounded-full"></span>
                        Processando...
                    </span>
                @endif

                <span class="text-sm text-gray-400">
                    {{ $export->created_at->diffForHumans() }}
                </span>
            </div>
        @empty
            <p class="text-gray-500">Nenhuma exportação encontrada.</p>
        @endforelse

    </div>
</x-app-layout>
