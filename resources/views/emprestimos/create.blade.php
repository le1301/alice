<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Empréstimo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                {{-- Erros de validação --}}
                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('emprestimos.store') }}" method="POST">
                    @csrf

                    {{-- Aluno (Select2 busca remota ou local) --}}
                    <div class="mb-4">
                        <label for="emp_aluno" class="block font-medium text-sm text-gray-700">
                            Aluno:
                        </label>
                        <select name="emp_aluno" id="emp_aluno" class="select2-aluno w-full" required>
                            <option value="">-- Selecione o Aluno --</option>
                            {{-- 
                               Se tiver carregado $alunos de forma local, podemos listar aqui.
                               Caso vá buscar remotamente via AJAX, deixamos sem options.
                            --}}
                            @foreach($alunos as $aluno)
                                <option 
                                    value="{{ $aluno->alu_id }}" 
                                    {{ old('emp_aluno') == $aluno->alu_id ? 'selected' : '' }}>
                                    {{ $aluno->alu_nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Data Retirada --}}
                    <div class="mb-4">
                        <label for="emp_data_retirada" class="block font-medium text-sm text-gray-700">
                            Data Retirada:
                        </label>
                        <input type="date" name="emp_data_retirada" id="emp_data_retirada"
                               value="{{ old('emp_data_retirada', date('Y-m-d')) }}"
                               class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>

                    {{-- Data Devolução (Prevista) --}}
                    <div class="mb-4">
                        <label for="emp_data_devolucao" class="block font-medium text-sm text-gray-700">
                            Data Devolução (Prevista):
                        </label>
                        <input type="date" name="emp_data_devolucao" id="emp_data_devolucao"
                               value="{{ old('emp_data_devolucao') }}"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    {{-- Campo para adicionar Livros dinamicamente --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">
                            Adicionar Livros:
                        </label>

                        <div class="flex items-center space-x-2 mb-2">
                            {{-- Select2 de Livros --}}
                            <select id="select2-livro" class="select2-livro w-1/2" data-placeholder="Digite o título do livro...">
                                <option value="">-- Buscar Livro --</option>
                                {{-- 
                                   Se quiser local, pode inserir <option> aqui. 
                                   Se for remoto AJAX, deixe vazio e configure no JS.
                                --}}
                                @foreach($livros as $livro)
                                    <option value="{{ $livro->liv_id }}">{{ $livro->liv_titulo }}</option>
                                @endforeach
                            </select>

                            {{-- Input de Quantidade --}}
                            <input type="number" id="input-quantidade" 
                                   placeholder="Qtd" min="1" value="1"
                                   class="border-gray-300 rounded-md shadow-sm w-24">

                            <button type="button" id="btn-add-livro"
                                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">
                                Adicionar
                            </button>
                        </div>

                        {{-- Tabela para exibir os livros adicionados --}}
                        <table class="w-full border" id="tabela-livros">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2">Título</th>
                                    <th class="px-4 py-2">Quantidade</th>
                                    <th class="px-4 py-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Linhas adicionadas via JavaScript --}}
                            </tbody>
                        </table>
                    </div>

                    {{-- Botões --}}
                    <div class="mt-6 flex items-center space-x-4">
                        <button type="submit"
                                class="px-4 py-2 bg-green-500 text-white font-semibold rounded hover:bg-green-600">
                            Salvar Empréstimo
                        </button>
                        <a href="{{ route('emprestimos.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- jQuery + Select2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"
            
            crossorigin="anonymous"></script>
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

    <script>
      $(document).ready(function() {
          // Inicializa Select2 para Aluno
          $('.select2-aluno').select2({
              // se quiser AJAX remoto, configure aqui
              placeholder: 'Digite o nome do aluno...'
          });

          // Inicializa Select2 para Livro
          $('.select2-livro').select2({
              // se quiser AJAX remoto, configure aqui
              placeholder: 'Digite o título do livro...'
          });

          // Ao clicar em "Adicionar"
          $('#btn-add-livro').on('click', function() {
              const livroId = $('#select2-livro').val();
              const livroTexto = $('#select2-livro option:selected').text();
              const qtd = parseInt($('#input-quantidade').val());

              if(!livroId || qtd < 1) {
                  alert('Selecione um livro e digite uma quantidade válida.');
                  return;
              }

              // Verifica se livro já existe na tabela
              let jaExiste = false;
              $('#tabela-livros tbody tr').each(function(){
                  let rowLivroId = $(this).data('livroid');
                  if(rowLivroId == livroId) {
                      jaExiste = true;
                  }
              });
              if(jaExiste) {
                  alert('Este livro já foi adicionado. Remova ou altere a quantidade.');
                  return;
              }

              // Cria linha na tabela
              const newRow = `
                <tr data-livroid="${livroId}">
                  <td class="px-4 py-2">${livroTexto}</td>
                  <td class="px-4 py-2">${qtd}</td>
                  <td class="px-4 py-2">
                    <button type="button" class="btn-remove text-red-600 underline">
                      Remover
                    </button>
                  </td>
                </tr>
              `;
              $('#tabela-livros tbody').append(newRow);

              // Cria input hidden para enviar ao Controller
              // name="livros[livroId]" value="quantidade"
              let inputHidden = `<input type="hidden" 
                                     name="livros[${livroId}]" 
                                     value="${qtd}">`;
              $('#tabela-livros tbody tr:last').append(inputHidden);

              // Limpa a seleção
              $('#select2-livro').val(null).trigger('change');
              $('#input-quantidade').val('1');
          });

          // Ao clicar em Remover
          $('#tabela-livros').on('click', '.btn-remove', function(){
              $(this).closest('tr').remove();
          });
      });
    </script>
</x-app-layout>
