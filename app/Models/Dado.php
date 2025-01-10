<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dado extends Model
{
    use HasFactory;

    protected $table = 'dados';
    protected $primaryKey = 'dad_id';
    public $timestamps = false;

    protected $fillable = [
        'dad_nome',
        'dad_endereco',
        'dad_fone',
        'dad_celular',
        'dad_email',
        'dad_site',
        'dad_logo',
        'dad_fundo',
        'dad_nome_biblioteca',
    ];
}
