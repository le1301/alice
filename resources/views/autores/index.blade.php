<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Autores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                @if (session('success'))
                    <div id="success-message" class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <!-- Botão para cadastrar novo autor -->
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('autores.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Cadastrar novo autor
                    </a>
                </div>

                <!-- Formulário de busca -->
                <div class="flex justify-between items-center mb-4">
                    <form method="GET" action="{{ route('autores.index') }}" class="flex w-full">
                        <input type="text" name="search" placeholder="Buscar autor pelo nome" class="border rounded py-2 px-4 mr-2 w-full" value="{{ request('search') }}">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Buscar</button>
                        <a href="{{ route('autores.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Limpar</a>
                    </form>
                </div>

                <!-- Tabela de autores -->
                <table class="w-full mt-4">
                    <thead class="border-b text-left">
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Nome</th>
                            <th class="py-2">Foto</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($autores as $autor)
                            <tr class="border-b">
                                <td class="py-2">{{ $autor->aut_id }}</td>
                                <td class="py-2">{{ $autor->aut_nome }}</td>
                                <td class="py-2">
                                    @if($autor->aut_foto && file_exists(public_path($autor->aut_foto)))
                                        <img src="{{ asset($autor->aut_foto) }}" alt="{{ $autor->aut_nome }}" class="w-16 h-16 object-cover rounded-full">
                                    @else
                                        <span class="text-gray-500">Sem foto</span>
                                    @endif
                                </td>
                                <td class="py-2">
                                    <a href="{{ route('autores.edit', $autor->aut_id) }}" class="text-blue-500 underline">Editar</a> |
                                    <form action="{{ route('autores.destroy', $autor->aut_id) }}" method="POST" class="inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 underline">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $autores->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000); // Mensagem desaparece após 5 segundos
            }

            // Selecionar todos os formulários de deleção
            const deleteForms = document.querySelectorAll('.form-delete');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    // Exibe uma caixa de confirmação
                    const confirmed = confirm('Tem certeza que deseja excluir este autor?');
                    if (!confirmed) {
                        // Se o usuário cancelar, previne o envio do formulário
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    
</x-app-layout>
