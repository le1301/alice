<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Alunos</title>
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
    @if($dadosEscola->dad_logo && file_exists(public_path($dadosEscola->dad_logo)))
        <img src="{{ public_path($dadosEscola->dad_logo) }}" alt="Logo Escola" class="logo">
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

    <h3>Relatório de Alunos</h3>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Aluno</th>
            <th>RA | RG</th>
            <th>Turma</th>
            <th>Ocupação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alunos as $alu)
            <tr>
                <td>{{ $alu->alu_id }}</td>
                <td>{{ $alu->alu_nome }}</td>
                <td>{{ $alu->alu_ra }}-{{ $alu->alu_digito_ra }}/{{ $alu->alu_uf_ra }}</td>
                <td>{{ $alu->alu_turma ?? '—' }}</td>
                <td>{{ $alu->alu_status ?? '—' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    Alice - Sistema de Gerenciamento para Salas de Leitura e Bibliotecas Escolares<br>
    Desenvolvido por <a href="https://wa.me/5514996583055" target="_blank"> Prof. Leandro Carvalho de Oliveira</a>


</div>

<htmlpagefooter name="page-footer">
    <!--div style="text-align: center;">
        Página {PAGE_NUM} de {PAGE_COUNT}
    </div-->
</htmlpagefooter>

</body>
</html>
