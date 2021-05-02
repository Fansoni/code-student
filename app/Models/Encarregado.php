<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encarregado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'data_pagamento',
    ];

    /**
     * Get the Encarregado associated with the Estudante.
     */
    public function estudante()
    {
        return $this->hasOne('App\Models\Estudante');
    }
}
