<?php

namespace App\Http\Controllers;

use App\Models\Livro; // seu model Livro
use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function indexLivros()
    {
        // Busca todos os livros
        $livros = Livro::all();

        // Retorna uma view bem simples, com 'livros'
        return view('teste-livros', compact('livros'));
    }
}
