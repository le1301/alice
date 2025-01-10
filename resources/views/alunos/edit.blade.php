<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Aluno') }}
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

                <form action="{{ route('alunos.update', $aluno->alu_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- alu_nome -->
                    <div class="mb-4">
                        <label for="alu_nome" class="block font-medium text-sm text-gray-700">Nome:</label>
                        <input type="text" name="alu_nome" id="alu_nome"
                               value="{{ old('alu_nome', $aluno->alu_nome) }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               required>
                    </div>

                    <!-- alu_ra -->
                    <div class="mb-4">
                        <label for="alu_ra" class="block font-medium text-sm text-gray-700">RA:</label>
                        <input type="text" name="alu_ra" id="alu_ra"
                               value="{{ old('alu_ra', $aluno->alu_ra) }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>

                    <!-- alu_digito_ra -->
                    <div class="mb-4">
                        <label for="alu_digito_ra" class="block font-medium text-sm text-gray-700">Dígito RA:</label>
                        <input type="text" name="alu_digito_ra" id="alu_digito_ra"
                               value="{{ old('alu_digito_ra', $aluno->alu_digito_ra) }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="2">
                    </div>

                    <!-- alu_uf_ra (select de estados) -->
                    <div class="mb-4">
                        <label for="alu_uf_ra" class="block font-medium text-sm text-gray-700">UF RA:</label>
                        <select name="alu_uf_ra" id="alu_uf_ra"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="">-- Selecione --</option>
                            @foreach($estadosBrasil as $estado)
                                <option value="{{ $estado }}"
                                    @if(old('alu_uf_ra', $aluno->alu_uf_ra) == $estado) selected @endif>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- alu_turma -->
                    <div class="mb-4">
                        <label for="alu_turma" class="block font-medium text-sm text-gray-700">Turma:</label>
                        <input type="text" name="alu_turma" id="alu_turma"
                               value="{{ old('alu_turma', $aluno->alu_turma) }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="200">
                    </div>

                    <!-- alu_fone1 -->
                    <div class="mb-4">
                        <label for="alu_fone1" class="block font-medium text-sm text-gray-700">Fone 1:</label>
                        <input type="text" name="alu_fone1" id="alu_fone1"
                               value="{{ old('alu_fone1', $aluno->alu_fone1) }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="30">
                    </div>

                    <!-- alu_fone2 -->
                    <div class="mb-4">
                        <label for="alu_fone2" class="block font-medium text-sm text-gray-700">Fone 2:</label>
                        <input type="text" name="alu_fone2" id="alu_fone2"
                               value="{{ old('alu_fone2', $aluno->alu_fone2) }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="30">
                    </div>

                    <!-- alu_email -->
                    <div class="mb-4">
                        <label for="alu_email" class="block font-medium text-sm text-gray-700">Email:</label>
                        <input type="email" name="alu_email" id="alu_email"
                               value="{{ old('alu_email', $aluno->alu_email) }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                               maxlength="250">
                    </div>

                    <!-- alu_status (select com opções fixas) -->
                    <div class="mb-4">
                        <label for="alu_status" class="block font-medium text-sm text-gray-700">Status:</label>
                        <select name="alu_status" id="alu_status"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="">-- Selecione --</option>
                            @foreach($listaStatus as $status)
                                <option value="{{ $status }}"
                                    @if(old('alu_status', $aluno->alu_status) == $status) selected @endif>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- alu_obs -->
                    <div class="mb-4">
                        <label for="alu_obs" class="block font-medium text-sm text-gray-700">Observações:</label>
                        <textarea name="alu_obs" id="alu_obs" rows="4"
                                  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">{{ old('alu_obs', $aluno->alu_obs) }}</textarea>
                    </div>

                    <!-- alu_dados (chave estrangeira para tabela dados) -->
                    <div class="mb-4">
                        <label for="alu_dados" class="block font-medium text-sm text-gray-700">Dados (Entidade):</label>
                        <select name="alu_dados" id="alu_dados"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="">-- Selecione --</option>
                            @foreach($listaDados as $dado)
                                <option value="{{ $dado->dad_id }}"
                                    @if(old('alu_dados', $aluno->alu_dados) == $dado->dad_id) selected @endif>
                                    {{ $dado->dad_nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Foto Atual -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Foto Atual:</label>
                        @if($aluno->alu_foto && file_exists(public_path($aluno->alu_foto)))
                            <img src="{{ asset($aluno->alu_foto) }}" alt="{{ $aluno->alu_nome }}" 
                                 class="w-16 h-16 object-cover rounded-full mt-2">
                        @else
                            <span class="text-gray-500">Sem foto</span>
                        @endif
                    </div>

                    <!-- Nova Foto -->
                    <div class="mb-4">
                        <label for="alu_foto" class="block font-medium text-sm text-gray-700">Nova Foto (Imagem):</label>
                        <input type="file" name="alu_foto" id="alu_foto"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <small class="text-gray-500">Formatos: jpg, png. Máx 2MB.</small>
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-600">
                            Atualizar
                        </button>

                        <a href="{{ route('alunos.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-white hover:bg-gray-600">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
