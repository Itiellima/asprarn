<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Associado extends Model
{

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function contato()
    {
        return $this->hasOne(Contato::class);
    }

    public function dadosBancarios()
    {
        return $this->hasOne(DadosBancarios::class);
    }

    public function situacao()
    {
        return $this->hasOne(Situacao::class);
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoAssociado::class);
    }
    public function mensalidades()
    {
        return $this->hasMany(Mensalidade::class);
    }
    public function historicoSituacoes()
    {
        return $this->hasMany(HistoricoSituacoes::class);
    }

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'rg',
        'orgao_expedidor',
        'nome_pai',
        'nome_mae',
        'estado_civil',
        'grau_instrucao',
        'nome_guerra',
        'graduacao',
        'nmr_praca',
        'matricula',
        'opm',
        'dependentes',
        'obs',
    ];

    protected static function booted()
    {
        static::deleting(function ($associado) {
            foreach ($associado->documentos as $documento) {
                // Exclui o arquivo físico
                if ($documento->arquivo && Storage::disk('public')->exists($documento->arquivo)) {
                    Storage::disk('public')->delete($documento->arquivo);
                }

                // Exclui o registro no banco
                $documento->delete();
            }
        });
    }
}
