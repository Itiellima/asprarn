<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadosBancarios extends Model
{
    public function associado() {
        return $this->belongsTo(Associado::class);
    }
}
