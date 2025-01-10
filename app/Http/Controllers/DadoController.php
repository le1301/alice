<?php

namespace App\Http\Controllers;

use App\Models\Dado;
use Illuminate\Http\Request;

class DadoController extends Controller
{
    public function index()
    {
        $dados = Dado::all();
        return view('dados.index', compact('dados'));
    }

    public function create()
    {
        return view('dados.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'dad_nome' => 'required|max:250',
        'dad_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'dad_fundo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // Outras validações...
    ]);

    $data = $request->all();

    if ($request->hasFile('dad_logo')) {
        $fileLogo = $request->file('dad_logo');
        $filenameLogo = time().'_logo_'.$fileLogo->getClientOriginalName();
        $fileLogo->move(public_path('img/dados'), $filenameLogo);
        $data['dad_logo'] = 'img/dados/'.$filenameLogo;
    }

    if ($request->hasFile('dad_fundo')) {
        $fileFundo = $request->file('dad_fundo');
        $filenameFundo = time().'_fundo_'.$fileFundo->getClientOriginalName();
        $fileFundo->move(public_path('img/dados'), $filenameFundo);
        $data['dad_fundo'] = 'img/dados/'.$filenameFundo;
    }

    Dado::create($data);

    return redirect()->route('dados.index')
                     ->with('success', 'Dados criados com sucesso!');
    }

    public function show($id)
    {
        $dado = Dado::findOrFail($id);
        return view('dados.show', compact('dado'));
    }

    public function edit($id)
    {
        $dado = Dado::findOrFail($id);
        return view('dados.edit', compact('dado'));
    }

    public function update(Request $request, $id)
    {
    $dado = Dado::findOrFail($id);

    $request->validate([
        'dad_nome' => 'required|max:250',
        'dad_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'dad_fundo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // Outras validações...
    ]);

    $data = $request->all();

    // Upload da nova logo, se enviada
    if ($request->hasFile('dad_logo')) {
        // Apagar a logo antiga se existir
        if ($dado->dad_logo && file_exists(public_path($dado->dad_logo))) {
            unlink(public_path($dado->dad_logo));
        }

        $fileLogo = $request->file('dad_logo');
        $filenameLogo = time().'_logo_'.$fileLogo->getClientOriginalName();
        $fileLogo->move(public_path('img/dados'), $filenameLogo);
        $data['dad_logo'] = 'img/dados/'.$filenameLogo;
    } else {
        // Se não enviou nova, manter a antiga
        $data['dad_logo'] = $dado->dad_logo;
    }

    // Upload do novo fundo, se enviado
    if ($request->hasFile('dad_fundo')) {
        // Apagar a imagem de fundo antiga se existir
        if ($dado->dad_fundo && file_exists(public_path($dado->dad_fundo))) {
            unlink(public_path($dado->dad_fundo));
        }

        $fileFundo = $request->file('dad_fundo');
        $filenameFundo = time().'_fundo_'.$fileFundo->getClientOriginalName();
        $fileFundo->move(public_path('img/dados'), $filenameFundo);
        $data['dad_fundo'] = 'img/dados/'.$filenameFundo;
    } else {
        $data['dad_fundo'] = $dado->dad_fundo;
    }

    $dado->update($data);

    return redirect()->route('dados.index')
                     ->with('success', 'Dados atualizados com sucesso!');
    }

    public function destroy($id)
    {
        $dado = Dado::findOrFail($id);
        $dado->delete();

        return redirect()->route('dados.index')
                         ->with('success', 'Dado deletado com sucesso!');
    }
}
