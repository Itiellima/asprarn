<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    public function associado() {
        return $this->belongsTo(Associado::class);
    }
    protected $fillable = [
        'telefone',
        'celular',
        'email',
        'associado_id'
    ];
}
