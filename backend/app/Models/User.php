<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Caso precise definir explicitamente o nome da tabela
    // protected $table = 'nome_da_tabela';

    // Caso precise definir os campos preenchíveis (mass assignment)
    // protected $fillable = ['name', 'email', 'password'];

    // Caso precise desabilitar a proteção contra alteração de timestamps
    // public $timestamps = false;
}
