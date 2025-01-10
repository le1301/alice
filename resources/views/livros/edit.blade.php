<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Livro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulário com upload de arquivo (capa) -->
                <form action="{{ route('livros.update', $livro->liv_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Tombo -->
                    <div class="mb-4">
                        <label for="liv_id" class="block font-medium text-sm text-gray-700">Tombo:</label>
                        <input 
                            type="text"
                            name="liv_id"
                            id="liv_id"
                            value="{{ old('liv_id', $livro->liv_id) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            maxlength="100"
                            readonly
                        >
                    </div>

                    <!-- Título -->
                    <div class="mb-4">
                        <label for="liv_titulo" class="block font-medium text-sm text-gray-700">Título:</label>
                        <input 
                            type="text" 
                            name="liv_titulo" 
                            id="liv_titulo" 
                            placeholder="Dom Casmurro"
                            value="{{ old('liv_titulo', $livro->liv_titulo) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            required
                        >
                    </div>

                    <!-- Autor (FK) - Dropdown Search -->
                    <div class="mb-4">
                        <label for="liv_autor" class="block font-medium text-sm text-gray-700">Autor:</label>
                        <select 
                            name="liv_autor" 
                            id="liv_autor" 
                            class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        >
                            <option value="">-- Selecione o Autor --</option>
                            @foreach($autores as $autor)
                                <option 
                                    value="{{ $autor->aut_id }}"
                                    {{ old('liv_autor', $livro->liv_autor) == $autor->aut_id ? 'selected' : '' }}
                                >
                                    {{ $autor->aut_nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Editora (FK) - Dropdown Search -->
                    <div class="mb-4">
                        <label for="liv_editora" class="block font-medium text-sm text-gray-700">Editora:</label>
                        <select 
                            name="liv_editora" 
                            id="liv_editora"
                            class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        >
                            <option value="">-- Selecione a Editora --</option>
                            @foreach($editoras as $editora)
                                <option 
                                    value="{{ $editora->edi_id }}"
                                    {{ old('liv_editora', $livro->liv_editora) == $editora->edi_id ? 'selected' : '' }}
                                >
                                    {{ $editora->edi_nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Local -->
                    <div class="mb-4">
                        <label for="liv_local" class="block font-medium text-sm text-gray-700">Local:</label>
                        <input 
                            type="text"
                            name="liv_local"
                            id="liv_local"
                            placeholder="Avaré"
                            value="{{ old('liv_local', $livro->liv_local) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            maxlength="250"
                        >
                    </div>

                    <!-- Edição -->
                    <div class="mb-4">
                        <label for="liv_edicao" class="block font-medium text-sm text-gray-700">Edição:</label>
                        <input 
                            type="text"
                            name="liv_edicao"
                            id="liv_edicao"
                            placeholder="1ª Edição"
                            value="{{ old('liv_edicao', $livro->liv_edicao) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            maxlength="55"
                        >
                    </div>

                    <!-- Ano -->
                    <div class="mb-4">
                        <label for="liv_ano" class="block font-medium text-sm text-gray-700">Ano:</label>
                        <input 
                            type="text"
                            name="liv_ano"
                            id="liv_ano"
                            placeholder="1985"
                            value="{{ old('liv_ano', $livro->liv_ano) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            maxlength="4"
                        >
                    </div>

                    <!-- Páginas -->
                    <div class="mb-4">
                        <label for="liv_paginas" class="block font-medium text-sm text-gray-700">Páginas:</label>
                        <input 
                            type="text"
                            name="liv_paginas"
                            id="liv_paginas"
                            placeholder="130"
                            value="{{ old('liv_paginas', $livro->liv_paginas) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            maxlength="25"
                        >
                    </div>

                    <!-- Classificação (FK) - Dropdown Search -->
                    <div class="mb-4">
                        <label for="liv_classificacao" class="block font-medium text-sm text-gray-700">Classificação:</label>
                        <select 
                            name="liv_classificacao"
                            id="liv_classificacao"
                            class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        >
                            <option value="">-- Selecione a Classificação --</option>
                            @foreach($classificacoes as $classificacao)
                                <option 
                                    value="{{ $classificacao->cla_id }}"
                                    {{ old('liv_classificacao', $livro->liv_classificacao) == $classificacao->cla_id ? 'selected' : '' }}
                                >
                                    {{ $classificacao->cla_titulo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ISBN -->
                    <div class="mb-4">
                        <label for="liv_isbn" class="block font-medium text-sm text-gray-700">ISBN:</label>
                        <input 
                            type="text"
                            name="liv_isbn"
                            id="liv_isbn"
                            placeholder="978-85-333-0223-4"
                            value="{{ old('liv_isbn', $livro->liv_isbn) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            maxlength="55"
                        >
                    </div>

                    <!-- Tradutor -->
                    <div class="mb-4">
                        <label for="liv_tradutor" class="block font-medium text-sm text-gray-700">Tradutor:</label>
                        <input 
                            type="text"
                            name="liv_tradutor"
                            id="liv_tradutor"
                            placeholder="Fulano de Tal"
                            value="{{ old('liv_tradutor', $livro->liv_tradutor) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            maxlength="250"
                        >
                    </div>

                    <!-- Idioma (Dropdown) -->
                    <div class="mb-4">
                        <label for="liv_idioma" class="block font-medium text-sm text-gray-700">Idioma:</label>
                        <select 
                            name="liv_idioma"
                            id="liv_idioma"
                            class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        >
                            <option value="">-- Selecione o Idioma --</option>
                            @if(isset($idiomas) && is_array($idiomas))
                                @foreach($idiomas as $idioma)
                                    <option 
                                        value="{{ $idioma }}"
                                        {{ old('liv_idioma', $livro->liv_idioma) == $idioma ? 'selected' : '' }}
                                    >
                                        {{ $idioma }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Tipo de Material (Dropdown) -->
                    <div class="mb-4">
                        <label for="liv_tipo_material" class="block font-medium text-sm text-gray-700">Tipo de Material:</label>
                        <select 
                            name="liv_tipo_material"
                            id="liv_tipo_material"
                            class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        >
                            @if(isset($tiposMaterial) && is_array($tiposMaterial))
                                @foreach($tiposMaterial as $tipo)
                                    <option 
                                        value="{{ $tipo }}"
                                        {{ old('liv_tipo_material', $livro->liv_tipo_material) == $tipo ? 'selected' : '' }}
                                    >
                                        {{ $tipo }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Quantidade -->
                    <div class="mb-4">
                        <label for="liv_quantidade" class="block font-medium text-sm text-gray-700">Quantidade:</label>
                        <input 
                            type="number"
                            name="liv_quantidade"
                            id="liv_quantidade"
                            value="{{ old('liv_quantidade', $livro->liv_quantidade) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        >
                    </div>

                    <!-- Capa (upload + exibição) -->
                    <div class="mb-4">
                        <label for="liv_capa" class="block font-medium text-sm text-gray-700">Capa (Imagem):</label>
                        @if($livro->liv_capa && file_exists(public_path($livro->liv_capa)))
                            <div class="mb-2">
                                <img 
                                    src="{{ asset($livro->liv_capa) }}" 
                                    alt="Capa do Livro" 
                                    class="w-32 h-32 object-cover"
                                >
                            </div>
                        @else
                            <div class="mb-2 text-gray-500">Sem capa cadastrada</div>
                        @endif
                        <input 
                            type="file"
                            name="liv_capa"
                            id="liv_capa"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        >
                        <small class="text-gray-500">Formatos: jpg, png, etc. Máx 2MB.</small>
                    </div>

                    <!-- Resumo -->
                    <div class="mb-4">
                        <label for="liv_resumo" class="block font-medium text-sm text-gray-700">Resumo:</label>
                        <textarea 
                            name="liv_resumo"
                            id="liv_resumo"
                            rows="4"
                            placeholder="Dom Casmurro é uma obra de Machado de Assis..."
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        >{{ old('liv_resumo', $livro->liv_resumo) }}</textarea>
                    </div>

                    <!-- Estante -->
                    <div class="mb-4">
                        <label for="liv_estante" class="block font-medium text-sm text-gray-700">Estante:</label>
                        <input 
                            type="text"
                            name="liv_estante"
                            id="liv_estante"
                            placeholder="Estante 13 Prateleira 2"
                            value="{{ old('liv_estante', $livro->liv_estante) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            maxlength="100"
                        >
                    </div>

                    <!-- Chamada -->
                    <div class="mb-4">
                        <label for="liv_chamada" class="block font-medium text-sm text-gray-700">Chamada:</label>
                        <input 
                            type="text"
                            name="liv_chamada"
                            id="liv_chamada"
                            placeholder="ASSIS, M. Dom Casmurro"
                            value="{{ old('liv_chamada', $livro->liv_chamada) }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            maxlength="100"
                        >
                    </div>

                    

                    <!-- Botões de ação -->
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-indigo-500 text-white font-semibold rounded hover:bg-indigo-600"
                    >
                        Atualizar
                    </button>
                    <a 
                        href="{{ route('livros.index') }}" 
                        class="ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                    >
                        Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery + Select2 (para dropdownSearch se desejar) -->
    <script 
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        
        crossorigin="anonymous">
    </script>
    <script 
        src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"
        
        crossorigin="anonymous">
    </script>
    <link 
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" 
        rel="stylesheet" 
    />

    <script>
        $(document).ready(function() {
            // Inicializa dropdowns com class="select2"
            $('.select2').select2({
                placeholder: 'Pesquisar...',
                allowClear: true
            });
        });
    </script>
</x-app-layout>
