<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';
    protected $primaryKey = 'alu_id';
    public $timestamps = false;

    protected $fillable = [
        'alu_nome',
        'alu_ra',
        'alu_digito_ra',
        'alu_uf_ra',
        'alu_turma',
        'alu_fone1',
        'alu_fone2',
        'alu_email',
        'alu_status',
        'alu_foto',
        'alu_obs',
        'alu_dados'
    ];
}
