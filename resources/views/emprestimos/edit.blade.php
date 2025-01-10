<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Renovar Empréstimo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach($errors->all() as $error)
                               <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('emprestimos.update', $emprestimo->emp_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="emp_data_retirada" class="block font-medium text-sm text-gray-700">
                            Data Retirada:
                        </label>
                        <input type="date" name="emp_data_retirada" id="emp_data_retirada"
                               value="{{ old('emp_data_retirada', $emprestimo->emp_data_retirada) }}"
                               class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="emp_data_devolucao" class="block font-medium text-sm text-gray-700">
                            Data Devolução:
                        </label>
                        <input type="date" name="emp_data_devolucao" id="emp_data_devolucao"
                               value="{{ old('emp_data_devolucao', $emprestimo->emp_data_devolucao) }}"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div class="mb-4">
                        <label for="emp_aluno" class="block font-medium text-sm text-gray-700">
                            Aluno:
                        </label>
                        <!-- Campo apenas para exibição -->
                        <input type="text" id="emp_aluno_visual" 
                            value="{{ $emprestimo->aluno->alu_nome }}" 
                            class="border-gray-300 rounded-md shadow-sm w-full" readonly>
                        <!-- Campo hidden para enviar o valor real -->
                        <input type="hidden" name="emp_aluno" value="{{ $emprestimo->emp_aluno }}">
                    </div>


                    <!-- Usuario continua o mesmo, ou poderia permitir trocar -->

                    <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">
                        Atualizar
                    </button>
                    <a href="{{ route('emprestimos.index') }}"
                       class="ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
