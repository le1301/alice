<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nome</label>
                        <input type="text" name="name" id="name" class="border rounded py-2 px-4 w-full" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email" class="border rounded py-2 px-4 w-full" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Senha</label>
                        <input type="password" name="password" id="password" class="border rounded py-2 px-4 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirmação de Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="border rounded py-2 px-4 w-full" required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Cadastrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
