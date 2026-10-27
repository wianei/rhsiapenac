<?php
use App\Http\Controllers\PermissaoController;
?>
@extends('theme.theme')

@section('content')

    @include('template._links_menu_servidor')

    <h1 class="tituloSeccao">

        @if($foto != false)
            <img src="{{url($foto)}}" height="100" alt="">
        @else
            <i class="fas fa-user-circle"></i>
        @endif

        {{json_decode($dadosView)->nome}}
        <a class="btn btn-primary float-right align-middle" id="btEditar"
           href="{{ route('servidor.editar', json_decode($dadosView)->id) }}" role="button"> <i class="fas fa-edit"></i> Editar</a>

    </h1>
    <hr>
    <div class="fichaGlobal">
        @php
        $dadosView = json_decode($dadosView);
        @endphp
        <div id="divDadosPessoais">
            <div class="row">
                <div class="col-6 mt-3"><strong>Data de Nascimento: </strong>{{$dadosView->data_nascimento}}</div>
                <div class="col-6 mt-3"><strong>Estado civil: </strong>{{$dadosView->estado_civil}}(a)</div>
                <div class="col-6 mt-3"><strong>Nacionalidade: </strong>{{$dadosView->nacionalidade}}</div>
                <div class="col-6 mt-3"><strong>Naturalidade cidade: </strong>{{$dadosView->naturalidade_cidade}}</div>
                <div class="col-6 mt-3"><strong>Naturalidade Estado: </strong>{{$dadosView->naturalidade_uf}}</div>
                <div class="col-6 mt-3"><strong>CTPS Número: </strong>{{$dadosView->carteira_trabalho_numero}}</div>
                <div class="col-6 mt-3"><strong>Série: </strong>{{$dadosView->carteira_trabalho_serie}}</div>
                <div class="col-6 mt-3"><strong>UF: </strong>{{$dadosView->carteira_trabalho_uf}}</div>
                <div class="col-6 mt-3"><strong>Título de Eleitor: </strong>{{$dadosView->titulo_eleitor_numero}}</div>
                <div class="col-6 mt-3"><strong>Zona: </strong>{{$dadosView->titulo_eleitor_zona}}</div>
                <div class="col-6 mt-3"><strong>Secção: </strong>{{$dadosView->titulo_eleitor_seccao}}</div>
                <div class="col-6 mt-3"><strong>Secção: </strong>{{$dadosView->titulo_eleitor_seccao}}</div>
                <div class="col-6 mt-3"><strong>UF: </strong>{{$dadosView->titulo_eleitor_uf}}</div>
                <div class="col-6 mt-3"><strong>Certificado Militar: </strong>{{$dadosView->certificado_militar}}</div>
            </div>
        </div>
        <hr>
        @if(PermissaoController::temPermissaoSetorPessoal())
            <div id="divEndereco">
                <h5><i class="fa fa-map-marker"></i> Endereço</h5>
                <div class="row">
                    <div class="col-6 mt-3"><strong>Endereço: </strong>{{$dadosView->residencia_logradouro}}</div>
                    <div class="col-6 mt-3"><strong>Número: </strong>{{$dadosView->residencia_numero}}</div>
                    <div class="col-6 mt-3"><strong>Complemento: </strong>{{$dadosView->residencia_complemento}}</div>
                    <div class="col-6 mt-3"><strong>Bairro: </strong>{{$dadosView->residencia_bairro}}</div>
                    <div class="col-6 mt-3"><strong>Cidade: </strong>{{$dadosView->residencia_cidade}}</div>
                    <div class="col-6 mt-3"><strong>Estado: </strong>{{$dadosView->residencia_estado}}</div>
                    <div class="col-6 mt-3"><strong>Cep: </strong>{{$dadosView->residencia_cep}}</div>
                </div>
            </div>
        <hr>
        <div id="divDependentes">
            <h5><i class="fa fa-sitemap"></i> Dependentes</h5>
            <div class="row">
                @foreach(json_decode($dependentes) as $dep)
                    <div class="col-6 mt-3"><strong>Nome: </strong>{{$dep->nome}}</div>
                    <div class="col-3 mt-3"><strong>Parentesco: </strong>{{$dep->parentesco}}</div>
                    <div class="col-3 mt-3"><strong>Data de nascimento: </strong>{{$dep->nascimento}}</div>
                @endforeach
                <div class="col-6"><strong>Quantidade dependente Salário
                        Família: </strong>{{$dadosView->dep_salario_familia}}</div>
                <div class="col-6"><strong>Quantidade dependente IRRF: </strong>{{$dadosView->dp_irrf}}</div>
            </div>
        </div>
        <hr>
        <div id="divConjuge">
            <h5><i class="fa fa-user"></i> Cônjuge</h5>
            <div class="row">
                <div class="col-6 mt-3"><strong>Cônjuge: </strong>{{$dadosView->conjuge_nome}}</div>
                <div class="col-6 mt-3"><strong>Matricula: </strong>{{$dadosView->conjuge_matricula}}</div>
                <div class="col-6 mt-3"><strong>Órgão: </strong>{{$dadosView->conjuge_orgao}}</div>
            </div>
        </div>
        @endif
        
    </div>
@endsection
@push('css')
<link href="{{ asset('css/servidor_show.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('js/servidor_show.js') }}"></script>
@endpush