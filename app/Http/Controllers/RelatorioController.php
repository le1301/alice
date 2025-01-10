<?php

namespace App\Http\Controllers;

use App\Models\Dado;
use App\Models\Livro;
use App\Models\Aluno;
use App\Models\Editora;
use App\Models\Autor;
use Barryvdh\DomPDF\Facade\Pdf; // biblioteca DomPDF
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }
    /**
     * Gera PDF de todos os livros
     */
    public function livrosHtml()
{
    // 1. Carrega dados da escola (dad_id=1)
    $dadosEscola = \App\Models\Dado::findOrFail(1);

    // 2. Carrega livros (com 'editora' se quiser exibir nome da editora)
    //    Aqui limitamos a 1000, mas pode remover a limitação se preferir
    $livros = \App\Models\Livro::with('autor')->orderBy('liv_titulo')->get();

    // 3. Retorna a view 'relatorios.livros-html'
    //    (que será apenas HTML, sem DomPDF)
    return view('relatorios.livros-html', compact('dadosEscola','livros'));
}

    /**
     * Gera PDF de todos os alunos
     */
    public function alunosPdf()
    {
        $dadosEscola = Dado::findOrFail(1);

        // Carrega todos os alunos, exceto os inativos
        $alunos = Aluno::where('alu_status', '!=', 'Inativo(a)')
                   ->orderBy('alu_status')
                   ->orderBy('alu_turma')
                   ->orderBy('alu_nome')
                   ->get();

        $pdf = Pdf::loadView('relatorios.alunos', compact('dadosEscola','alunos'));

        return $pdf->stream('relatorio_alunos.pdf');
    }
    
    public function livrosPdfPaginado()
{
    // Carrega dados da escola
    $dadosEscola = \App\Models\Dado::findOrFail(1);

    // Precisamos paginar, mas gerar UM HTML concatenado
    // Exemplo: 500 registros por “página”
    $perPage = 500;
    $paginaAtual = 1;

    $htmlPrincipal = ''; // Aqui guardamos o HTML de cada “lote”

    do {
        // Pagina: offset
        $offset = ($paginaAtual - 1) * $perPage;
        $livros = \App\Models\Livro::orderBy('liv_id')
                     ->offset($offset)
                     ->limit($perPage)
                     ->get();

        if ($livros->count() == 0) {
            break; // não há mais registros
        }

        // Monta uma “seção” de HTML, com cabeçalho de tabela ou algo
        // Exemplo (bem simples):
        $htmlSecao = "<h4 style='page-break-before: always;'>
                        Página {$paginaAtual}
                      </h4>
                      <table border='1' style='width:100%; border-collapse:collapse;'>
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Quantidade</th>
                          </tr>
                        </thead>
                        <tbody>";

        foreach ($livros as $liv) {
            $htmlSecao .= "
                <tr>
                  <td>{$liv->liv_id}</td>
                  <td>{$liv->liv_titulo}</td>
                  <td>{$liv->liv_quantidade}</td>
                </tr>";
        }
        $htmlSecao .= "</tbody></table>";

        // Concatena ao HTML principal
        $htmlPrincipal .= $htmlSecao;

        $paginaAtual++;
    } while (true);

    // Agora, geramos o PDF com $htmlPrincipal
    // Mas você também pode envolver esse $htmlPrincipal em um layout que inclua
    // o cabeçalho e rodapé “dadosEscola”.

    $htmlCompleto = view('relatorios.livros-paginado', [
        'dadosEscola' => $dadosEscola,
        'conteudoDinamico' => $htmlPrincipal
    ])->render();

    $pdf = Pdf::loadHTML($htmlCompleto);
    return $pdf->stream('relatorio_livros.pdf');
}

}
