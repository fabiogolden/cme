@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Novo Bico', 
            'routeUrl' => route('bico.store'), 
            'method' => 'POST',
            'formButtons' => [
                ['type' => 'submit', 'label' => 'Salvar', 'icon' => 'ok'],
                ['type' => 'button', 'label' => 'Cancelar', 'icon' => 'remove']
                ]
            ])
            @section('formFields')
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'num_bico',
                            'label' => 'N. Bico',
                            'required' => true,
                            'autofocus' => true,
                            'inputValue' => isset($bico->num_bico) ? $bico->num_bico : '',
                            'inputSize' => 2
                        ],
                        [
                            'type' => 'select',
                            'field' => 'bomba_id',
                            'label' => 'Bomba',
                            'required' => true,
                            'items' => $bombas,
                            'inputSize' => 3,
                            'displayField' => 'descricao_bomba',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'indexSelected' => isset($bico->bomba_id) ? $bico->bomba_id : ''
                        ],
                        [
                            'type' => 'select',
                            'field' => 'tanque_id',
                            'label' => 'Tanque',
                            'required' => true,
                            'items' => $tanques,
                            'inputSize' => 3,
                            'displayField' => 'descricao_tanque',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'indexSelected' => isset($bico->tanque_id) ? $bico->tanque_id : ''
                        ],
                        [
                            'type' => 'text',
                            'field' => 'encerrante',
                            'label' => 'Encerrante',
                            'required' => true,
                            'inputValue' => isset($bico->encerrante) ? $bico->encerrante : '',
                            'inputSize' => 3
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
    <script>
        $('document').ready(function() {
            $(encerrante).mask('0.999', {reverse: true});
        });
    </script>
@endsection