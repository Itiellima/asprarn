<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    public function associado() {
        return $this->belongsTo(Associado::class);
    }
    protected $fillable = [
        'tel_residencial',
        'tel_celular',
        'tel_residencial',
        'email',
        'associado_id'
    ];
}
