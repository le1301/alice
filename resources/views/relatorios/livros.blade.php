<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Livros</title>
    <style>
        @page {
            margin: 40px 30px;
            footer: page-footer;
        }
        body {
            font-family: sans-serif;
            font-size: 10pt;
            margin: 0;
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
            <th>ID</th>
            <th>Título do Livro</th>
            <th>Quantidade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($livros as $liv)
            <tr>
                <td>{{ $liv->liv_id }}</td>
                <td>{{ $liv->liv_titulo }}</td>
                <td>{{ $liv->liv_quantidade ?? 0 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    Alice - Sistema de Gerenciamento para Salas de Leitura e Bibliotecas Escolares
</div>

<htmlpagefooter name="page-footer">
    <div style="text-align: center;">
        Página {PAGE_NUM} de {PAGE_COUNT}
    </div>
</htmlpagefooter>

</body>
</html>
