<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Livro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">

                <!-- Título em destaque -->
                <h3 class="text-xl font-bold mb-4">{{ $livro->liv_titulo }}</h3>

                <!-- Exibição da capa, se existir -->
                <div class="mb-4">
                    @if($livro->liv_capa && file_exists(public_path($livro->liv_capa)))
                        <img 
                            src="{{ asset($livro->liv_capa) }}" 
                            alt="Capa do Livro"
                            class="w-64 h-64 object-cover mb-2"
                        >
                    @else
                        <p class="text-gray-500">Sem capa cadastrada</p>
                    @endif
                </div>

                <!-- Exibição dos demais campos -->
                <p><strong>Tombo:</strong> {{ $livro->liv_id }}</p>
                <p><strong>Autor (ID):</strong> {{ $livro->liv_autor }}</p>
                <p><strong>Editora (ID):</strong> {{ $livro->liv_editora }}</p>
                <p><strong>Classificação (ID):</strong> {{ $livro->liv_classificacao }}</p>
                <p><strong>Local:</strong> {{ $livro->liv_local }}</p>
                <p><strong>Edição:</strong> {{ $livro->liv_edicao }}</p>
                <p><strong>Ano:</strong> {{ $livro->liv_ano }}</p>
                <p><strong>Páginas:</strong> {{ $livro->liv_paginas }}</p>
                <p><strong>Idioma:</strong> {{ $livro->liv_idioma }}</p>
                <p><strong>ISBN:</strong> {{ $livro->liv_isbn }}</p>
                <p><strong>Tradutor:</strong> {{ $livro->liv_tradutor }}</p>
                <p><strong>Tipo de Material:</strong> {{ $livro->liv_tipo_material }}</p>
                <p><strong>Quantidade:</strong> {{ $livro->liv_quantidade }}</p>
                <p><strong>Resumo:</strong> {{ $livro->liv_resumo }}</p>
                <p><strong>Estante:</strong> {{ $livro->liv_estante }}</p>
                <p><strong>Chamada:</strong> {{ $livro->liv_chamada }}</p>
                <!--p><strong>Tombo:</strong> {{ $livro->liv_tombo }}</p--><br>

                
            <!-- Botões de Ação -->
            <div class="mt-4">
                <a href="{{ route('livros.edit', $livro->liv_id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <a href="{{ route('livros.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
                    Voltar
                </a>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
