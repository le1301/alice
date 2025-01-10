<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Livros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">

                <!-- Mensagem de sucesso (desaparece após 4s) -->
                @if(session('success'))
                    <div id="success-message" class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Campo de busca -->
                <form method="GET" action="{{ route('livros.index') }}" class="flex items-center space-x-2 mb-4">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ $q ?? '' }}" 
                        placeholder="Buscar por título..." 
                        class="border border-gray-300 rounded-md px-2 py-1 focus:outline-none focus:ring-indigo-500"
                    >
                    <button 
                        type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded"
                    >
                        Buscar
                    </button>
                </form>

                <!-- Botão "Cadastrar novo Livro" -->
                <a 
                    href="{{ route('livros.create') }}" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Cadastrar novo Livro
                </a>

                <!-- Tabela de livros -->
                <table class="w-full mt-4 border">
                    <thead class="border-b bg-gray-50">
                        <tr>
                            <th class="py-2 px-4">Tombo</th>
                            <th class="py-2 px-4">Título</th>
                            <th class="py-2 px-4">Autor</th>
                            <th class="py-2 px-4">Qtd</th>
                            <th class="py-2 px-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($livros as $livro)
                            <tr class="border-b">
                                <!-- Tombo -->
                                <td class="py-2 px-4">
                                    {{ $livro->liv_id ?? '—' }}
                                </td>
                                <!-- Título -->
                                <td class="py-2 px-4">
                                    {{ $livro->liv_titulo }}
                                </td>
                                <!-- Autor (exibindo nome, se houver relacionamento) -->
                                <td class="py-2 px-4">
                                    @if($livro->autor)
                                        {{ $livro->autor->aut_nome }}
                                    @else
                                        <span class="text-gray-500">Sem autor</span>
                                    @endif
                                </td>
                                <!-- Quantidade -->
                                <td class="py-2 px-4">
                                    {{ $livro->liv_quantidade ?? 0 }}
                                </td>
                                <!-- Ações -->
                                <td class="py-2 px-4">
                                    <a 
                                        href="{{ route('livros.edit', $livro->liv_id) }}" 
                                        class="text-blue-600 underline"
                                    >
                                        Editar
                                    </a>
                                    |
                                    <form 
                                        action="{{ route('livros.destroy', $livro->liv_id) }}" 
                                        method="POST" 
                                        class="inline"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este livro?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="text-red-600 underline"
                                        >
                                            Deletar
                                        </button>
                                    </form>
                                    |
                                    <a 
                                        href="{{ route('livros.show', $livro->liv_id) }}" 
                                        class="text-green-600 underline"
                                    >
                                        Ficha
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $livros->appends(['q' => $q ?? ''])->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- Script para ocultar mensagem de sucesso após 4s -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMsg = document.getElementById('success-message');
            if (successMsg) {
                setTimeout(() => {
                    successMsg.style.display = 'none';
                }, 4000);
            }
        });
    </script>
</x-app-layout>
