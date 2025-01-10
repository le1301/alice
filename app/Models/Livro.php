<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';  
    protected $primaryKey = 'liv_id';
    public $timestamps = false;   // se a tabela não tem created_at/updated_at

    protected $fillable = [
        'liv_titulo',
        'liv_idioma',
        'liv_autor',
        'liv_editora',
        'liv_classificacao',
        'liv_paginas',
        'liv_ano',
        'liv_edicao',
        'liv_local',
        'liv_isbn',
        'liv_tradutor',
        'liv_tipo_material',
        'liv_quantidade',
        'liv_capa',
        'liv_resumo',
        'liv_estante',
        'liv_chamada',
        'liv_tombo'
    ];

    /**
     * Relacionamento com a tabela de Autores.
     * - belongsTo(Autor::class, 'liv_autor', 'aut_id')
     *   'liv_autor' é a FK em "livros" e 'aut_id' é a PK em "autores".
     */
    public function autor()
    {
        return $this->belongsTo(\App\Models\Autor::class, 'liv_autor', 'aut_id');
    }

    /**
     * Relacionamento com a tabela de Editoras.
     * - belongsTo(Editora::class, 'liv_editora', 'edi_id')
     *   'liv_editora' é a FK em "livros" e 'edi_id' é a PK em "editoras".
     */
    public function editora()
    {
        return $this->belongsTo(\App\Models\Editora::class, 'liv_editora', 'edi_id');
    }

    /**
     * Relacionamento com a tabela de Classificações.
     * - belongsTo(Classificacao::class, 'liv_classificacao', 'cla_id')
     *   'liv_classificacao' é a FK em "livros" e 'cla_id' é a PK em "classificacoes".
     */
    public function classificacao()
    {
        return $this->belongsTo(\App\Models\Classificacao::class, 'liv_classificacao', 'cla_id');
    }
}
