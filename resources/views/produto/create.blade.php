@extends('layouts.app')

@section('content-no-app')
@if(old('fornecedores')) 
    {{--  {{ dd(old(str_replace('[]', '', 'fornecedores[]'))) }}  --}}
@endif
    <div class="card m-0 border-0">
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
                            'inputSize' => 6
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
                        ],
                        [
                            'type' => 'text',
                            'field' => 'numero_serie',
                            'label' => 'Número de Série',
                            'inputSize' => 6
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
                            'value' => 'id'
                        ])
                        @endcomponent
                    </div>
                    <div class="col-md-6" id="estoque-produto-component">
                        {{--  @component('components.input-checklist-group', [
                            'items' => $estoques,
                            'label' => 'estoque',
                            'field' => 'estoques[]',
                            'title' => 'Estoques',
                            'value' => 'id'
                        ])
                        @endcomponent  --}}  
                        <estoque-produto :estoques-data="{{ json_encode($listaEstoques) }}" :old-data="{{ json_encode(old('estoques')) }}"></estoque_produto>                      
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