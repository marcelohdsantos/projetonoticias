<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    const STATUS_ATIVO = 'A';
    const STATUS_INATIVO = 'I';

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'noticias'; // não é obrigatório, pois o Laravel reconheceria automaticamente
    protected $dates = ['data_publicacao', 'created_at', 'updated_at'];


    public function getStatusFormatadoAttribute()
    {
        if ($this->status == "A") {
            return "Ativo";
        } else if ($this->status == "I") {
            return "Inativo";
        }
    }   

    public function setTituloAttribute($valor) 
    {
        $this->attributes['titulo'] = mb_strtoupper($valor);
    }
}
