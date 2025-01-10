<!-- resources/views/autores/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Autor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Importante: adicionar 'enctype' para permitir upload de arquivos -->
                <form action="{{ route('autores.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="aut_nome" class="block font-medium text-sm text-gray-700">Nome do Autor:</label>
                        <input type="text" name="aut_nome" id="aut_nome" value="{{ old('aut_nome') }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="aut_foto" class="block font-medium text-sm text-gray-700">Foto do Autor:</label>
                        <input type="file" name="aut_foto" id="aut_foto"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <small class="text-gray-500">Formatos recomendados: JPG, PNG. Tamanho máximo: 2MB.</small>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-white hover:bg-green-600">
                            Cadastrar
                        </button>

                        <a href="{{ route('autores.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-white hover:bg-gray-600">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
