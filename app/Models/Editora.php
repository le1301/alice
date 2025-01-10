<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editora extends Model
{
    use HasFactory;

    protected $table = 'editoras';  
    protected $primaryKey = 'edi_id';
    public $timestamps = false;

    protected $fillable = [
        'edi_nome'
    ];
}
