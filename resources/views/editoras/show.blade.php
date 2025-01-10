<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes da Editora') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-xl font-bold mb-4">{{ $editora->edi_nome }}</h3>
                <!-- Aqui você pode colocar mais detalhes sobre a editora, caso existam outras colunas -->
                
                <a href="{{ route('editoras.index') }}" class="text-blue-500 underline">Voltar</a>
            </div>
        </div>
    </div>
</x-app-layout>
