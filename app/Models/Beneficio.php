<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
