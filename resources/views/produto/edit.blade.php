@extends('layouts.app')

@section('content')
    {{--  {{ dd($estoques) }}  --}}
    <div class="card m-0 border-0">
        @component('components.form', [
            'title' => 'Alterar Produto', 
            'routeUrl' => route('produto.update', $produto->id), 
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
                            'field' => 'produto_descricao',
                            'label' => 'Descrição',
                            'required' => true,
                            'autofocus' => true,
                            'inputSize' => 6,
                            'inputValue' => $produto->produto_descricao
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
                            'indexSelected' => $produto->grupo_produto_id
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
                            'indexSelected' => $produto->unidade_id
                        ],
                        [
                            'type' => 'text',
                            'field' => 'numero_serie',
                            'label' => 'Número de Série',
                            'inputSize' => 6,
                            'inputValue' => $produto->numero_serie
                        ]
                    ]
                ])
                @endcomponent
                
                
                <div class="row">
                    <div class="col-md-4">
                        @component('components.input-checklist-group', [
                            'items' => $fornecedores,
                            'label' => 'nome_razao',
                            'field' => 'fornecedores[]',
                            'title' => 'Fornecedores',
                            'value' => 'id',
                            'indexSelected' => $produto->fornecedores()->pluck('fornecedor_id')
                        ])
                        @endcomponent
                    </div>
                    <div class="col-md-8" id="estoque-produto-component">
                        <estoque-produto :estoques-data="{{ json_encode($listaEstoques) }}" :old-data="{{ json_encode((old('estoques')) ? old('estoques') : $estoques) }}"></estoque-produto>                      
                    </div>
                </div>
            @endsection
        @endcomponent
    </div>
@endsection
@push('document-ready')
    $('#controla_vencimento').on('changed.bs.select', (e) => {
        $('#vencimento_dias').prop('readonly', (e.target.value == 0));
        $('#vencimento_km').prop('readonly', (e.target.value == 0));
        $('#vencimento_horas_trabalhadas').prop('readonly', (e.target.value == 0));
        if (e.target.value == 0) {
           $('#vencimento_dias').val(''); 
           $('#vencimento_km').val('');
           $('#vencimento_horas_trabalhadas').val('');
        }
    });
@endpush
@push('bottom-scripts')
    <script src="{{ mix('js/estoqueproduto.js') }}"></script>
@endpush