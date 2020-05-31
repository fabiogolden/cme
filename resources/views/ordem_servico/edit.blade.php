@extends('layouts.app')


@section('content')
    <div class="card m-0 border-0">
        @component('components.form', [
            'title' => 'Alterar Ordem de Servico', 
            'routeUrl' => route('ordem_servico.update', $ordemServico->id), 
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
                            'type' => 'select',
                            'field' => 'cliente_id_readonly',
                            'label' => 'Cliente',
                            'items' => $ordemServico->departamento->cliente->get(),
                            'inputSize' => 5,
                            'displayField' => 'nome_razao',
                            'keyField' => 'id',
                            'disabled' => true,
                            'indexSelected' => $ordemServico->departamento->cliente_id
                        ],
                        [
                            'type' => 'hidden',
                            'field' => 'cliente_id',
                            'inputValue' => $ordemServico->departamento->cliente_id
                        ],
                        [
                            'type' => 'select',
                            'field' => 'departamento_id_readonly',
                            'label' => 'Departamento',
                            'items' => $ordemServico->departamento->get(),
                            'inputSize' => 3,
                            'displayField' => 'departamento',
                            'keyField' => 'id',
                            'disabled' => true,
                            'indexSelected' => $ordemServico->departamento_id
                        ],
                        [
                            'type' => 'hidden',
                            'field' => 'departamento_id',
                            'inputValue' => $ordemServico->departamento_id
                        ],
                        [
                            'type' => 'text',
                            'field' => 'funcionario',
                            'label' => 'Funcionario',
                            'required' => true,
                            'autofocus' => true,
                            'inputSize' => 3,
                            'inputValue' => $ordemServico->funcionario,

                        ],
                        [
                            'type' => 'select',
                            'field' => 'ordem_servico_status_id',
                            'label' => 'Status',
                            'inputSize' => 2,
                            'items' => $ordemServicoStatus,
                            'displayField' => 'os_status',
                            'keyField' => 'id',
                            'disabled' => (!$ordemServico->ordem_servico_status->em_aberto),
                            'indexSelected' => $ordemServico->ordem_servico_status_id
                        ]
                    ]
                ])
                @endcomponent
                <div id="ordem_servico">
                    <ordem-servico 
                        :servicos-data="{{ json_encode($servicos) }}" 
                        :old-servicos-data="{{ (old('servicos')) ? json_encode(old('servicos')) : json_encode($ordemServico->servicos) }}"
                        v-bind:estoques="{{ json_encode($estoques) }}" 
                        :old-estoque-id="{{ (old('estoque_id')) ? json_encode(old('estoque_id')) : $ordemServico->estoque_id }}"
                        :old-produtos-data="{{ (old('produtos')) ? json_encode(old('produtos')) : json_encode($ordemServico->produtos) }}">
                    </ordem-servico>
                </div>
                
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'textarea',
                            'field' => 'obs',
                            'label' => 'Observações',
                            'inputValue' => $ordemServico->obs
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@push('bottom-scripts')
    <script src="{{ mix('js/os.js') }}"></script>

    <script>
        $(document).ready(function() {
            var buscarVeiculos = function() {
                var cliente = {};

                cliente.id = $('#cliente_id').val();
                cliente._token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route("veiculos.json") }}',
                    type: 'POST',
                    data: cliente,
                    dataType: 'JSON',
                    cache: false,
                    success: function (data) {
                        $("#veiculo_id")
                            .removeAttr('disabled')
                            .find('option')
                            .remove();
                        
                        $.each(data, function (i, item) {
                            $('#veiculo_id').append($('<option>', { 
                                value: item.id,
                                text : item.placa 
                            }));
                        });

                        @if(old('veiculo_id'))
                        $('#veiculo_id').selectpicker('val', {{old('veiculo_id')}});
                        @endif

                        $('.selectpicker').selectpicker('refresh');
                    }
                });
            }
            $('#cliente_id').on('changed.bs.select', buscarVeiculos);
            
            if ($('#cliente_id').val()) {
                buscarVeiculos();
            }
        });
    </script>
@endpush
@endsection