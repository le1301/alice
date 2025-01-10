<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';   // Se o nome da tabela fosse 'autors', não precisaria desta linha, mas como é 'autores', é bom especificar.
    protected $primaryKey = 'aut_id';

    // Caso a tabela não use timestamps (created_at, updated_at), pode desabilitá-los:
    public $timestamps = false;

    // Caso queira preencher em massa (mass assignment):
    protected $fillable = [
        'aut_nome', 
        'aut_foto'
    ];
}
