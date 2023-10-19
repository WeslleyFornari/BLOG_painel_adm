<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['name'];

    protected $enumStatus = ['ativo', 'inativo'];

    public function getStatusUsuario($value)
    {
        return $this->enumStatus[$value];
    }
}
