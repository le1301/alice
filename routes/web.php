<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EditoraController;
use App\Http\Controllers\DadoController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ClassificacaoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\EmprestimoLivroController;
use App\Http\Controllers\RelatorioController;
//use App\Http\Controllers\TesteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;





Route::get('/', function () {
    return view('welcome');
});

Route::get('/livros/busca', [App\Http\Controllers\LivroController::class, 'buscar'])->name('livros.busca');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //autores
    Route::resource('autores', AutorController::class);
    //editoras
    Route::resource('editoras', EditoraController::class);
    //dados
    Route::resource('dados', DadoController::class);
    //alunos
    Route::resource('alunos', AlunoController::class);
    //carteirinhas
    Route::get('alunos/{id}/carteirinha-pdf', [AlunoController::class, 'carteirinhaPdf'])
     ->name('alunos.carteirinha.pdf');
    //classificacoes
    Route::resource('classificacoes', ClassificacaoController::class);
    // Rota para imprimir todas as classificações em PDF
    Route::get('classificacoes-pdf', [ClassificacaoController::class, 'pdf'])->name('classificacoes.pdf');
    
    
    //livros
    Route::resource('livros', LivroController::class);
    
    // CRUD dos empréstimos
    Route::resource('emprestimos', EmprestimoController::class);

    Route::get('emprestimos/{id}/comprovante-pdf', [\App\Http\Controllers\EmprestimoController::class, 'comprovantePdf'])
     ->name('emprestimos.comprovante_pdf');


    // Rota para criar novo empréstimo
    Route::get('emprestimos/create', [EmprestimoController::class, 'create'])->name('emprestimos.create');
    Route::post('emprestimos', [EmprestimoController::class, 'store'])->name('emprestimos.store');

    // Rota de renovar (abre form ou apenas atualiza data_devolucao)
    //Route::get('emprestimos/{emp_id}/edit', [EmprestimoController::class, 'edit'])->name('emprestimos.edit');
    //Route::put('emprestimos/{emp_id}', [EmprestimoController::class, 'update'])->name('emprestimos.update');

    // Rota "devolver" um livro (data_devolvido)
    Route::patch('emprestimos/{emp_id}/{liv_id}/devolver', [EmprestimoLivroController::class, 'devolver'])
     ->name('emprestimos_livros.devolver');

    
    
    
     // Rota para imprimir relatórios
    

    //Route::get('relatorios/livros', [RelatorioController::class, 'livrosPdf'])->name('relatorios.livros');
    Route::get('relatorios/alunos', [RelatorioController::class, 'alunosPdf'])->name('relatorios.alunos');

    //teste livros
    //Route::get('teste-livros', [TesteController::class, 'indexLivros'])->name('teste.livros');

    Route::get('relatorios/livros-paginado', [RelatorioController::class, 'livrosPdfPaginado'])
     ->name('relatorios.livros_paginado');

    
    //Relatorio de Livros, Editoras e Quantidade
    Route::get('relatorios/livros-html', [RelatorioController::class, 'livrosHtml'])
     ->name('relatorios.livros_html');

     // usuarios
     Route::resource('users', UserController::class);

     //relatorios index
        Route::get('relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');







});

require __DIR__.'/auth.php';
