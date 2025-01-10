<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Aluno;
use App\Models\Livro;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmprestimoController extends Controller
{
    
    /**
     * INDEX: Lista todos os empréstimos (cabeçalho) com paginação.
     */public function index(Request $request)
{
    $q = $request->get('q');            // termo de busca
    $somenteAtrasados = $request->get('atrasados'); // "1" se clicar em "Somente Atrasados"

    // Monta query base
    $query = DB::table('emprestimos as e')
        ->join('alunos as a', 'a.alu_id', '=', 'e.emp_aluno')
        ->join('emprestimos_livros as el', 'el.emp_id', '=', 'e.emp_id')
        ->join('livros as l', 'l.liv_id', '=', 'el.liv_id')
        ->select(
            'e.emp_id',
            'e.emp_data_retirada',
            'e.emp_data_devolucao',
            'a.alu_nome',
            'l.liv_id',
            'l.liv_titulo',
            'el.data_devolvido'
        )
        ->orderByDesc('e.emp_data_retirada');

    // Filtro por busca (q)
    if ($q) {
        $query->where(function($where) use ($q) {
            $where->where('a.alu_nome', 'LIKE', "%{$q}%")
                  ->orWhere('l.liv_titulo', 'LIKE', "%{$q}%");
        });
    }

    // Se "somenteAtrasados" == 1, filtrar onde data_devolvido IS NULL
    // e emp_data_devolucao < hoje
    if ($somenteAtrasados == '1') {
        $hoje = date('Y-m-d');
        $query->whereNull('el.data_devolvido')
              ->where('e.emp_data_devolucao', '<', $hoje);
    }

    $rows = $query->get();

    // Monta $linhas + checa se está em atraso + formata datas dd/mm/yyyy
    $today = date('Y-m-d');
    $linhas = [];
    foreach ($rows as $r) {
        // Verifica atraso
        $atrasado = false;
        if (empty($r->data_devolvido) && !empty($r->emp_data_devolucao) && $today > $r->emp_data_devolucao) {
            $atrasado = true;
        }

        // Formata datas
        // Pode usar \Carbon\Carbon ou substr manipulação
        $dataRetiradaFormat = $r->emp_data_retirada 
            ? \Carbon\Carbon::parse($r->emp_data_retirada)->format('d/m/Y') 
            : null;

        $dataDevolucaoFormat = $r->emp_data_devolucao 
            ? \Carbon\Carbon::parse($r->emp_data_devolucao)->format('d/m/Y')
            : null;

        $dataDevolvidoFormat = $r->data_devolvido
            ? \Carbon\Carbon::parse($r->data_devolvido)->format('d/m/Y')
            : null;

        $linhas[] = [
            'emp_id'             => $r->emp_id,
            'emp_data_retirada'  => $dataRetiradaFormat ?? '—',
            'emp_data_devolucao' => $dataDevolucaoFormat ?? '—',
            'alu_nome'           => $r->alu_nome,
            'liv_id'             => $r->liv_id,
            'liv_titulo'         => $r->liv_titulo,
            'data_devolvido'     => $dataDevolvidoFormat ?? '—',
            'atrasado'           => $atrasado,
        ];
    }

    return view('emprestimos.index', [
        'linhas' => $linhas,
        'q' => $q,
        'somenteAtrasados' => $somenteAtrasados // para manter o estado do check/botão, se quiser
    ]);
}


    /**
     * CREATE: Tela para criar novo empréstimo (cabeçalho),
     * e permitir seleção de livros no front-end.
     */
    public function create()
    {
        //$alunos = Aluno::all();
        // Condição para exibir apenas cadastros ativos
        $alunos = Aluno::where('alu_status', '!=', 'Inativo(a)')->get();
        $livros = Livro::all(); 

        return view('emprestimos.create', compact('alunos','livros'));
    }

    /**
     * STORE: grava cabeçalho + pivot
     */
    public function store(Request $request)
    {
        $request->validate([
            'emp_aluno'         => 'required|integer',
            'emp_data_retirada' => 'required|date',
        ]);

        $emprestimo = \App\Models\Emprestimo::create([
            'emp_aluno'         => $request->input('emp_aluno'),
            'emp_data_retirada' => $request->input('emp_data_retirada'),
            'emp_data_devolucao'=> $request->input('emp_data_devolucao'),
            'emp_usuario'       => auth()->id() // se quiser
        ]);

        if ($request->has('livros')) {
            $attach = [];
            foreach ($request->input('livros') as $liv_id => $qtd) {
                if ($qtd > 0) {
                    $attach[$liv_id] = [
                        'quantidade' => $qtd,
                        'data_devolvido' => null
                    ];
                }
            }
            $emprestimo->livros()->attach($attach);
        }

        return redirect()->route('emprestimos.index')
                         ->with('success','Empréstimo cadastrado com sucesso!');
    }

    /**
     * SHOW: Exibe detalhes de UM empréstimo (cabeçalho) + seus livros.
     * (Aqui não "explode" pois é uma tela detalhada de 1 empréstimo.)
     */
    public function show($id)
    {
        $emprestimo = Emprestimo::with(['aluno','livros'])->findOrFail($id);
        return view('emprestimos.show', compact('emprestimo'));
    }

    /**
     * EDIT: Form para alterar o cabeçalho (aluno, data retirada, etc.),
     * não altera devolução parcial (que fica na pivot).
     */
    public function edit($id)
    {
        $emprestimo = Emprestimo::findOrFail($id);
        $alunos = Aluno::all();
        $livros = Livro::all(); // se quiser mudar livros do empréstimo

        return view('emprestimos.edit', compact('emprestimo','alunos','livros'));
    }

    /**
     * UPDATE: Salva alterações no cabeçalho, e pode atualizar livros do pivot se desejar.
     */
    public function update(Request $request, $id)
    {
        $emprestimo = Emprestimo::findOrFail($id);

        $request->validate([
            'emp_aluno'         => 'required|integer',
            'emp_data_retirada' => 'required|date',
            'emp_data_devolucao'=> 'nullable|date'
        ]);

        $emprestimo->update([
            'emp_aluno'         => $request->input('emp_aluno'),
            'emp_data_retirada' => $request->input('emp_data_retirada'),
            'emp_data_devolucao'=> $request->input('emp_data_devolucao'),
        ]);

        // Se quiser atualizar pivot
        /*if ($request->has('livros')) {
            $attachArray = [];
            foreach ($request->input('livros') as $liv_id => $qtd) {
                if ($qtd > 0) {
                    $attachArray[$liv_id] = [
                        'quantidade' => $qtd,
                        // data_devolvido => null? Normalmente não mexemos aqui
                    ];
                }
            }
            $emprestimo->livros()->sync($attachArray);
        } else {
            // Se o user não selecionou nenhum livro, pode detach()
            $emprestimo->livros()->detach();
        }*/

        return redirect()->route('emprestimos.index')
                         ->with('success','Empréstimo atualizado!');
    }

    /**
     * DESTROY: Exclui o cabeçalho e a pivot.
     */
    public function destroy($id)
    {
        $emprestimo = Emprestimo::findOrFail($id);

        // Remove pivot antes
        $emprestimo->livros()->detach();

        $emprestimo->delete();

        return redirect()->route('emprestimos.index')
                         ->with('success','Empréstimo deletado!');
    }

    public function comprovantePdf($id)
{
    // 1. Carrega a tabela 'dados' (dad_id=1) com info da Escola/Biblioteca
    $dadosEscola = \App\Models\Dado::findOrFail(1);
    
    // 2. Carrega o Empréstimo + pivot (livros + quantidade)
    //    Supondo que no Model Emprestimo haja:
    //    public function livros() { return $this->belongsToMany(Livro::class, ...)->withPivot('quantidade'); }
    $emprestimo = \App\Models\Emprestimo::with(['aluno','livros'])->findOrFail($id);

    // 3. Monta array para view
    //    dataRetirada, dataDevolucao, etc. Se quiser formatar datas, use Carbon
    $dataRetirada = $emprestimo->emp_data_retirada 
        ? \Carbon\Carbon::parse($emprestimo->emp_data_retirada)->format('d/m/Y') 
        : null;
    $dataPrevista = $emprestimo->emp_data_devolucao
        ? \Carbon\Carbon::parse($emprestimo->emp_data_devolucao)->format('d/m/Y')
        : null;

    // 4. Gera o PDF
    $pdf = Pdf::loadView('emprestimos.impressao-comprovante', [
        'dadosEscola' => $dadosEscola,
        'emprestimo'  => $emprestimo,
        'dataRetirada'=> $dataRetirada,
        'dataPrevista'=> $dataPrevista
    ]);

    // Ajustes opcionais: tipo de papel 58mm, margens, etc.
    // Ex: ->setPaper(array(0,0,226.77,1000)); // 58mm ~ 226.77px
    // ou ->setPaper('A7','portrait') e estilizar

    // Retorna no navegador (stream) ou faz ->download('comprovante.pdf')
    return $pdf->stream('comprovante-emprestimo.pdf');
}

}
