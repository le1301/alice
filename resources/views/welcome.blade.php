<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bem-vindo! - Alice - Sistema de Gerenciamento para Salas de Leitura e Biblioteca Escolares</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" />

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
        }
        .header {
            text-align: center;
            padding: 2rem 1rem;
        }
        .logo {
            height: 100px;
            margin-bottom: 1rem;
        }
        .title {
            font-size: 2rem;
            font-weight: bold;
            color: #374151;
        }
        .subtitle {
            font-size: 1.25rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }
        .welcome-message {
            font-size: 1.5rem;
            color: #4b5563;
            margin: 1rem 0;
        }
        .search-area {
            margin: 0.5rem auto;
            text-align: center;
        }
        .search-area form {
            display: flex;
            justify-content: center;
            gap: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        .search-area input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
        }
        .search-area button {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: #fff;
            background-color: #3b82f6;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
        }
        .search-area button:hover {
            background-color: #2563eb;
        }
        .footer {
            text-align: center;
            padding: 1rem;
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 4rem;
        }
        .footer a {
            color: #2563eb;
            text-decoration: none;
        }
        .result-count {
            text-align: left;
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .results-table th, .results-table td {
            border: 1px solid #d1d5db;
            padding: 0.75rem;
            text-align: left;
        }
        .results-table th {
            background-color: #f3f4f6;
            font-weight: bold;
        }
        .results-table tr:nth-child(even) {
            background-color: #f9fafb;
        }
    </style>
</head>
<body>

@php
    $dadosEscola = \App\Models\Dado::find(1);
    $logo = $dadosEscola->dad_logo ? asset($dadosEscola->dad_logo) : asset('img/default-logo.png');
    $nomeBiblioteca = $dadosEscola->dad_nome_biblioteca ?? null;
@endphp

<div class="header">
    <!-- Logo -->
    <img src="{{ $logo }}" alt="Logo da Escola" class="logo">

    <!-- Nome da Escola -->
    <div class="title">{{ $dadosEscola->dad_nome }}</div>

    <!-- Nome da Biblioteca -->
    @if ($nomeBiblioteca)
        <div class="subtitle">{{ $nomeBiblioteca }}</div>
    @endif

    <!-- Mensagem de Boas-Vindas -->
    <!--p class="welcome-message">Seja bem-vindo(a) ao Sistema Alice!</p-->

    @if (Route::has('login'))
        <div style="position: absolute; top: 1rem; right: 1rem;">
            <a href="{{ route('login') }}" class="text-blue-500 underline">Login</a>
        </div>
    @endif
</div>



<!-- Área de Busca -->
<div class="search-area">
    <p>Encontre o livro que deseja:</p>
    <form method="GET" action="{{ route('livros.busca') }}">
        <input type="text" name="q" placeholder="Digite o título do livro ou nome do autor..." value="{{ request('q') }}">
        <button type="submit">Buscar</button>
        <button type="button" onclick="window.location.href='{{ url('/') }}'" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Limpar</button>
    </form>
</div>

<!-- Resultados da Busca -->
@if(isset($resultados) && count($resultados) > 0)
    <div class="max-w-5xl mx-auto mt-6 p-4">
        <div class="result-count">
            Encontramos <strong>{{ count($resultados) }}</strong> resultado(s).
        </div>
        <table class="results-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resultados as $index => $livro)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $livro->liv_titulo }}</td>
                        <td>{{ $livro->autor->aut_nome ?? '---' }}</td>
                        <td>{{ $livro->liv_quantidade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@elseif(request()->has('q'))
    <div class="max-w-5xl mx-auto mt-6 p-4">
        <p class="text-gray-500">Nenhum resultado encontrado para sua busca.</p>
    </div>
@endif

<!-- Rodapé -->
<div class="footer">
Alice - Sistema de Gerenciamento para Salas de Leitura e Biblioteca Escolares<br>
    Desenvolvido por <a href="https://wa.me/5514996583055" target="_blank">Prof. Me. Leandro Carvalho de Oliveira</a><br>
    &copy; Todos os direitos reservados.  {{ date('Y') }}
</div>

</body>
</html>
