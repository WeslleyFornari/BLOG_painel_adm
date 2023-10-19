<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{

    protected $fillable = ['name','foto'];

    protected $enumStatus = ['ativo', 'inativo'];

    public function getStatusUsuario($value)
    {
        return $this->enumStatus[$value];
    }
}
