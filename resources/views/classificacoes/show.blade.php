<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes da Classificação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">

                <h3 class="text-xl font-bold mb-4">ID #{{ $classificacao->cla_id }}</h3>
                <p><strong>CDD:</strong> {{ $classificacao->cla_cdd }}</p>
                <p><strong>Título:</strong> {{ $classificacao->cla_titulo }}</p>

                <a href="{{ route('classificacoes.index') }}" class="inline-block mt-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Voltar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
