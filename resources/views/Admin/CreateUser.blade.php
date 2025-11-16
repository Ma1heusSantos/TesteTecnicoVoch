<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Criar Novo Usuário
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <p class="mb-6 text-sm text-gray-600 dark:text-gray-400">
                        Utilize o formulário abaixo para cadastrar um novo usuário.
                    </p>

                    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="avatar" :value="__('Foto de Perfil')" />

                            <div class="flex items-center gap-4 mt-2">
                                <label for="avatar"
                                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-600 
                                              border border-transparent rounded-md font-semibold text-xs
                                              text-white uppercase tracking-widest hover:bg-indigo-500 
                                              active:bg-indigo-700 focus:outline-none focus:ring 
                                              focus:ring-indigo-300 dark:focus:ring-indigo-800 transition">
                                    Selecionar Foto
                                </label>

                                <span id="avatarName" class="text-sm text-gray-500 dark:text-gray-400"></span>
                            </div>

                            <input id="avatar" name="avatar" type="file" class="hidden" />

                            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                        </div>

                        <script>
                            document.getElementById('avatar').addEventListener('change', function() {
                                document.getElementById('avatarName').textContent = this.files[0]?.name ?? '';
                            });
                        </script>

                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                value="{{ old('name') }}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                value="{{ old('email') }}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Senha')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="role" :value="__('Tipo de Usuário')" />

                            <select name="role" id="role"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-800 dark:text-gray-300 shadow-sm">
                                <option value="user">Usuário</option>
                                <option value="admin">Administrador</option>
                            </select>

                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <x-primary-button>
                            Criar Usuário
                        </x-primary-button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
