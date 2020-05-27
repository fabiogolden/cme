<?php

namespace App;

use App\User;
use App\Estoque;
use App\Departamento;
use App\OrdemServicoStatus;
use App\MovimentacaoProduto;
use App\OrdemServicoProduto;
use App\OrdemServicoServico;
use App\Atendente;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $fillable = [
        'estoque_id',
        'data_fechamento',
        'departamento_id',
        'atendente_id',
        'obs', 
        'user_id',
        'valor_total',
        'ordem_servico_status_id'
    ];

    public function departamento() {
        return $this->belongsTo(Departamento::class);
    }

    public function atendente() {
        return $this->belongsTo(Atendente::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function servicos() {
        return $this->hasMany(OrdemServicoServico::class);
    }

    public function produtos() {
        return $this->hasMany(OrdemServicoProduto::class);
    }

    public function movimentacao_produto() { 
        return $this->hasMany(MovimentacaoProduto::class);
    }

    public function estoque() {
        return $this->belongsTo(Estoque::class);
    }

    public function ordem_servico_status() {
        return $this->belongsTo(OrdemServicoStatus::class);
    }
}
