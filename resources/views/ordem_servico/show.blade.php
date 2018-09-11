@extends('layouts.relatorios')

@section('relatorio')
<div class="container-fluid m-b-10">
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default nf-panel clearfix">
                <div class="pull-left">
                    <label for="#numero" class="nf-label">Número:</label>
                    <div id="numero">{{ $ordemServico->id }}</div>
                </div>
                <div class="pull-right" style="margin-left: 25px">
                    <label for="#os_fechada" class="nf-label">Fechada:</label>
                    <div id="os_fechada">{{ ($ordemServico->fechada) ? 'Sim' : 'Não' }}</div>
                </div>
                <div class="pull-right" style="margin-left: 25px">
                    <label for="#data_os" class="nf-label">Data Fechamento:</label>
                    <div id="data_os">{{ ($ordemServico->fechada) ? date_format(date_create($ordemServico->data_fechamento), 'd/m/Y - H:i:s') : '___/___/______ - ___:___:___   ' }}</div>
                </div>
                <div class="pull-right" style="margin-left: 25px">
                    <label for="#data_os" class="nf-label">Data Abertura:</label>
                    <div id="data_os">{{ date_format(date_create($ordemServico->created_at), 'd/m/Y - H:i:s') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-5 col-md-5 col-lg-5">
            <div class="panel panel-default nf-panel">
                <label for="#cliente" class="nf-label">Cliente:</label>
                <div id="cliente">{{ $ordemServico->veiculo->cliente_id }} - {{ $ordemServico->veiculo->cliente->nome_razao }}</div>
            </div>
        </div>
        <div class="col col-sm-3 col-md-3 col-lg-3">
            <div class="panel panel-default nf-panel">
                <label for="#departamento" class="nf-label">Departamento:</label>
                <div id="departamento">{{ $ordemServico->veiculo->departamento->departamento }}</div>
            </div>
        </div>
        <div class="col col-sm-2 col-md-2 col-lg-2">
            <div class="panel panel-default nf-panel">
                <label for="#veiculo" class="nf-label">Veículo:</label>
                <div id="veiculo">{{ $ordemServico->veiculo->placa }}</div>
            </div>
        </div>
        <div class="col col-sm-2 col-md-2 col-lg-2">
            <div class="panel panel-default nf-panel">
                <label for="#km_atual" class="nf-label">Km:</label>
                <div id="km_atual">{{ $ordemServico->km_veiculo }}</div>
            </div>
        </div>
    </div>
    {{--  Serviços  --}}
    <div class="row" align="center">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default nf-panel">
                <strong>Serviços</strong> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                ID
            </div>
        </div>
        <div class="col col-sm-7 col-md-7 col-lg-7">
            <div class="panel panel-default nf-panel">
                Serviço
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                Valor
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                Acrés.
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                Desc.
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                Total
            </div>
        </div>
    </div>
    @foreach($ordemServico->servicos as $servico)
    <div class="row">
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $servico->servico_id }}</div>
            </div>
        </div>
        <div class="col col-sm-7 col-md-7 col-lg-7">
            <div class="panel panel-default nf-panel">
                <div>{{ $servico->servico->servico }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $servico->valor_servico }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $servico->valor_acrescimo }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $servico->valor_desconto }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $servico->valor_cobrado }}</div>
            </div>
        </div>
    </div>
    @endforeach
    {{--  Produtos  --}}
    <div class="row" align="center">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default nf-panel">
                <strong>Produtos</strong> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                ID
            </div>
        </div>
        <div class="col col-sm-7 col-md-7 col-lg-7">
            <div class="panel panel-default nf-panel">
                Produto
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                Qtd
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                Acrés.
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                Desc.
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                Total
            </div>
        </div>
    </div>
    @foreach($ordemServico->produtos as $item)
    <div class="row">
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $item->produto_id }}</div>
            </div>
        </div>
        <div class="col col-sm-7 col-md-7 col-lg-7">
            <div class="panel panel-default nf-panel">
                <div>{{ $item->produto->produto_descricao }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $item->quantidade }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $item->valor_acrescimo }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $item->valor_desconto }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="panel panel-default nf-panel">
                <div>{{ $item->valor_cobrado }}</div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col col-sm-10 col-md-10 col-lg-10">
            
        </div>
        <div class="col col-sm-2 col-md-2 col-lg-2">
            <div class="panel panel-default nf-panel clearfix">
                <div class="pull-right">
                    <label for="#data_os" class="nf-label">Valor Total:</label>
                    <div id="data_os">{{ $ordemServico->valor_total }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default nf-panel">
                <label for="#obs" class="nf-label">Observações:</label>
                <div id="obs">{{ $ordemServico->obs }}</div>
            </div>
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <div class="container-fluid m-b-10">
        <div class="row" align="center">
            <div class="col col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col col-sm-4 col-md-4 col-lg-4">
                <div style="border-bottom: 1px solid"> </div>
            </div>
            <div class="col col-sm-2 col-md-2 col-lg-2">
            </div>
            <div class="col col-sm-4 col-md-4 col-lg-4">
                <div style="border-bottom: 1px solid"> </div>
            </div>
            <div class="col col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col col-sm-1 col-md-1 col-lg-1">
            </div>
            <div class="col col-sm-4 col-md-4 col-lg-4" align="center">
                <strong>{{ $ordemServico->user->name }}</strong> 
            </div>
            <div class="col col-sm-2 col-md-2 col-lg-2">
            </div>
            <div class="col col-sm-4 col-md-4 col-lg-4" align="center">
                <strong>{{ $ordemServico->veiculo->cliente->nome_razao }}</strong> 
            </div>
        </div>
    </div>
</div>
@endsection