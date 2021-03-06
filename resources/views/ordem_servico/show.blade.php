@extends('layouts.relatorios')

@section('relatorio')
<div class="container-fluid m-b-10">
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <div class="card nf-panel">
                <div class="card-body">
                    <div class="float-left mr-auto">
                        <label for="#numero" class="nf-label">Número:</label>
                        <div id="numero">{{ $ordemServico->id }}</div>
                    </div>
                    <div class="float-right" style="margin-left: 25px">
                        <label for="#os_fechada" class="nf-label">status:</label>
                    <div id="os_fechada">{{ $ordemServico->ordem_servico_status->os_status ?? 'Aberta' }}</div>
                    </div>
                    <div class="float-right" style="margin-left: 25px">
                        <label for="#data_os" class="nf-label">Data Fechamento:</label>
                        @php
                            
                           
                        @endphp
                        <div id="data_fechamento_os">{{ ($ordemServico->fechada) ? date_format(date_create($ordemServico->data_fechamento), 'd/m/Y - H:i:s') : '___/___/______ - ___:___:___   ' }}</div>
                    </div>
                    <div class="float-right" style="margin-left: 25px">
                        <label for="#data_os" class="nf-label">Data Abertura:</label>
                        <div id="data_os">{{ date_format(date_create($ordemServico->created_at), 'd/m/Y - H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-5 col-md-5 col-lg-5">
            <div class="card nf-panel">
                <label for="#cliente" class="nf-label">Cliente:</label>
                <div id="cliente">{{ $ordemServico->departamento->cliente_id }} - {{ $ordemServico->departamento->cliente->nome_razao }}</div>
            </div>
        </div>
        <div class="col col-sm-3 col-md-3 col-lg-3">
            <div class="card nf-panel">
                <label for="#departamento" class="nf-label">Departamento:</label>
                <div id="departamento">{{ isset($ordemServico->departamento_id) ? $ordemServico->departamento->departamento : '&nbsp;' }}</div>
            </div>
        </div>
        <div class="col col-sm-2 col-md-2 col-lg-2">
            <div class="card nf-panel">
                <label for="#departamento" class="nf-label">Funcionário:</label>
                <div id="departamento">{{ isset($ordemServico->funcionario) ? $ordemServico->funcionario : 'NÃO INFORMADO' }}</div>
            </div>
        </div>
        <div class="col col-sm-2 col-md-2 col-lg-2">
            <div class="card nf-panel">
                <label for="#departamento" class="nf-label">Funcionário Recolhimento:</label>
                <div id="departamento">{{ isset($ordemServico->funcionario_recolhimento) ? $ordemServico->funcionario_recolhimento: 'NÃO INFORMADO' }}</div>
            </div>
        </div>
        
    </div>
        {{--  Produtos  --}}
    <div class="row" align="center">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <div class="card nf-panel">
                <strong>Produtos</strong> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="card nf-panel">
                ID
            </div>
        </div>
        <div class="col col-sm-6 col-md-6 col-lg-6">
            <div class="card nf-panel">
                Produto
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="card nf-panel">
                Qtd
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-2">
            <div class="card nf-panel">
                Lote
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-2">
            <div class="card nf-panel">
                Autoclave
            </div>
        </div>
        
    </div>
    @foreach($ordemServico->produtos as $item)
    <div class="row">
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="card nf-panel">
                <div>{{ $item->produto_id }}</div>
            </div>
        </div>
        <div class="col col-sm-6 col-md-6 col-lg-6">
            <div class="card nf-panel">
                <div>{{ $item->produto->produto_descricao }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-1">
            <div class="card nf-panel">
                <div>{{ $item->quantidade }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-2">
            <div class="card nf-panel">
                <div>{{ $item->lote }}</div>
            </div>
        </div>
        <div class="col col-sm-1 col-md-1 col-lg-2">
            <div class="card nf-panel">
                <div>{{ $item->autoclave }}</div>
            </div>
        </div>
        
    </div>
    @endforeach
    <div class="row">
        <div class="col col-sm-10 col-md-10 col-lg-10">
            
        </div>
        
    </div>
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <div class="card nf-panel">
                <label for="#obs" class="nf-label">Observações:</label>
                <div id="obs">{!! ($ordemServico->obs) ? $ordemServico->obs : '&nbsp;' !!}</div>
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
                <strong>{{ $ordemServico->user->name ?? 'Usuário não informado' }}</strong> 
            </div>
            <div class="col col-sm-2 col-md-2 col-lg-2">
            </div>
            <div class="col col-sm-4 col-md-4 col-lg-4" align="center">
                <strong>{{ $ordemServico->departamento->departamento }}</strong> 
            </div>
        </div>
    </div>
</div>
@endsection