@extends('layouts.app')

@section('content')
    <div class="card m-0 border-0">
        @component('components.form', [
            'title' => 'Alterar Grupo de Veículo', 
            'routeUrl' => route('tipo_movimentacao_produto.update', $tipoMovimentacaoProduto->id), 
            'method' => 'PUT',
            'formButtons' => [
                ['type' => 'submit', 'label' => 'Salvar', 'icon' => 'check'],
                ['type' => 'button', 'label' => 'Cancelar', 'icon' => 'times']
                ]
            ])
            @section('formFields')
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'tipo_movimentacao_produto',
                            'label' => 'Tipo de Movimentação de Produto',
                            'required' => true,
                            'autofocus' => true,
                            'inputValue' => $tipoMovimentacaoProduto->tipo_movimentacao_produto,
                            'inputSize' => 7
                        ],
                        [
                            'type' => 'select',
                            'field' => 'eh_entrada',
                            'label' => 'Entrada',
                            'inputSize' => 1,
                            'indexSelected' => $tipoMovimentacaoProduto->eh_entrada,
                            'items' => Array('Não', 'Sim'),
                            'disabled' => true
                        ],
                        [
                            'type' => 'select',
                            'field' => 'ativo',
                            'label' => 'Ativo',
                            'inputSize' => 1,
                            'indexSelected' => $tipoMovimentacaoProduto->ativo,
                            'items' => Array('Não', 'Sim'),
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection