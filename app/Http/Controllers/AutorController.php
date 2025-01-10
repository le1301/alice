<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(Request $request)
    {
        // Verifica se há um parâmetro de busca
        $search = $request->input('search');

        // Busca autores com base no parâmetro de busca, se fornecido
        $autores = Autor::when($search, function ($query, $search) {
                return $query->where('aut_nome', 'like', '%' . $search . '%');
            })
            ->orderBy('aut_nome') // Ordena por nome
            ->paginate(100); // Paginação com 100 itens por página

        // Retorna a view com os autores paginados e o termo de busca (se houver)
        return view('autores.index', compact('autores', 'search'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'aut_nome' => 'required|max:250',
            'aut_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('aut_foto')) {
            $file = $request->file('aut_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/fotos_autores'), $filename);
            $data['aut_foto'] = 'img/fotos_autores/' . $filename;
        }

        Autor::create($data);

        return redirect()->route('autores.index')
                         ->with('success', 'Autor criado com sucesso!');
    }

    public function show($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.show', compact('autor'));
    }

    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, $id)
    {
        $autor = Autor::findOrFail($id);

        $request->validate([
            'aut_nome' => 'required|max:250',
            'aut_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('aut_foto')) {
            if ($autor->aut_foto && file_exists(public_path($autor->aut_foto))) {
                unlink(public_path($autor->aut_foto));
            }

            $file = $request->file('aut_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/fotos_autores'), $filename);
            $data['aut_foto'] = 'img/fotos_autores/' . $filename;
        }

        $autor->update($data);

        return redirect()->route('autores.index')
                         ->with('success', 'Autor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $autor = Autor::findOrFail($id);

        // Apagar foto do autor ao deletar (opcional)
        if ($autor->aut_foto && file_exists(public_path($autor->aut_foto))) {
            unlink(public_path($autor->aut_foto));
        }

        $autor->delete();

        return redirect()->route('autores.index')
                         ->with('success', 'Autor deletado com sucesso!');
    }
}
