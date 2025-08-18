<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    public function associado()
    {
        return $this->belongsTo(Associado::class);
    }

    protected $fillable = [
        'associado_id',
        'ativo',
        'inadimplente',
        'pendente_documento',
        'pendente_financeiro',
        'observacao',
    ];
}
