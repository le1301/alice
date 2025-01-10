<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Classificações</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #eee;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>

    <h1>Lista de Classificações</h1>

    <table>
        <thead>
            <tr>
                <!--th>ID</th-->
                <th>CDD</th>
                <th>Título</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classificacoes as $classificacao)
                <tr>
                    <!--td>{{ $classificacao->cla_id }}</td-->
                    <td>{{ $classificacao->cla_cdd }}</td>
                    <td>{{ $classificacao->cla_titulo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Alice - Sistema de Gerenciamento para Salas de Leitura e Biblioteca Escolares<br>
        Gerado em: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

</body>
</html>
