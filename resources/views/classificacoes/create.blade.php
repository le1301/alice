<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Classificação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('classificacoes.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="cla_cdd" class="block font-medium text-sm text-gray-700">CDD:</label>
                        <input type="text" name="cla_cdd" id="cla_cdd" value="{{ old('cla_cdd') }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="cla_titulo" class="block font-medium text-sm text-gray-700">Título:</label>
                        <input type="text" name="cla_titulo" id="cla_titulo" value="{{ old('cla_titulo') }}"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Salvar
                    </button>
                    <a href="{{ route('classificacoes.index') }}" class="ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
