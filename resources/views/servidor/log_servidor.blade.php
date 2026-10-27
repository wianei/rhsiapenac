@extends('theme.theme')

@section('content')

    @include('template._links_menu_servidor')

    <h1 class="tituloSeccao">
    @if($foto != false)
        <img src="{{url($foto)}}" height="100" alt="">
    @else
        <i class="fas fa-user-circle"></i>
    @endif
    {{json_decode($dadosView)->nome}} </h1>
    <h6 class="blockquote-footer w-50 "> {{ json_decode($dadosView)->situacao }} </h6>

    <hr>


    @foreach($logServidor as $l)
    <div class="alert alert-dark" role="alert">
        <div class="float-left  blockquote-footer">
            <i>Em {{$l['data']}} às {{$l['hora']}} por: {{$l['usuario']}}</i>
        </div>
        <br>
        <div class="cf m-1 p-1">
            {!! $l['texto'] !!}
        </div>
    </div>
    @endforeach
@endsection
@push('css')
<link href="{{ asset('css/servidor_historico.css') }}" rel="stylesheet">
@endpush