<!-- resources/views/autores/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Autor') }}
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

                <form action="{{ route('autores.update', $autor->aut_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="aut_nome" class="block font-medium text-sm text-gray-700">Nome do Autor:</label>
                        <input type="text" name="aut_nome" id="aut_nome" value="{{ old('aut_nome', $autor->aut_nome) }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Foto Atual:</label>
                        @if($autor->aut_foto && file_exists(public_path($autor->aut_foto)))
                            <img src="{{ asset($autor->aut_foto) }}" alt="{{ $autor->aut_nome }}" class="w-16 h-16 object-cover rounded-full mt-2">
                        @else
                            <span class="text-gray-500">Sem foto</span>
                        @endif
                    </div>
                    
                    <div class="mb-4">
                        <label for="aut_foto" class="block font-medium text-sm text-gray-700">Nova Foto do Autor:</label>
                        <input type="file" name="aut_foto" id="aut_foto"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <small class="text-gray-500">Formatos recomendados: JPG, PNG. Tamanho máximo: 2MB.</small>
                    </div>
                    
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-600">
                        Atualizar
                    </button>

                    <a href="{{ route('autores.index') }}"
                       class="inline-flex items-center px-4 py-2 ml-4 bg-gray-500 border border-transparent rounded-md font-semibold text-white hover:bg-gray-600">
                        Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>