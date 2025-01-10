<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $table = 'emprestimos';
    protected $primaryKey = 'emp_id';
    public $timestamps = false;

    protected $fillable = [
        'emp_aluno',
        'emp_data_retirada',
        'emp_data_devolucao',
        'emp_usuario',
        // etc
    ];

    // Relacionamento com pivot emprestimos_livros
    public function livros()
    {
        return $this->belongsToMany(\App\Models\Livro::class, 'emprestimos_livros', 'emp_id', 'liv_id')
                    ->withPivot(['quantidade', 'data_devolvido']);
    }

    // Se quiser saber qual aluno pegou (belongsTo(Aluno::class, 'emp_aluno', 'alu_id')):
    public function aluno()
    {
        return $this->belongsTo(\App\Models\Aluno::class, 'emp_aluno', 'alu_id');
    }

    // Se quiser saber qual user fez o cadastro
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'emp_usuario', 'id');
    }
}
