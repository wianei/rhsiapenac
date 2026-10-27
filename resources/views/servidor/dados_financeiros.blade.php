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
        <div id="divDadosFinanceiros">
            <h5><i class="fa fa-money"></i> Dados Financeiros</h5>
            <div class="row">
                <div class="col-6 mt-3"><strong>Banco: </strong>{{$dadosView->banco}}</div>
                <div class="col-6 mt-3"><strong>Conta Corrente: </strong>{{$dadosView->conta_corrente}}</div>
                <div class="col-6 mt-3"><strong>Agência Bancária: </strong>{{$dadosView->agencia_bancaria}}</div>
                <div class="col-6 mt-3"><strong>PIS / NIS: </strong>{{$dadosView->pis}}</div>
                <div class="col-6 mt-3"><strong>PASEP: </strong>{{$dadosView->pasep}}</div>
            </div>
        </div>

    </div>
@endsection
@push('css')
<link href="{{ asset('css/servidor_show.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('js/servidor_show.js') }}"></script>
@endpush