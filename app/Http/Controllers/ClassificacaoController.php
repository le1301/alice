<?php

namespace App\Http\Controllers;

use App\Models\Classificacao;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ClassificacaoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $classificacoes = Classificacao::when($search, function ($query, $search) {
                $query->where('cla_cdd', 'like', "%{$search}%")
                      ->orWhere('cla_titulo', 'like', "%{$search}%");
            })
            ->orderBy('cla_cdd')
            ->paginate(100); // Paginação com 100 itens por página

        return view('classificacoes.index', compact('classificacoes'));
    }

    public function create()
    {
        return view('classificacoes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cla_cdd'    => 'required|max:100',
            'cla_titulo' => 'required|max:150'
        ]);

        Classificacao::create($request->all());

        return redirect()->route('classificacoes.index')
                         ->with('success', 'Classificação criada com sucesso!');
    }

    public function show($id)
    {
        $classificacao = Classificacao::findOrFail($id);
        return view('classificacoes.show', compact('classificacao'));
    }

    public function edit($id)
    {
        $classificacao = Classificacao::findOrFail($id);
        return view('classificacoes.edit', compact('classificacao'));
    }

    public function update(Request $request, $id)
    {
        $classificacao = Classificacao::findOrFail($id);

        $request->validate([
            'cla_cdd'    => 'required|max:100',
            'cla_titulo' => 'required|max:150'
        ]);

        $classificacao->update($request->all());

        return redirect()->route('classificacoes.index')
                         ->with('success', 'Classificação atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $classificacao = Classificacao::findOrFail($id);
        $classificacao->delete();

        return redirect()->route('classificacoes.index')
                         ->with('success', 'Classificação deletada com sucesso!');
    }

    public function pdf()
    {
        $classificacoes = Classificacao::all();

        $pdf = Pdf::loadView('classificacoes.pdf', compact('classificacoes'));
        $pdf->setOption('isRemoteEnabled', true);

        return $pdf->stream('classificacoes.pdf');
    }
}
