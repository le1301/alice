<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class LivroController extends Controller
{
    public function index(Request $request)
    {
    // Busca se houver param 'q'
    $q = $request->get('q');

    // Exemplo: Se tiver relacionamento 'autor()' no Model Livro
    // public function autor() { return $this->belongsTo(Autor::class, 'liv_autor', 'aut_id'); }
    // Assim podemos usar with('autor') para eager loading.
    $query = Livro::with('autor');

    if ($q) {
        // Exemplo: busca por título
        $query->where('liv_titulo', 'LIKE', '%'.$q.'%');
    }

    // Paginação de 100 registros
    $livros = $query->paginate(100);

    // Retornamos também o valor de $q para manter no campo de busca
    return view('livros.index', compact('livros', 'q'));    
    }


    public function create()
    {
        // Carregar listas para dropdowns (autores, editoras, classificacoes)
        $autores = \App\Models\Autor::select('aut_id','aut_nome')->orderBy('aut_nome')->get();
        $editoras = \App\Models\Editora::select('edi_id','edi_nome')->orderBy('edi_nome')->get();
        $classificacoes = \App\Models\Classificacao::select('cla_id','cla_titulo')->orderBy('cla_titulo')->get();

        return view('livros.create', compact('autores','editoras','classificacoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'liv_titulo'        => 'required|max:250',
            'liv_idioma'        => 'nullable|max:250',
            'liv_autor'         => 'nullable|integer',
            'liv_editora'       => 'nullable|integer',
            'liv_classificacao' => 'nullable|integer',
            'liv_paginas'       => 'nullable|max:25',
            'liv_ano'           => 'nullable|max:15',
            'liv_edicao'        => 'nullable|max:55',
            'liv_local'         => 'nullable|max:250',
            'liv_isbn'          => 'nullable|max:55',
            'liv_tradutor'      => 'nullable|max:250',
            'liv_tipo_material' => 'nullable|max:150',
            'liv_quantidade'    => 'nullable|integer',
            'liv_capa'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            // Ajuste conforme formatos e tamanho desejados
            'liv_resumo'        => 'nullable',
            'liv_estante'       => 'nullable|max:250',
            'liv_chamada'       => 'nullable|max:100',
            'liv_tombo'         => 'nullable|max:100'
        ]);

        // Cria um array com todos os dados do request
        $data = $request->all();

        // Verifica se enviou arquivo de capa
        if ($request->hasFile('liv_capa')) {
            $file = $request->file('liv_capa');
            // Gera um nome único, por exemplo usando time()
            $filename = time() . '_' . $file->getClientOriginalName();
            // Move o arquivo para public/img/capas_livros
            $file->move(public_path('img/capas_livros'), $filename);
            // Salva no banco apenas o caminho relativo
            $data['liv_capa'] = 'img/capas_livros/' . $filename;
        }

        Livro::create($data);

        return redirect()->route('livros.index')
                         ->with('success', 'Livro criado com sucesso!');
    }

    public function show($id)
    {
        $livro = Livro::findOrFail($id);
        return view('livros.show', compact('livro'));
    }

    public function edit($id)
    {
    $livro = Livro::findOrFail($id);

    // Carregar a lista de autores, editoras, classificacoes
    $autores = \App\Models\Autor::select('aut_id','aut_nome')->orderBy('aut_nome')->get();
    $editoras = \App\Models\Editora::select('edi_id','edi_nome')->orderBy('edi_nome')->get();
    $classificacoes = \App\Models\Classificacao::select('cla_id','cla_titulo')->orderBy('cla_titulo')->get();

    // Lista de idiomas, se estiver usando a mesma da create:
    $idiomas = [
        'Mandarim','Espanhol','Inglês','Hindi','Árabe','Bengali','Português','Russo','Japonês','Lahnda',
        'Alemão','Coreano','Francês','Telugu','Marathi','Turco','Tâmil','Vietnamita','Urdu','Javanês',
        'Italiano','Egípcio','Gujarati','Iraniano','Bhojpuri','Min Nan','Hakka','Jin','Hausa','Kannada',
        'Indonésio','Polonês','Iorubá','Xiang','Malaio','Odia','Birmanês','Sudanês','Albanês','Romeno',
        'Cebuano','Neerlandês','Tagalo','Thai','Grego','Húngaro','Sueco','Tailandês','Búlgaro','Dinamarquês','Outros'
    ];

    // Lista de tipos de material:
    $tiposMaterial = [
        'livro','revista','jornal','periodico','filme','cd','dvd','obras_de_arte','outros'
    ];

    return view('livros.edit', compact('livro','autores','editoras','classificacoes','idiomas','tiposMaterial'));
    }


    public function update(Request $request, $id)
    {
        $livro = Livro::findOrFail($id);

        $request->validate([
            'liv_titulo'        => 'required|max:250',
            'liv_idioma'        => 'nullable|max:250',
            'liv_autor'         => 'nullable|integer',
            'liv_editora'       => 'nullable|integer',
            'liv_classificacao' => 'nullable|integer',
            'liv_paginas'       => 'nullable|max:25',
            'liv_ano'           => 'nullable|max:15',
            'liv_edicao'        => 'nullable|max:55',
            'liv_local'         => 'nullable|max:250',
            'liv_isbn'          => 'nullable|max:55',
            'liv_tradutor'      => 'nullable|max:250',
            'liv_tipo_material' => 'nullable|max:150',
            'liv_quantidade'    => 'nullable|integer',
            'liv_capa'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'liv_resumo'        => 'nullable',
            'liv_estante'       => 'nullable|max:250',
            'liv_chamada'       => 'nullable|max:100',
            'liv_tombo'         => 'nullable|max:100'
        ]);

        $data = $request->all();

        // Se enviou um novo arquivo de capa
        if ($request->hasFile('liv_capa')) {
            $file = $request->file('liv_capa');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/capas_livros'), $filename);
            $data['liv_capa'] = 'img/capas_livros/' . $filename;

            // Opcional: apagar a capa antiga se existir
            if ($livro->liv_capa && file_exists(public_path($livro->liv_capa))) {
                File::delete(public_path($livro->liv_capa));
            }
        } else {
            // Mantém a capa antiga se não for enviado nada
            $data['liv_capa'] = $livro->liv_capa;
        }

        $livro->update($data);

        return redirect()->route('livros.index')
                         ->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);

        // Opcional: apagar a capa do disco também
        if ($livro->liv_capa && file_exists(public_path($livro->liv_capa))) {
            File::delete(public_path($livro->liv_capa));
        }

        $livro->delete();

        return redirect()->route('livros.index')
                         ->with('success', 'Livro deletado com sucesso!');
    }

    public function buscar(Request $request)
{
    $q = $request->input('q');
    $resultados = Livro::with('autor')
        ->where('liv_titulo', 'like', "%{$q}%")
        ->orWhereHas('autor', function($query) use ($q) {
            $query->where('aut_nome', 'like', "%{$q}%");
        })
        ->get();

    return view('welcome', compact('resultados'));
}


   
    
    

    
}
