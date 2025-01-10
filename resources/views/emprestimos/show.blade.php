<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Empréstimo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-xl font-bold mb-4">Empréstimo #{{ $emprestimo->emp_id }}</h3>

                <p><strong>Data Retirada:</strong> {{ $emprestimo->emp_data_retirada }}</p>
                <p><strong>Data Devolução:</strong> {{ $emprestimo->emp_data_devolucao ?? '---' }}</p>
                <p><strong>Aluno:</strong> 
                   @if($emprestimo->aluno)
                       {{ $emprestimo->aluno->alu_nome }}
                   @endif
                </p>
                <p><strong>Usuário (Operador):</strong> 
                   @if($emprestimo->user)
                       {{ $emprestimo->user->name }}
                   @endif
                </p>

                <a href="{{ route('emprestimos.index') }}" 
                   class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">
                    Voltar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
