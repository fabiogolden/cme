@extends('layouts.app')

@section('content')
<div id="ordem_servico">
    <div class="card m-0 border-0">
        @component('components.form', [
            'title' => 'Nova Ordem de Serviço', 
            'routeUrl' => route('ordem_servico.store'), 
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
                            'type' => 'select',
                            'field' => 'cliente_id',
                            'label' => 'Cliente',
                            'required' => true,
                            'items' => $clientes,
                            'inputSize' => 5,
                            'displayField' => 'nome_razao',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'defaultNone' => false,
                            
                        ],
                        
                        [
                            'type' => 'select',
                            'field' => 'departamento_id',
                            'label' => 'Departamento',
                            'required' => true,
                            'items' => $departamentos,
                            'inputSize' => 3,
                            'displayField' => 'departamento',
                            'keyField' => 'id',
                            'liveSearch' => true,
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        
                        
                        [
                            'type' => 'text',
                            'field' => 'funcionario',
                            'label' => 'Funcionario',
                            'required' => true,
                            'autofocus' => true,
                            'inputSize' => 3,
                            'css' => 'text-uppercase'
                          
                        ],
                        [
                            'type' => 'select',
                            'field' => 'ordem_servico_status_id',
                            'label' => 'Status',
                            'inputSize' => 2,
                            'items' => $ordemServicoStatus,
                            'displayField' => 'os_status',
                            'keyField' => 'id'
                        ],
                        [
                            'type' => 'select',
                            'field' => 'atendente_id',
                            'label' => '-',
                            'required' => false,
                            'items' => $atendentes,
                            'inputSize' => 1,
                            'displayField' => 'id',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'inputvalue' => null,
                            'visible' => false
                        ],
                    ]
                ])
                @endcomponent
                <ordem-servico 
                    v-bind:estoques="{{ json_encode($estoques) }}" 
                    :old-estoque-id="{{ json_encode(old('estoque_id')) }}"
                    :old-produtos-data="{{ json_encode(old('produtos')) }}">
                </ordem-servico>
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'textarea',
                            'field' => 'obs',
                            'label' => 'Observações',
                            'css' => 'text-uppercase'
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
</div>
@endsection
@push('bottom-scripts')
    <script src="{{ mix('js/os.js') }}"></script>
@endpush
@push('document-ready')



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
            console.log(data);
            $("#veiculo_id")
                .removeAttr('disabled')
                .find('option')
                .remove();
            
            $('#veiculo_id').append($('<option>', {value: null, text: 'Nada selecionado'}));

            $.each(data, function (i, item) {
                $('#veiculo_id').append($('<option>', { 
                    value: item.id,
                    'data-tipo-controle-veiculo': item.modelo_veiculo.tipo_controle_veiculo.id,
                    text : item.placa + ' - ' + item.modelo_veiculo.marca_veiculo.marca_veiculo + ' ' + item.modelo_veiculo.modelo_veiculo
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
$('#veiculo_id').on('changed.bs.select', (e) => {
        if ($('#'+e.target.id).find('option:selected').data('tipo-controle-veiculo') == 1) {
            $('#label__km_veiculo').html('KM do Veículo');
        } else {
            $('#label__km_veiculo').html('Horas trabalhadas');
        }
});
@endpush