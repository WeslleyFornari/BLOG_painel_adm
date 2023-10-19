<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    protected $dates = ['data_postagem'];
    
    protected $fillable = ['id_autor','id_categoria', 'status',
                           'titulo', 'resumo', 'conteudo', 'foto', 'slug', 'data_postagem'];
    
    protected $enumStatus = ['ativo', 'inativo'];

    public function getStatusFilme($value)
    {
        return $this->enumStatus[$value];
    }

//HAS ONE
public function categoria(){

    return $this->hasOne(Categoria::class,'id', 'id_categoria');
}

public function autor(){

    return $this->hasOne(Autor::class,'id', 'id_autor');
}


}
