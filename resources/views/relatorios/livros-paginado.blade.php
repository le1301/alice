<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Livros Paginado</title>
    <style>
        /* Estilos, @page, etc. */
    </style>
</head>
<body>
    <div style="text-align:center;">
        @if($dadosEscola->dad_logo && file_exists(public_path($dadosEscola->dad_logo)))
            <img src="{{ public_path($dadosEscola->dad_logo) }}" alt="Logo" style="max-width:60px;"/>
        @endif
        <h2>{{ $dadosEscola->dad_nome }}</h2>
        <p>{{ $dadosEscola->dad_endereco }} | Fone: {{ $dadosEscola->dad_fone }}</p>
        <hr/>
    </div>

    {!! $conteudoDinamico !!}

    <div style="text-align:center; margin-top:20px;">
        Alice - Sistema de Gerenciamento ...
    </div>
</body>
</html>
