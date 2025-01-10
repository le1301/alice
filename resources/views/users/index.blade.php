<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">
                @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Cadastrar novo usuário
                    </a>
                    <form method="GET" action="{{ route('users.index') }}" class="flex">
                        <input type="text" name="search" placeholder="Buscar por nome ou e-mail" class="border rounded py-2 px-4 mr-2 w-64" value="{{ $search }}">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Buscar</button>
                        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Limpar</a>
                    </form>
                </div>

                <table class="w-full mt-4 border">
                    <thead class="border-b text-left">
                        <tr>
                            <th class="py-2 px-4">ID</th>
                            <th class="py-2 px-4">Nome</th>
                            <th class="py-2 px-4">Email</th>
                            <!--th class="py-2 px-4">Ações</th-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b">
                                <td class="py-2 px-4">{{ $user->id }}</td>
                                <td class="py-2 px-4">{{ $user->name }}</td>
                                <td class="py-2 px-4">{{ $user->email }}</td>
                                 <!-- Aqui podem ser adicionadas ações de edição e exclusão -->
                                <!--td class="py-2 px-4">
                                    <a href="/profile" class="text-blue-500 underline">Editar</a>
                                    <span>|</span>
                                    <a href="#" class="text-red-500 underline">Excluir</a>
                                </td-->
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
