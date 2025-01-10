<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alunos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                @if (session('success'))
                    <div id="success-message" class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('alunos.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Cadastrar novo aluno
                    </a>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <form method="GET" action="{{ route('alunos.index') }}" class="flex">
                        <input type="text" name="search" placeholder="Buscar aluno pelo nome" class="border rounded py-2 px-4 mr-2 w-64" value="{{ request('search') }}">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Buscar</button>
                        <a href="{{ route('alunos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Limpar</a>
                    </form>
                </div>

                <table class="w-full mt-4">
                    <thead class="border-b text-left">
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Nome</th>
                            <th class="py-2">Turma</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Foto</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        @forelse ($alunos as $aluno)
                            <tr class="border-b">
                                <td class="py-2">{{ $aluno->alu_id }}</td>
                                <td class="py-2">{{ $aluno->alu_nome }}</td>
                                <td class="py-2">{{ $aluno->alu_turma }}</td>
                                <td class="py-2">{{ $aluno->alu_email }}</td>
                                <td class="py-2">
                                    @if($aluno->alu_foto && file_exists(public_path($aluno->alu_foto)))
                                        <img src="{{ asset($aluno->alu_foto) }}" alt="{{ $aluno->alu_nome }}" class="w-16 h-16 object-cover rounded-full">
                                    @else
                                        <span class="text-gray-500">Sem foto</span>
                                    @endif
                                </td>
                                <td class="py-2">
                                    <a href="{{ route('alunos.edit', $aluno->alu_id) }}" class="text-blue-500 underline">Editar</a> |
                                    <form action="{{ route('alunos.destroy', $aluno->alu_id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 underline">Deletar</button>
                                    </form> |
                                    <a href="{{ route('alunos.show', $aluno->alu_id) }}" class="text-green-500 underline">Ficha</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">Nenhum aluno encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $alunos->links() }}
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
                }, 5000);
            }
        });
    </script>
</x-app-layout>
