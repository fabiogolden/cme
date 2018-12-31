@extends('layouts.app')

@section('content')
    <div class="card">
        @component('components.form', [
            'title' => 'Novo Usuário', 
            'routeUrl' => route('user.store'), 
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
                            'field' => 'name',
                            'label' => 'Nome',
                            'required' => true,
                            'autofocus' => true,
                            'inputValue' => isset($user->name) ? $user->name : '',
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'username',
                            'label' => 'Usuário',
                            'required' => true,
                            'inputValue' => isset($user->username) ? $user->username : '',
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'email',
                            'label' => 'E-mail',
                            'required' => true,
                            'inputValue' => isset($user->email) ? $user->email : '',
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'password',
                            'field' => 'password',
                            'label' => 'Senha',
                            'required' => true,
                            'inputSize' => 6
                        ],
                        [
                            'type' => 'password',
                            'field' => 'password_confirmation',
                            'label' => 'Confirmação de Senha',
                            'required' => true,
                            'inputSize' => 6
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection