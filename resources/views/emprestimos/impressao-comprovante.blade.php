<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Comprovante Empréstimo</title>
    <style>
        /* Define largura ~58mm. Ajuste se quiser */
        @page {
            size: 58mm auto; /* ou width 58mm, height auto */
            margin: 5px;
        }
        body {
            font-family: sans-serif;
            font-size: 10pt;
            /* se quiser forçar width no body */
            width: 58mm;
            margin: 0 auto;
            text-align: center;
        }
        .logo {
            max-width: 50px; /* Ajuste conforme seu logo e 58mm */
            margin-bottom: 5px;
        }
        .titulo-escola {
            font-weight: bold;
        }
        .linha {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }
        .assinatura {
            margin-top: 20px;
        }
        table {
            width: 100%;
            margin-bottom: 5px;
        }
        th, td {
            text-align: left;
            font-size: 9pt;
        }
        .rodape {
            margin-top: 10px;
            font-size: 8pt;
            text-align: center;
            border-top: 1px dashed #000;
            padding-top: 4px;
        }
    </style>
</head>
<body>

    {{-- Cabeçalho com dados da escola --}}
    @if($dadosEscola->dad_logo && file_exists(public_path($dadosEscola->dad_logo)))
        <img src="{{ public_path($dadosEscola->dad_logo) }}" alt="Logo" class="logo">
    @endif

    <div class="titulo-escola">
        {{ $dadosEscola->dad_nome }}<br>
        {{ $dadosEscola->dad_nome_biblioteca ?? '' }}
    </div>

    <div style="font-size: 9pt; margin-top:3px;">
        {{ $dadosEscola->dad_endereco }}<br>
        Fone: {{ $dadosEscola->dad_fone }}<br>
        Email: {{ $dadosEscola->dad_email }}<br>
    </div>

    <div class="linha"></div>

    {{-- Corpo: Dados do Aluno --}}
    <div style="text-align:left;">
        <strong>Aluno:</strong> {{ $emprestimo->aluno->alu_nome }}<br>
        RA: {{ $emprestimo->aluno->alu_ra }}-{{ $emprestimo->aluno->alu_digito_ra }}/{{ $emprestimo->aluno->alu_uf_ra }}<br>
        Turma: {{ $emprestimo->aluno->alu_turma }}<br>
    </div>

    <div style="text-align:left; margin-top:5px;">
        <strong>Data Retirada:</strong> {{ $dataRetirada ?? '---' }}<br>
        <strong>Data Devolução:</strong> {{ $dataPrevista ?? '---' }}
    </div>

    <div class="linha"></div>
    <div style="text-align:center; font-weight:bold; margin:5px 0;">
        Itens Emprestados
    </div>

    {{-- Tabela de Livros Emprestados --}}
    <table>
        <tbody>
            @foreach($emprestimo->livros as $livro)
                <tr>
                    <td style="text-align:left;">
                        {{ $livro->liv_titulo }}
                    </td>
                    <td style="text-align:right;">
                        x {{ $livro->pivot->quantidade }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="linha"></div>

    <div class="assinatura" style="text-align:center;">
        __________________________________<br>
        Assinatura
    </div>

    <div class="rodape">
        Alice - Sistema de Gerenciamento para Salas de Leitura e Bibliotecas Escolares
    </div>

</body>
</html>
