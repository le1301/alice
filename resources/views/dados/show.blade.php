<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dados Cadastrais') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-xl font-bold mb-4">{{ $dado->dad_nome }}</h3>
                <p><strong>Endereço:</strong> {{ $dado->dad_endereco }}</p>
                <p><strong>Fone:</strong> {{ $dado->dad_fone }}</p>
                <p><strong>Celular:</strong> {{ $dado->dad_celular }}</p>
                <p><strong>Email:</strong> {{ $dado->dad_email }}</p>
                <p><strong>Site:</strong> {{ $dado->dad_site }}</p>

                <p><strong>Logo:</strong><br>
                    @if($dado->dad_logo && file_exists(public_path($dado->dad_logo)))
                        <img src="{{ asset($dado->dad_logo) }}" alt="Logo" class="max-w-xs max-h-48 object-contain mt-2">
                    @else
                        <span class="text-gray-500">Nenhuma logo definida</span>
                    @endif
                </p>

                <p class="mt-4"><strong>Fundo:</strong><br>
                    @if($dado->dad_fundo && file_exists(public_path($dado->dad_fundo)))
                        <img src="{{ asset($dado->dad_fundo) }}" alt="Fundo" class="max-w-xs max-h-48 object-cover mt-2">
                    @else
                        <span class="text-gray-500">Nenhum fundo definido</span>
                    @endif
                </p>
                
                <a href="{{ route('dados.index') }}" class="text-blue-500 underline mt-4 inline-block">Voltar</a>
            </div>
        </div>
    </div>
</x-app-layout>
