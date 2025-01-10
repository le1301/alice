<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Aluno') }}
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

                <form action="{{ route('alunos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- alu_nome -->
                    <div class="mb-4">
                        <label for="alu_nome" class="block font-medium text-sm text-gray-700">Nome:</label>
                        <input type="text" name="alu_nome" id="alu_nome" placeholder="Nome completo" 
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" 
                               required>
                    </div>
                    
                    <!-- alu_ra -->
                    <div class="mb-4">
                        <label for="alu_ra" class="block font-medium text-sm text-gray-700">RA:</label>
                        <input type="text" name="alu_ra" id="alu_ra" placeholder="Exemplo: 123.456.789" 
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>
                    
                    <!-- alu_digito_ra -->
                    <div class="mb-4">
                        <label for="alu_digito_ra" class="block font-medium text-sm text-gray-700">Dígito do RA:</label>
                        <input type="text" name="alu_digito_ra" id="alu_digito_ra" placeholder="Exemplo: 0" 
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" maxlength="1">
                    </div>
                    
                    <!-- alu_uf_ra -->
                    <div class="mb-4">
                        <label for="alu_uf_ra" class="block font-medium text-sm text-gray-700">UF RA:</label>
                        <select name="alu_uf_ra" id="alu_uf_ra" 
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="AC" {{ old('alu_uf_ra') == 'AC' ? 'selected' : '' }}>AC</option>
                            <option value="AL" {{ old('alu_uf_ra') == 'AL' ? 'selected' : '' }}>AL</option>
                            <option value="AP" {{ old('alu_uf_ra') == 'AP' ? 'selected' : '' }}>AP</option>
                            <option value="AM" {{ old('alu_uf_ra') == 'AM' ? 'selected' : '' }}>AM</option>
                            <option value="BA" {{ old('alu_uf_ra') == 'BA' ? 'selected' : '' }}>BA</option>
                            <option value="CE" {{ old('alu_uf_ra') == 'CE' ? 'selected' : '' }}>CE</option>
                            <option value="DF" {{ old('alu_uf_ra') == 'DF' ? 'selected' : '' }}>DF</option>
                            <option value="ES" {{ old('alu_uf_ra') == 'ES' ? 'selected' : '' }}>ES</option>
                            <option value="GO" {{ old('alu_uf_ra') == 'GO' ? 'selected' : '' }}>GO</option>
                            <option value="MA" {{ old('alu_uf_ra') == 'MA' ? 'selected' : '' }}>MA</option>
                            <option value="MT" {{ old('alu_uf_ra') == 'MT' ? 'selected' : '' }}>MT</option>
                            <option value="MS" {{ old('alu_uf_ra') == 'MS' ? 'selected' : '' }}>MS</option>
                            <option value="MG" {{ old('alu_uf_ra') == 'MG' ? 'selected' : '' }}>MG</option>
                            <option value="PA" {{ old('alu_uf_ra') == 'PA' ? 'selected' : '' }}>PA</option>
                            <option value="PB" {{ old('alu_uf_ra') == 'PB' ? 'selected' : '' }}>PB</option>
                            <option value="PR" {{ old('alu_uf_ra') == 'PR' ? 'selected' : '' }}>PR</option>
                            <option value="PE" {{ old('alu_uf_ra') == 'PE' ? 'selected' : '' }}>PE</option>
                            <option value="PI" {{ old('alu_uf_ra') == 'PI' ? 'selected' : '' }}>PI</option>
                            <option value="RJ" {{ old('alu_uf_ra') == 'RJ' ? 'selected' : '' }}>RJ</option>
                            <option value="RN" {{ old('alu_uf_ra') == 'RN' ? 'selected' : '' }}>RN</option>
                            <option value="RS" {{ old('alu_uf_ra') == 'RS' ? 'selected' : '' }}>RS</option>
                            <option value="RO" {{ old('alu_uf_ra') == 'RO' ? 'selected' : '' }}>RO</option>
                            <option value="RR" {{ old('alu_uf_ra') == 'RR' ? 'selected' : '' }}>RR</option>
                            <option value="SC" {{ old('alu_uf_ra') == 'SC' ? 'selected' : '' }}>SC</option>
                            <option value="SP" {{ old('alu_uf_ra') == 'SP' ? 'selected' : 'selected' }}>SP</option>
                            <option value="SE" {{ old('alu_uf_ra') == 'SE' ? 'selected' : '' }}>SE</option>
                            <option value="TO" {{ old('alu_uf_ra') == 'TO' ? 'selected' : '' }}>TO</option>
                        </select>
                    </div>
                    
                    <!-- alu_turma -->
                    <div class="mb-4">
                        <label for="alu_turma" class="block font-medium text-sm text-gray-700">Turma:</label>
                        <input type="text" name="alu_turma" id="alu_turma" placeholder="2ª SÉRIE A" 
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" maxlength="200">
                    </div>
                    
                    <!-- alu_fone1 -->
                    <div class="mb-4">
                        <label for="alu_fone1" class="block font-medium text-sm text-gray-700">Celular:</label>
                        <input type="text" name="alu_fone1" id="alu_fone1" placeholder="(99) 99999-9999" 
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" maxlength="30">
                    </div>
                    
                    <!-- alu_fone2 -->
                    <div class="mb-4">
                        <label for="alu_fone2" class="block font-medium text-sm text-gray-700">Telefone fixo ou recado:</label>
                        <input type="text" name="alu_fone2" id="alu_fone2" placeholder="(99) 99999-9999" 
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" maxlength="30">
                    </div>
                    
                    <!-- alu_email -->
                    <div class="mb-4">
                        <label for="alu_email" class="block font-medium text-sm text-gray-700">Email:</label>
                        <input type="email" name="alu_email" id="alu_email" placeholder="00001234567890sp@aluno.educacao.sp.gov.br" 
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" maxlength="250">
                    </div>
                    
                    <!-- alu_status -->
                    <div class="mb-4">
                        <label for="alu_status" class="block font-medium text-sm text-gray-700">Categoria:</label>
                        <select name="alu_status" id="alu_status" 
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <option value="" {{ old('alu_status') == '' ? 'selected' : '' }}>-- Selecione --</option>
                            <option value="Aluno(a)" {{ old('alu_status') == 'Aluno(a)' ? 'selected' : 'selected' }}>Aluno(a)</option>
                            <option value="Professor(a)" {{ old('alu_status') == 'Professor(a)' ? 'selected' : '' }}>Professor(a)</option>
                            <option value="Gestor(a)" {{ old('alu_status') == 'Gestor(a)' ? 'selected' : '' }}>Gestor(a)</option>
                            <option value="Servidor(a)" {{ old('alu_status') == 'Servidor(a)' ? 'selected' : '' }}>Servidor(a)</option>
                            <option value="Inativo" {{ old('alu_status') == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                    
                    <!-- alu_foto -->
                    <div class="mb-4">
                        <label for="alu_foto" class="block font-medium text-sm text-gray-700">Foto (Imagem):</label>
                        <input type="file" name="alu_foto" id="alu_foto" 
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <small class="text-gray-500">Formatos: jpg, png, etc. Máx: 2MB</small>
                    </div>
                    
                    <!-- alu_obs -->
                    <div class="mb-4">
                        <label for="alu_obs" class="block font-medium text-sm text-gray-700">Observações:</label>
                        <textarea name="alu_obs" id="alu_obs" rows="4"
                                  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">{{ old('alu_obs') }}</textarea>
                    </div>
                    
                    <!-- alu_dados: agora um SELECT com a lista de dados, exibindo dad_nome e salvando dad_id -->
                    <div class="mb-4">
                        <label for="alu_dados" class="block font-medium text-sm text-gray-700">Instituição:</label>
                        <select name="alu_dados" id="alu_dados" 
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            <!--option value="">-- Selecione --</option-->
                            @foreach($listaDados as $dado)
                                <option value="{{ $dado->dad_id }}" {{ old('alu_dados', 1) == $dado->dad_id ? 'selected' : '' }}>{{ $dado->dad_nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-white hover:bg-green-600">
                            Cadastrar
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

    <!-- Inclui jQuery primeiro -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
         
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Inclui jquery.inputmask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js" 
         
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
            // Aplica a máscara de telefone/celular (99) [9]9999-9999
            $('#alu_fone1').inputmask("(99) [9]9999-9999");
            $('#alu_fone2').inputmask("(99) [9]9999-9999");
        });
    </script>
</x-app-layout>
