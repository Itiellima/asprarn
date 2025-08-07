<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associado extends Model
{
    
    public function endereco() {
    return $this->hasOne(Endereco::class);
    }

    public function contato() {
        return $this->hasOne(Contato::class);
    }

    public function dadosBancarios() {
        return $this->hasOne(DadosBancarios::class);
    }
}
