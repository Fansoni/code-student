<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_nascimento',
        'serie_ingresso',
        'endereco_id',
        'encarregado_id',
    ];

    /**
     * Get the Estudante that owns the Endereco.
     */
    public function endereco()
    {
        return $this->belongsTo('App\Models\Endereco');
    }

    /**
     * Get the Estudante that owns the Encarregado.
     */
    public function encarregado()
    {
        return $this->belongsTo('App\Models\Encarregado');
    }
}
