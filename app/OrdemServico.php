<?php

namespace App;

use App\User;
use App\Estoque;
use App\Veiculo;
use App\MovimentacaoProduto;
use App\OrdemServicoProduto;
use App\OrdemServicoServico;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $fillable = [
        'estoque_id',
        'fechada',
        'data_fechamento',
        'veiculo_id',
        'km_veiculo',
        'obs', 
        'user_id',
        'valor_total'
    ];

    public function veiculo() {
        return $this->belongsTo(Veiculo::class);
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
}
