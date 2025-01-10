<!-- resources/views/emprestimos/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empréstimos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                @if(session('success'))
                    <div id="success-message" class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Botões de ação no topo --}}
                <div class="flex items-center mb-4 space-x-3">
                    {{-- Botão "Novo Empréstimo" --}}
                    <a href="{{ route('emprestimos.create') }}"
                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Novo Empréstimo
                    </a>

                    {{-- Botão "Somente Atrasados" --}}
                    @if($somenteAtrasados == '1')
                        {{-- Se já está filtrando atrasados, exibe botão para "Todos" --}}
                        <a href="{{ route('emprestimos.index') }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                           Mostrar Todos
                        </a>
                    @else
                        <a href="{{ route('emprestimos.index', ['atrasados' => '1']) }}"
                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                           Somente Atrasados
                        </a>
                    @endif
                </div>

                {{-- Formulário de Busca (por aluno ou livro) --}}
                <form method="GET" action="{{ route('emprestimos.index') }}" class="flex items-center mb-4 space-x-2">
                    <input type="text" name="q" value="{{ $q ?? '' }}"
                           placeholder="Buscar por aluno ou livro..."
                           class="border border-gray-300 rounded-md px-2 py-1 w-1/3"
                    >

                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Buscar
                    </button>

                    @if(!empty($q))
                        <a href="{{ route('emprestimos.index') }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                           Limpar
                        </a>
                    @endif
                </form>

                <table class="w-full border">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2">Data Retirada</th>
                            <th class="px-4 py-2">Aluno</th>
                            <th class="px-4 py-2">Livro</th>
                            <th class="px-4 py-2">Data Devolução (Prevista)</th>
                            <th class="px-4 py-2">Devolvido em</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($linhas as $row)
                            @php
                                // Se $row['atrasado'] for true, destacar a linha
                                $rowClass = $row['atrasado'] ? 'bg-red-100' : '';
                            @endphp
                            <tr class="border-b {{ $rowClass }}">
                                <td class="px-4 py-2">{{ $row['emp_data_retirada'] }}</td>
                                <td class="px-4 py-2">{{ $row['alu_nome'] }}</td>
                                <td class="px-4 py-2">{{ $row['liv_titulo'] }}</td>
                                <td class="px-4 py-2">{{ $row['emp_data_devolucao'] }}</td>
                                <td class="px-4 py-2">{{ $row['data_devolvido'] }}</td>
                                <td class="px-4 py-2">
                                    @if($row['data_devolvido'] == '—')
                                        {{-- Botão Renovar -> chama route('emprestimos.edit', $row['emp_id']) --}}
                                        <a href="{{ route('emprestimos.edit', $row['emp_id']) }}"
                                           class="text-orange-600 underline mr-2">
                                           Renovar
                                        </a>
                                        {{-- Botão Devolver -> patch emprestimos/{emp_id}/{liv_id}/devolver --}}
                                        <form action="{{ route('emprestimos_livros.devolver', [$row['emp_id'], $row['liv_id']]) }}"
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Marcar este livro como devolvido?');">
                                            @csrf
                                            @method('PATCH')
                                            <button class="text-blue-600 underline">
                                                Devolver
                                            </button>

                                            {{-- Botão PDF Comprovante --}}
                                    <a href="{{ route('emprestimos.comprovante_pdf', $row['emp_id']) }}"
                                    class="text-green-600 underline ml-2"
                                    target="_blank">
                                    PDF
                                    </a>
                                        </form>
                                    @else
                                        <span class="text-gray-500">Livro devolvido</span>
                                    @endif

                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-gray-500">
                                    Nenhum registro encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded',() => {
            const msg = document.getElementById('success-message');
            if(msg) {
                setTimeout(() => msg.style.display='none',4000);
            }
        });
    </script>
</x-app-layout>
