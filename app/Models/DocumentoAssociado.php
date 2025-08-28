<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DocumentoAssociado extends Model
{
    public function associado()
    {
        return $this->belongsTo(Associado::class);
    }

    protected $fillable = [
        'associado_id',
        'tipo_documento',
        'arquivo',
        'status',
        'observacao',
    ];

    protected static function booted()
    {
        static::deleting(function ($documento) {
            if ($documento->arquivo && Storage::disk('public')->exists($documento->arquivo)) {
                Storage::disk('public')->delete($documento->arquivo);
            }
        });
    }
}

// PENDENTE EXCLUSÃO
