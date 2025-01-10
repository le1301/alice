<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmprestimoLivroController extends Controller
{
    /**
     * Lista cada linha da pivot como se fosse "um registro" 
     * exibe: emp_data_retirada, nome do aluno, nome do livro, data_devolvido...
     */
    public function index()
    {
        // Precisamos unir a pivot + dados do emprestimo + do aluno + do livro
        // Exemplo em raw SQL:
        // SELECT e.emp_id, e.emp_data_retirada, a.alu_nome, l.liv_titulo, el.data_devolvido
        // FROM emprestimos_livros el
        // JOIN emprestimos e ON e.emp_id = el.emp_id
        // JOIN alunos a ON a.alu_id = e.emp_aluno
        // JOIN livros l ON l.liv_id = el.liv_id
        // ORDER BY e.emp_data_retirada DESC

        $linhas = DB::table('emprestimos_livros as el')
            ->join('emprestimos as e', 'e.emp_id', '=', 'el.emp_id')
            ->join('alunos as a', 'a.alu_id', '=', 'e.emp_aluno')
            ->join('livros as l', 'l.liv_id', '=', 'el.liv_id')
            ->select(
                'e.emp_id',
                'e.emp_data_retirada',
                'a.alu_nome',
                'el.liv_id',
                'l.liv_titulo',
                'el.data_devolvido'
            )
            ->orderByDesc('e.emp_data_retirada')
            ->get();

        return view('emprestimos_livros.index', compact('linhas'));
    }

    /**
     * Marca data_devolvido na pivot para "hoje"
     */
    public function devolver($emp_id, $liv_id)
    {
        DB::table('emprestimos_livros')
            ->where('emp_id', $emp_id)
            ->where('liv_id', $liv_id)
            ->update(['data_devolvido' => date('Y-m-d')]);

        return redirect()->route('emprestimos.index')
                         ->with('success', 'Livro devolvido com sucesso!');
    }
}
