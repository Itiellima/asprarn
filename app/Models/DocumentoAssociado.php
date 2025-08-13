<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoAssociado extends Model
{
    public function associado() {
        return $this->belongsTo(Associado::class);
    }

    protected $fillable = [
        'associado_id',
        'tipo_documento',
        'status',
        'observacao',
    ];
}
