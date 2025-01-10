<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Informações Cadastrais') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('dados.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="dad_nome" class="block font-medium text-sm text-gray-700">Nome:</label>
                        <input type="text" name="dad_nome" id="dad_nome" value="{{ old('dad_nome') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="dad_endereco" class="block font-medium text-sm text-gray-700">Endereço:</label>
                        <input type="text" name="dad_endereco" id="dad_endereco" value="{{ old('dad_endereco') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>
                    <div class="mb-4">
                        <label for="dad_fone" class="block font-medium text-sm text-gray-700">Fone:</label>
                        <input type="text" name="dad_fone" id="dad_fone" value="{{ old('dad_fone') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>
                    <div class="mb-4">
                        <label for="dad_celular" class="block font-medium text-sm text-gray-700">Celular:</label>
                        <input type="text" name="dad_celular" id="dad_celular" value="{{ old('dad_celular') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>
                    <div class="mb-4">
                        <label for="dad_email" class="block font-medium text-sm text-gray-700">Email:</label>
                        <input type="email" name="dad_email" id="dad_email" value="{{ old('dad_email') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>
                    <div class="mb-4">
                        <label for="dad_site" class="block font-medium text-sm text-gray-700">Site:</label>
                        <input type="text" name="dad_site" id="dad_site" value="{{ old('dad_site') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>
                    <div class="mb-4">
                        <label for="dad_logo" class="block font-medium text-sm text-gray-700">Logo (Imagem):</label>
                        <input type="file" name="dad_logo" id="dad_logo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <small class="text-gray-500">Formatos: jpg, png, etc. Tamanho máximo: 2MB.</small>
                    </div>
                    <div class="mb-4">
                        <label for="dad_fundo" class="block font-medium text-sm text-gray-700">Imagem de Fundo (Imagem):</label>
                        <input type="file" name="dad_fundo" id="dad_fundo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <small class="text-gray-500">Formatos: jpg, png, etc. Tamanho máximo: 2MB.</small>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-white hover:bg-green-600">
                            Cadastrar
                        </button>

                        <a href="{{ route('dados.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-white hover:bg-gray-600">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Inclua o jQuery primeiro -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Agora o jquery.inputmask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        $(document).ready(function(){
            // Aplica a máscara usando jQuery Inputmask
            $('#dad_fone').inputmask("(99) 9999-9999");
            $('#dad_celular').inputmask("(99) [9]9999-9999");
        });
    </script>
</x-app-layout>
