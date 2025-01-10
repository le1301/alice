<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ficha Cadastral') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-xl font-bold mb-4">{{ $aluno->alu_nome }}</h3>
                <h6 class="text-sm text-gray-500 mb-4">{{ $aluno->alu_status }}</h6>
                <p class="mt-4"><strong>Foto:</strong><br>
                    @if($aluno->alu_foto && file_exists(public_path($aluno->alu_foto)))
                        <img src="{{ asset($aluno->alu_foto) }}" alt="{{ $aluno->alu_nome }}" class="w-32 h-32 object-cover rounded-full mt-2">
                    @else
                        <span class="text-gray-500">Sem foto</span>
                    @endif
                </p><br>
                
                <p><strong>RA/RG:</strong> {{ $aluno->alu_ra }}-{{ $aluno->alu_digito_ra }}/{{ $aluno->alu_uf_ra }}</p>
                <p><strong>Turma/Cargo:</strong> {{ $aluno->alu_turma }}</p>
                <p><strong>Celular:</strong> {{ $aluno->alu_fone1 }}</p>
                <p><strong>Telefone:</strong> {{ $aluno->alu_fone2 }}</p>
                <p><strong>Email:</strong> {{ $aluno->alu_email }}</p>
                <p><strong>Observações:</strong> {{ $aluno->alu_obs }}</p><br>
                <!-- Botões -->
                <a href="{{ route('alunos.edit', $aluno->alu_id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-600">
                    Editar
                </a>
                <a href="{{ route('alunos.carteirinha.pdf', $aluno->alu_id) }}" 
                    class="inline-flex items-center px-4 py-2 ml-4 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600">
                    Gerar Carteirinha (PDF)
                </a>
                <a href="{{ route('alunos.index') }}" class="inline-flex items-center px-4 py-2 ml-4 bg-gray-500 border border-transparent rounded-md font-semibold text-white hover:bg-gray-600">
                        Voltar
                    </a>
            </div>
        </div>
    </div>
</x-app-layout>
