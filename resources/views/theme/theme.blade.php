<?php
    use App\Http\Controllers\PermissaoController;
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset("css/bootadmin.min.css") }}">

    <link rel="stylesheet" href="{{ asset("css/style.css") }}">

    <!-- css adicional passado pelas views -->
    @stack('css')

    <title>{{ config('app.name') }}</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="{{ route('home') }}">
        <img class="imageLogo" src="{{asset("images/logo_secretaria.png")}}" alt="">
        <h1 class="tituloNavBar">{{ config('app.name') }}</h1>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <!--
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i> 5</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> 3</a></li>
            -->
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->name }} </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                    <a href="{{route('alterar.senha')}}" class="dropdown-item"><i class="fas fa-key"></i> Alterar Senha</a>
                    <a href="{{route('logout')}}" class="dropdown-item"><i class="fas fa-power-off"></i> Sair</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="d-flex">
    <div class="sidebar sidebar-dark bg-dark">
        <ul class="list-unstyled">
            <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> PÁGINA INICIAL</a></li>
            <li><a href="{{ route('servidor.pesquisa') }}"><i class="fa fa-search"></i> PESQUISAR SERVIDOR</a></li>
            @if(PermissaoController::temPermissaoSetorPessoal())
            <li><a href="{{ route('servidor_cadastro') }}"><i class="fa fa-plus"></i> CADASTRAR SERVIDOR</a></li>
            @endif
            <li>
                <a href="#sm_expand_2" data-toggle="collapse">
                    <i class="fas fa-clipboard-list"></i> RELATÓRIOS
                </a>
                <ul id="sm_expand_2" class="list-unstyled collapse">
                    <li><a href="{{ route('relatorio.relatorio',1) }}"> ATESTADOS</a></li>
                    <li><a href="{{ route('relatorio.afastamento',5) }}"> AFASTAMENTOS</a></li>
                    <li><a href="{{ route('relatorio.concessoes',8) }}"> CONCESSÕES</a></li>
                    <li><a href="{{ route('relatorio.elogio',16) }}"> ELOGIOS</a></li>
                    <li><a href="{{ route('relatorio.ferias',9) }}"> FÉRIAS</a></li>
                    <li><a href="{{ route('relatorio.licencas',7) }}"> LICENÇAS</a></li>
                    <li><a href="{{ route('relatorio.penalidades',10) }}"> PENALIDADES</a></li>
                    <li><a href="{{ route('relatorio.remocoes',11) }}"> REMOÇÕES</a></li>
                    <li><a href="{{ route('relatorio.redistribuicoes',12) }}"> REDISTRIBUIÇÕES</a></li>
                    <li><a href="{{ route('relatorio.substituicoes',13) }}"> SUBSTITUIÇÕES</a></li>
                    <li><a href="{{ route('relatorio.vacancias',14) }}"> VACÂNCIAS</a></li>
                    <li><a href="{{ route('relatorio.servidor') }}"> SERVIDOR POR UNIDADE</a></li>
                    <li><a href="{{ route('relatorio.comissionados') }}"> COMISSIONADOS</a></li>
                   <!-- <li><a href="#"> VANTAGENS</a></li> -->
                </ul>
            </li>
            {{--<li>--}}
                {{--<a href="#sm_expand_3" data-toggle="collapse">--}}
                    {{--<i class="fas fa-file-alt"></i> EMISSÃO DE DOCUMENTOS--}}
                {{--</a>--}}
                {{--<ul id="sm_expand_3" class="list-unstyled collapse">--}}
                    {{--<li><a href="#"> CARTEIRA FUNCIONAL</a></li>--}}
                    {{--<li><a href="#"> DECLARAÇÃO DE PORTE DE ARMA</a></li>--}}
                    {{--<li><a href="#"> DECLARAÇÃO FUNCIONAL</a></li>--}}
                    {{--<li><a href="#"> DECLARAÇÃO DE VENCIMENTOS</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        </ul>
    </div>

    <div class="content p-4">

        @yield('content')

    </div>

</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/bootadmin.min.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
@stack('script')
</body>
</html>
