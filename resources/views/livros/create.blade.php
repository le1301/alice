<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Obra') }}
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

                <form action="{{ route('livros.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Tombo -->
                    <!--div class="mb-4">
                        <label for="liv_id" class="block font-medium text-sm text-gray-700">Tombo:</label>
                        <input type="text" name="liv_id" id="liv_id" 
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="100"
                               readonly>

                    </div-->


                    <!-- Título -->
                    <div class="mb-4">
                        <label for="liv_titulo" class="block font-medium text-sm text-gray-700">Título:</label>
                        <input type="text" name="liv_titulo" id="liv_titulo" 
                               placeholder="Dom Casmurro" value="{{ old('liv_titulo') }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               required>
                    </div>

                    <!-- Autor (FK) - Dropdown Search -->
                    <div class="mb-4">
                        <label for="liv_autor" class="block font-medium text-sm text-gray-700">Autor:</label>
                        <select name="liv_autor" id="liv_autor" 
                                class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="">-- Selecione o Autor --</option>
                            @foreach($autores as $autor)
                                <option value="{{ $autor->aut_id }}"
                                    {{ old('liv_autor') == $autor->aut_id ? 'selected' : '' }}>
                                    {{ $autor->aut_nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    
                    <!-- Editora (FK) - Dropdown Search -->
                    <div class="mb-4">
                        <label for="liv_editora" class="block font-medium text-sm text-gray-700">Editora:</label>
                        <select name="liv_editora" id="liv_editora" 
                                class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="">-- Selecione a Editora --</option>
                            @foreach($editoras as $editora)
                                <option value="{{ $editora->edi_id }}"
                                    {{ old('liv_editora') == $editora->edi_id ? 'selected' : '' }}>
                                    {{ $editora->edi_nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Local -->
                    <div class="mb-4">
                        <label for="liv_local" class="block font-medium text-sm text-gray-700">Local:</label>
                        <input type="text" name="liv_local" id="liv_local" 
                               value="{{ old('liv_local') }}"
                               placeholder="Avaré"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="250">
                    </div>

                    <!-- Edição -->
                    <div class="mb-4">
                        <label for="liv_edicao" class="block font-medium text-sm text-gray-700">Edição:</label>
                        <input type="text" name="liv_edicao" id="liv_edicao" 
                               value="{{ old('liv_edicao') }}"
                               placeholder="1ª Edição"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="55">
                    </div>

                    <!-- Ano -->
                    <div class="mb-4">
                        <label for="liv_ano" class="block font-medium text-sm text-gray-700">Ano:</label>
                        <input type="text" name="liv_ano" id="liv_ano" 
                               value="{{ old('liv_ano') }}"
                                 placeholder="1985"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="4">
                    </div>

                    <!-- Páginas -->
                    <div class="mb-4">
                        <label for="liv_paginas" class="block font-medium text-sm text-gray-700">Páginas:</label>
                        <input type="text" name="liv_paginas" id="liv_paginas" 
                               value="{{ old('liv_paginas') }}"
                               placeholder="130"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="25">
                    </div>

                    <!-- Classificação (FK) - Dropdown Search -->
                    <div class="mb-4">
                        <label for="liv_classificacao" class="block font-medium text-sm text-gray-700">Classificação:</label>
                        <select name="liv_classificacao" id="liv_classificacao"
                                class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="">-- Selecione a Classificação --</option>
                            @foreach($classificacoes as $classificacao)
                                <option value="{{ $classificacao->cla_id }}"
                                    {{ old('liv_classificacao') == $classificacao->cla_id ? 'selected' : '' }}>
                                    {{ $classificacao->cla_titulo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    
                    <!-- ISBN -->
                    <div class="mb-4">
                        <label for="liv_isbn" class="block font-medium text-sm text-gray-700">ISBN:</label>
                        <input type="text" name="liv_isbn" id="liv_isbn" 
                               value="{{ old('liv_isbn') }}"
                               placeholder="978-85-333-0223-4"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="55">
                    </div>

                    <!-- Tradutor -->
                    <div class="mb-4">
                        <label for="liv_tradutor" class="block font-medium text-sm text-gray-700">Tradutor:</label>
                        <input type="text" name="liv_tradutor" id="liv_tradutor" 
                               value="{{ old('liv_tradutor') }}"
                                 placeholder="Fulano de Tal"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="250">
                    </div>

                    
                    <!-- Idioma (FK) - Dropdown Search -->
                    <div class="mb-4">
                        <label for="liv_idioma" class="block font-medium text-sm text-gray-700">Idioma:</label>
                        <select name="liv_idioma" id="liv_idioma" 
                                class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="">-- Selecione o Idioma --</option>
                            @php
                                $idiomas = [
                                    'Mandarim', 'Espanhol', 'Inglês', 'Hindi', 'Árabe', 'Bengali', 'Português', 'Russo', 'Japonês', 'Lahnda',
                                    'Alemão', 'Coreano', 'Francês', 'Telugu', 'Marathi', 'Turco', 'Tâmil', 'Vietnamita', 'Urdu', 'Javanês',
                                    'Italiano', 'Egípcio', 'Gujarati', 'Iraniano', 'Bhojpuri', 'Min Nan', 'Hakka', 'Jin', 'Hausa', 'Kannada',
                                    'Indonésio', 'Polonês', 'Iorubá', 'Xiang', 'Malaio', 'Odia', 'Birmanês', 'Sudanês', 'Albanês', 'Romeno',
                                    'Cebuano', 'Neerlandês', 'Tagalo', 'Thai', 'Grego', 'Húngaro', 'Sueco', 'Tailandês', 'Búlgaro', 'Dinamarquês', 'Outros'
                                ];
                            @endphp
                            @foreach($idiomas as $idioma)
                                <option value="{{ $idioma }}" {{ old('liv_idioma', 'Português') == $idioma ? 'selected' : '' }}>
                                    {{ $idioma }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    
                    <!-- Tipo de Material -->
                    <div class="mb-4">
                        <label for="liv_tipo_material" class="block font-medium text-sm text-gray-700">Tipo de Material:</label>
                        <select name="liv_tipo_material" id="liv_tipo_material" 
                                class="select2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="livro" {{ old('liv_tipo_material', 'livro') == 'livro' ? 'selected' : '' }}>Livro</option>
                            <option value="revista" {{ old('liv_tipo_material') == 'revista' ? 'selected' : '' }}>Revista</option>
                            <option value="jornal" {{ old('liv_tipo_material') == 'jornal' ? 'selected' : '' }}>Jornal</option>
                            <option value="periodico" {{ old('liv_tipo_material') == 'periodico' ? 'selected' : '' }}>Periódico</option>
                            <option value="filme" {{ old('liv_tipo_material') == 'filme' ? 'selected' : '' }}>Filme</option>
                            <option value="cd" {{ old('liv_tipo_material') == 'cd' ? 'selected' : '' }}>CD</option>
                            <option value="dvd" {{ old('liv_tipo_material') == 'dvd' ? 'selected' : '' }}>DVD</option>
                            <option value="obras_de_arte" {{ old('liv_tipo_material') == 'obras_de_arte' ? 'selected' : '' }}>Obras de Arte</option>
                            <option value="outros" {{ old('liv_tipo_material') == 'outros' ? 'selected' : '' }}>Outros</option>
                        </select>
                    </div>

                    <!-- Quantidade -->
                    <div class="mb-4">
                        <label for="liv_quantidade" class="block font-medium text-sm text-gray-700">Quantidade:</label>
                        <input type="number" name="liv_quantidade" id="liv_quantidade" 
                               value="1"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>
                    
                    <!-- Capa -->
                    <div class="mb-4">
                        <label for="liv_capa" class="block font-medium text-sm text-gray-700">Capa:</label>
                        <input type="file" name="liv_capa" id="liv_capa" 
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>

                    
                    <!-- Placeholder for Resumo -->
                    <div class="mb-4">
                        <label for="liv_resumo" class="block font-medium text-sm text-gray-700">Resumo:</label>
                        <textarea name="liv_resumo" id="liv_resumo" 
                                  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                  rows="4" placeholder="Dom Casmurro é uma obra de Machado de Assis que narra a história de Bento Santiago, um homem que busca reconstruir seu passado e entender os eventos que levaram ao seu ciúme e desconfiança em relação à sua esposa, Capitu."></textarea>
                    </div>

                    <!-- Estante -->
                    <div class="mb-4">
                        <label for="liv_estante" class="block font-medium text-sm text-gray-700">Estante:</label>
                        <input type="text" name="liv_estante" id="liv_estante" 
                               value="{{ old('liv_estante') }}"
                               placeholder="Estante 13 Prateleira 2"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="100">
                    </div>

                    
                    <!-- Chamada -->
                    <div class="mb-4">
                        <label for="liv_chamada" class="block font-medium text-sm text-gray-700">Chamada:</label>
                        <input type="text" name="liv_chamada" id="liv_chamada" 
                               value="{{ old('liv_chamada') }}"
                               placeholder="ASSIS, M. Dom Casmurro"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="100">
                    </div>

                   
                    <button type="submit" 
                            class="px-4 py-2 bg-green-500 text-white font-semibold rounded hover:bg-green-600">
                        Salvar
                    </button>
                    <a href="{{ route('livros.index') }}" 
                       class="ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                </form>

            </div>
        </div>
    </div>

    <!-- Incluindo jQuery e Select2 (CDN) para dropdownSearch -->
    <!-- Ajuste a versão/conexão se preferir local ou outra lib -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"
            
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" 
          rel="stylesheet" />

    <script>
        $(document).ready(function() {
            // Inicializa todos os selects com class="select2" como dropdownSearch
            $('.select2').select2({
                placeholder: 'Pesquisar...',
                allowClear: true
            });
        });
    </script>
</x-app-layout>
