<!-- resources/views/relatorios/livros-html.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Livros (HTML)</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
            margin: 20px;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo {
            max-width: 60px;
            max-height: 60px;
        }
        .titulo-escola {
            font-weight: bold;
            font-size: 12pt;
        }
        .subtitulo {
            font-size: 10pt;
            margin-top: 3px;
        }
        .info-escola {
            font-size: 9pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 5px;
            font-size: 9pt;
        }
        th {
            background-color: #eee;
        }
        .footer {
            text-align: center;
            font-size: 8pt;
            margin-top: 10px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="header">
    {{-- Logo da Escola (se existir) --}}
    @if($dadosEscola->dad_logo && file_exists(public_path($dadosEscola->dad_logo)))
        <img src="{{ asset($dadosEscola->dad_logo) }}" alt="Logo Escola" class="logo">
    @endif

    <div class="titulo-escola">
        {{ $dadosEscola->dad_nome }}
    </div>
    <div class="subtitulo">
        {{ $dadosEscola->dad_nome_biblioteca ?? '' }}
    </div>
    <div class="info-escola">
        {{ $dadosEscola->dad_endereco }}<br>
        Fone: {{ $dadosEscola->dad_fone }} - 
        Email: {{ $dadosEscola->dad_email }}
    </div>

    <h3>Relatório de Livros Cadastrados</h3>
</div>

<table>
    <thead>
        <tr>
            <th>Tombo</th>
            <th>Título</th>
            <th>Editora</th>
            <th>Quantidade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($livros as $liv)
            <tr>
                <td>{{ $liv->liv_id }}</td>
                <td>{{ $liv->liv_titulo }}</td>
                <td>{{ $liv->autor->aut_nome ?? '—' }}</td>
                <td>{{ $liv->liv_quantidade ?? 0 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    Alice - Sistema de Gerenciamento para Salas de Leitura e Bibliotecas Escolares<br>
    Desenvolvido por <a href="https://wa.me/5514996583055" target="_blank"> Prof. Leandro Carvalho de Oliveira</a>
</div>

</body>
</html>
