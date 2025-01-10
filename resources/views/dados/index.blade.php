<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informações Cadastrais') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                @if (session('success'))
                    <div id="success-message" class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif
                <!--Botão oculto cadastro-->
                <!--a href="{{ route('dados.create') }}" class="text-blue-500 underline">Criar novo dado</a-->

                <table class="w-full mt-4">
                    <thead class="border-b">
                        <tr>
                            <!--th class="py-2">ID</th-->
                            <th class="py-2">Nome</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $dado)
                            <tr class="border-b">
                                <!--td class="py-2">{{ $dado->dad_id }}</td-->
                                <td class="py-2">{{ $dado->dad_nome }}</td>
                                <td class="py-2">
                                    <a href="{{ route('dados.edit', $dado->dad_id) }}" class="text-blue-500 underline">Editar</a> |
                                    <!--form action="{{ route('dados.destroy', $dado->dad_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 underline" onclick="return confirm('Tem certeza que deseja excluir este dado?')">Deletar</button>
                                    </form-->
                                    <a href="{{ route('dados.show', $dado->dad_id) }}" class="text-green-500 underline">Ver Detalhes</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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
