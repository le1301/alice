<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmprestimoLivro extends Pivot
{
    // Se quiser tratá-lo como model pivot
    protected $table = 'emprestimos_livros';
    public $timestamps = false;

    protected $fillable = [
        'emp_id',
        'liv_id',
        'quantidade',
        'data_devolvido'
    ];
}
