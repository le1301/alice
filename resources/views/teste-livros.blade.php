<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste Lista de Livros</title>
</head>
<body>

<h1>Lista de Livros (Teste)</h1>

@if($livros->count() == 0)
    <p>Nenhum livro cadastrado.</p>
@else
    <ul>
        @foreach($livros as $livro)
            <li>{{ $livro->liv_titulo }}</li>
            <li>{{ $livro->liv_quantidade }}</li>
            <li>{{ $livro->liv_id }}</li>
        @endforeach
    </ul>
@endif

</body>
</html>
