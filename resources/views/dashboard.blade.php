<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        // Carrega os dados (dad_id=1) para obter 'dad_fundo'
        $dadosEscola = \App\Models\Dado::find(1);

        // Monta o path da imagem de fundo
        $bgFundo = $dadosEscola && $dadosEscola->dad_fundo
                   ? asset($dadosEscola->dad_fundo)
                   : asset('img/fundo-dashboard.jpg');

        // Contadores
        $totalLivros = \App\Models\Livro::count();
        $totalAlunos = \App\Models\Aluno::count();
        $totalEmprestimos = \App\Models\Emprestimo::count();
    @endphp

    <!-- Área principal com imagem de fundo -->
    <div class="py-12"
         style="background-image: url('{{ $bgFundo }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Mensagem acima dos cards, com transparência -->
            <div class="bg-white bg-opacity-70 p-4 mb-8 rounded">
                <p class="text-gray-800 text-lg font-semibold">
                    {{ Auth::user()->name }}, {{ __("bem-vindo(a)!") }}
                </p>
            </div>

            <!-- Grid de Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card: Livros -->
                <div class="bg-white bg-opacity-70 overflow-hidden shadow-sm rounded-lg p-6 text-center">
                    <h3 class="text-lg font-bold text-gray-700 mb-2">Total de Obras Cadastradas</h3>
                    <p class="text-3xl font-extrabold text-indigo-600">{{ $totalLivros }}</p>
                </div>

                <!-- Card: Alunos -->
                <div class="bg-white bg-opacity-70 overflow-hidden shadow-sm rounded-lg p-6 text-center">
                    <h3 class="text-lg font-bold text-gray-700 mb-2">Total de Alunos/Servidores</h3>
                    <p class="text-3xl font-extrabold text-green-600">{{ $totalAlunos }}</p>
                </div>

                <!-- Card: Empréstimos -->
                <div class="bg-white bg-opacity-70 overflow-hidden shadow-sm rounded-lg p-6 text-center">
                    <h3 class="text-lg font-bold text-gray-700 mb-2">Total de Empréstimos</h3>
                    <p class="text-3xl font-extrabold text-red-600">{{ $totalEmprestimos }}</p>
                </div>
            </div>
        </div>
    </div>

    

    
</x-app-layout>
