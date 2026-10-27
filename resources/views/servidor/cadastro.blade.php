@extends('theme.theme')

@section('content')
    @if(!isset($servidor))
        <h1 class="tituloSeccao"><i class="fa fa-user-plus"></i>
            Cadastro de Servidores
            <img src="#" id="imgServidor" height="100" alt="" class="float-right">

            <label for="inputFile" id="labelFileImage" class="btnFile">
                <img src="{{asset("images/addPhoto.jpg")}}" height="100" alt="" class="float-right mr-2">
            </label>
        </h1>

    @elseif($foto != false)
        <h1 class="tituloSeccao">
            Alteração de Dados do Servidor
            <img src="{{asset($foto)}}" id="imgServidor" height="100" alt="" class="float-right">
            <label for="inputFile" id="labelFileImage" class="btnFile"  data-toggle="tooltip" data-placement="top" title="Adicionar foto">
                <img src="{{asset("images/addPhoto.jpg")}}" height="100" alt="" class="float-right mr-2">
            </label>
        </h1>
    @else
        <h1 class="tituloSeccao">
            Alteração de Dados do Servidor
            <img src="#" id="imgServidor" height="100" alt="" class="float-right">

            <label for="inputFile" id="labelFileImage" class="btnFile"  data-toggle="tooltip" data-placement="top" title="Adicionar foto">
                <img src="{{asset("images/addPhoto.jpg")}}" height="100" alt="" class="float-right mr-2">
            </label>
        </h1>

    @endif
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close"
                                                                                         data-dismiss="alert"
                                                                                         aria-label="close">&times;</a>
                </p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->
    @include('template._form_cadastro_servidor')
@endsection
@push('css')
<link href="{{ asset('css/utilities/utilities.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('js/cadastro.js') }}"></script>
@endpush