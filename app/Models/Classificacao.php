<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classificacao extends Model
{
    use HasFactory;

    protected $table = 'classificacoes';   // nome da tabela
    protected $primaryKey = 'cla_id';      // nome da PK
    public $timestamps = false;            // caso a tabela não tenha campos created_at/updated_at

    protected $fillable = [
        'cla_cdd',
        'cla_titulo'
    ];
}
