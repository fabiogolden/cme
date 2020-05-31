@extends('layouts.app')

@section('content')
@php

   

@endphp
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPessoas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Pessoas
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownPessoas">
        @permission('listar-atendente')
        <li><a class="dropdown-item" href="{{route('atendente.index')}}">Atendentes</a></li>
        @endpermission
        @permission('listar-cliente')
        <li><a class="dropdown-item" href="{{route('cliente.index')}}">Clientes</a></li>
        @endpermission
        @permission('listar-fornecedor')
        <li><a class="dropdown-item" href="{{route('fornecedor.index')}}">Fornecedores</a></li>
        @endpermission
        <div class="dropdown-divider"></div>
        @permission('listar-departamento')
        <li><a class="dropdown-item" href="{{route('departamento.index')}}">Departamentos</a></li>
        @endpermission
    </ul>
</li>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Modal pequeno</button>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        
    </div>
  </div>
</div>

@endsection