@extends('theme.theme')

@section('content')

    @include('template._links_menu_servidor')

    <h1 class="tituloSeccao mt-3"><i class="fas fa-user-circle"></i> {{json_decode($dadosView)->nome}} </h1>
    <h6 class="blockquote-footer w-50 "> {{ json_decode($dadosView)->situacao }} </h6>
    <hr>

    <ul class="ulMenuDados mt-5">
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">ATESTADOS</div></li>
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">AFASTAMENTOS</div></li>
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">CONCESSÕES</div></li>
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">ELOGIOS</div></li>
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">FÉRIAS</div></li>
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">LICENÇAS</div></li>
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">PENALIDADES</div></li>
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">REMOÇÕES</div></li>
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">REDISTRIBUIÇÕES</div></li>
        <li class="liMenuShow"><i class="fas fa-chart-area"></i> <div class="fontSize05em">SUBSTITUIÇÕES</div></li>
    </ul>

    {{--@include('template._filtro_relatorio')--}}

@endsection
@push('css')
<link href="{{ asset('css/relatorio_servidor_individual.css') }}" rel="stylesheet">
@endpush