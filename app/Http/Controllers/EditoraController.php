<?php

namespace App\Http\Controllers;

use App\Models\Editora;
use Illuminate\Http\Request;

class EditoraController extends Controller
{
    public function index(Request $request)
    {
        // Define a quantidade de registros por página (exemplo: 10)
        $perPage = 100;

        // Realiza a busca, se aplicável
        $search = $request->get('search');
        $query = Editora::query();

        if ($search) {
            $query->where('edi_nome', 'like', '%' . $search . '%');
        }

        // Paginando os resultados
        $editoras = $query->paginate($perPage);

        return view('editoras.index', compact('editoras'));
    }

    public function create()
    {
        return view('editoras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'edi_nome' => 'required|max:250'
        ]);

        Editora::create($request->all());

        return redirect()->route('editoras.index')
                         ->with('success', 'Editora criada com sucesso!');
    }

    public function show($id)
    {
        $editora = Editora::findOrFail($id);
        return view('editoras.show', compact('editora'));
    }

    public function edit($id)
    {
        $editora = Editora::findOrFail($id);
        return view('editoras.edit', compact('editora'));
    }

    public function update(Request $request, $id)
    {
        $editora = Editora::findOrFail($id);

        $request->validate([
            'edi_nome' => 'required|max:250'
        ]);

        $editora->update($request->all());

        return redirect()->route('editoras.index')
                         ->with('success', 'Editora atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $editora = Editora::findOrFail($id);
        $editora->delete();

        return redirect()->route('editoras.index')
                         ->with('success', 'Editora deletada com sucesso!');
    }
}
