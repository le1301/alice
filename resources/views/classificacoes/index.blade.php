<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Classificações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulário de busca -->
                <div class="flex justify-between items-center mb-4">
                    <form method="GET" action="{{ route('classificacoes.index') }}" class="flex">
                        <input type="text" name="search" placeholder="Buscar por CDD ou título" 
                               class="border rounded py-2 px-4 mr-2 w-64" value="{{ request('search') }}">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Buscar
                        </button>
                        <a href="{{ route('classificacoes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Limpar
                        </a>
                    </form>

                    <!-- Botões adicionais -->
                    <div class="flex">
                        <a href="{{ route('classificacoes.create') }}" 
                           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cadastrar novo
                        </a>
                        <!--Gerar em pdf requer mais memória ram-->
                        <a href="{{ route('classificacoes.pdf') }}" 
                           class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Imprimir Listagem
                        </a>
                    </div>
                </div>

                <!-- Tabela de classificações -->
                <table class="w-full mt-4 border">
                    <thead class="border-b">
                        <tr>
                            <!--th class="py-2 px-4">ID</th-->
                            <th class="py-2 px-4">CDD</th>
                            <th class="py-2 px-4">Título</th>
                            <th class="py-2 px-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classificacoes as $classificacao)
                            <tr class="border-b">
                                <!--td class="py-2 px-4">{{ $classificacao->cla_id }}</td-->
                                <td class="py-2 px-4">{{ $classificacao->cla_cdd }}</td>
                                <td class="py-2 px-4">{{ $classificacao->cla_titulo }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('classificacoes.edit', $classificacao->cla_id) }}" class="text-blue-500 underline">Editar</a> |
                                    <form action="{{ route('classificacoes.destroy', $classificacao->cla_id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta classificação?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 underline">Deletar</button>
                                    </form> 
                                    <!--a href="{{ route('classificacoes.show', $classificacao->cla_id) }}" class="text-green-500 underline">Ver Detalhes</a-->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $classificacoes->links() }}
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
