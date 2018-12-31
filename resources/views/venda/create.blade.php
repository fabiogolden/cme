@extends('layouts.app')

@section('content')
    <div class="card">
        @component('components.form', [
            'title' => 'Novo Produto', 
            'routeUrl' => route('produto.store'), 
            'method' => 'POST',
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
                            'field' => 'produto_descricao',
                            'label' => 'Descrição',
                            'required' => true,
                            'autofocus' => true,
                            'inputValue' => isset($produto->produto_descricao) ? $produto->produto_descricao : '',
                            'inputSize' => 6
                        ],
                        [
                            'type' => 'text',
                            'field' => 'produto_desc_red',
                            'label' => 'Descrição Reduzida',
                            'inputValue' => isset($produto->produto_desc_red) ? $produto->produto_desc_red : '',
                            'inputSize' => 2
                        ],
                        [
                            'type' => 'select',
                            'field' => 'grupo_produto_id',
                            'label' => 'Grupo',
                            'required' => true,
                            'items' => $grupoProdutos,
                            'inputSize' => 4,
                            'displayField' => 'grupo_produto',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'indexSelected' => isset($produto->grupo_produto_id) ? $produto->grupo_produto_id : ''
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'select',
                            'field' => 'unidade_id',
                            'label' => 'Unidade',
                            'required' => true,
                            'items' => $unidades,
                            'inputSize' => 4,
                            'displayField' => 'unidade',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'indexSelected' => isset($produto->unidade_id) ? $produto->unidade_id : ''
                        ],
                        [
                            'type' => 'text',
                            'field' => 'valor_unitario',
                            'label' => 'Valor Unitário',
                            'inputValue' => isset($produto->valor_unitario) ? $produto->valor_unitario : '',
                            'inputSize' => 4
                        ],
                        [
                            'type' => 'text',
                            'field' => 'qtd_estoque',
                            'label' => 'Qtd. Estoque',
                            'inputValue' => isset($produto->qtd_estoque) ? $produto->qtd_estoque : '',
                            'inputSize' => 4
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
    <script>
        jQuery(function($){
            $("#valor").mask('0.00', {reverse: true});
        });
    </script>
@endsection