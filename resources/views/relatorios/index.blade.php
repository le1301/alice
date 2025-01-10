<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relatórios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-semibold mb-6">Selecione o Relatório</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Relatório de Livros -->
                    <a href="/relatorios/livros-html" 
                       class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded text-center">
                        Relatório de Livros Cadastrados
                    </a>

                    <!-- Relatório de Alunos -->
                    <a href="/relatorios/alunos" 
                       class="block bg-green-500 hover:bg-green-700 text-white font-bold py-4 px-6 rounded text-center">
                        Relatório de Alunos e Servidores Cadastrados
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
