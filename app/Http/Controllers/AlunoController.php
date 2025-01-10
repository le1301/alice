<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Dado; // se quiser utilizar para associar dados, caso precise
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
//use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
    // Captura o termo de busca do campo "search"
    $search = $request->input('search');

    // Busca alunos com base no nome (se o termo foi fornecido)
    $query = Aluno::query();

    if ($search) {
        $query->where('alu_nome', 'like', '%' . $search . '%');
    }

    // Adiciona paginação com 100 registros por página
    $alunos = $query->paginate(100);

    // Retorna a view com os alunos e o termo de busca atual
    return view('alunos.index', compact('alunos', 'search'));
    }


    public function create()
    {
        // Caso precise carregar dados de outra tabela, como 'dados' para selecionar, faça aqui
        $listaDados = Dado::all();
        return view('alunos.create', compact('listaDados'));

        
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'alu_nome' => 'required|max:250',
            'alu_ra' => 'nullable|max:20',
            'alu_digito_ra' => 'nullable|max:2',
            'alu_uf_ra' => 'nullable|max:2',
            'alu_turma' => 'nullable|max:200',
            'alu_fone1' => 'nullable|max:30',
            'alu_fone2' => 'nullable|max:30',
            'alu_email' => 'nullable|email|max:250',
            'alu_status' => 'nullable|max:50',
            'alu_obs' => 'nullable',
            'alu_dados' => 'nullable|integer'
        ]);

        $data = $request->all();

        // Upload da foto, se houver
        if ($request->hasFile('alu_foto')) {
            $file = $request->file('alu_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/alunos'), $filename);
            $data['alu_foto'] = 'img/alunos/' . $filename;
        }

        Aluno::create($data);

        return redirect()->route('alunos.index')
                         ->with('success', 'Aluno criado com sucesso!');
    }

    public function show($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.show', compact('aluno'));
    }

    public function edit($id)
    {
    $aluno = Aluno::findOrFail($id);

    // Carrega todos os registros da tabela 'dados'
    $listaDados = Dado::all();

    // Lista de siglas de estados
    $estadosBrasil = [
        'AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA',
        'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN',
        'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'
    ];

    // Lista de status
    $listaStatus = [
        'Aluno(a)',
        'Professor(a)',
        'Gestor(a)',
        'Servidor(a)',
        'Inativo(a)'
    ];

    return view('alunos.edit', compact('aluno', 'listaDados', 'estadosBrasil', 'listaStatus'));
    }


    public function update(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);

        $request->validate([
            'alu_nome' => 'required|max:250',
            'alu_ra' => 'nullable|max:20',
            'alu_digito_ra' => 'nullable|max:2',
            'alu_uf_ra' => 'nullable|max:2',
            'alu_turma' => 'nullable|max:200',
            'alu_fone1' => 'nullable|max:30',
            'alu_fone2' => 'nullable|max:30',
            'alu_email' => 'nullable|email|max:250',
            'alu_status' => 'nullable|max:50',
            'alu_obs' => 'nullable',
            'alu_dados' => 'nullable|integer'
        ]);

        $data = $request->all();

        // Upload de nova foto se enviada
        if ($request->hasFile('alu_foto')) {
            // Apagar foto antiga se existir
            if ($aluno->alu_foto && file_exists(public_path($aluno->alu_foto))) {
                unlink(public_path($aluno->alu_foto));
            }

            $file = $request->file('alu_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/alunos'), $filename);
            $data['alu_foto'] = 'img/alunos/' . $filename;
        } else {
            // Mantém a foto antiga se não enviar nova
            $data['alu_foto'] = $aluno->alu_foto;
        }

        $aluno->update($data);

        return redirect()->route('alunos.index')
                         ->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);

        // Se houver foto, apague
        if ($aluno->alu_foto && file_exists(public_path($aluno->alu_foto))) {
            unlink(public_path($aluno->alu_foto));
        }

        $aluno->delete();

        return redirect()->route('alunos.index')
                         ->with('success', 'Aluno deletado com sucesso!');
    }

    public function carteirinhaPdf($id)
    {
        $aluno = Aluno::findOrFail($id);
        // Ex: se sua tabela 'alunos' tiver col. 'alu_dados' que relaciona com 'dados'
        $instituicao = \App\Models\Dado::find($aluno->alu_dados);
    
        // Monta o texto e a URL do QR
        $qrText = "Nome: {$aluno->alu_nome}, RA: {$aluno->alu_ra}-{$aluno->alu_digito_ra}/{$aluno->alu_uf_ra}, Turma: {$aluno->alu_turma}";
        $qrUrl = 'https://quickchart.io/qr?size=200&text=' . urlencode($qrText);
    
        // Gera o PDF
        $pdf = Pdf::loadView('alunos.carteirinha-pdf', [
            'aluno'       => $aluno,
            'instituicao' => $instituicao,
            'qrCodeUrl'   => $qrUrl,
        ]);
    
        // Habilitar DOMPDF para carregar imagens remotas se estiver bloqueado
        // (caso a versão do dompdf necessite)
        $pdf->setOption('isRemoteEnabled', true);
    
        return $pdf->stream('carteirinha.pdf');
    }

    
    

   
}
