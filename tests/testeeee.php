<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>{{ config('app.name') }}</title>
</head>
<body>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- css adicional passado pelas views -->
@stack('css')

<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="{{ asset("css/style.css") }}">
<script src="{{asset("js/theme.js")}}"></script>
<div id="throbber" style="display:none; min-height:120px;"></div>
    <div id="noty-holder"></div>
    <div id="wrapper">
        <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
    <span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ route('home') }}">
    <img class="imageLogo" src="{{asset("images/logo_estado.png")}}" alt="">
    <h1 class="tituloNavBar">{{ config('app.name') }}</h1>
</a>
</div>
    <!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">
    <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administração do Usuário <b
class="fa fa-angle-down"></b></a>
    <ul class="dropdown-menu">
    <li><a href="#"><i class="fa fa-fw fa-user"></i>Editar Perfil</a></li>
<li><a href="#"><i class="fa fa-fw fa-cog"></i>Alterar Senha</a></li>
<li class="divider"></li>
    <li><a href="{{route('logout')}}"><i class="fa fa-fw fa-power-off"></i> Sair</a></li>
    </ul>
    </li>
    </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
    <li>
    <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-user"></i> SERVIDOR <i class="fa fa-fw fa-angle-down pull-right"></i></a>
    <ul id="submenu-1" class="collapse">
    <li><a href="{{ route('servidor.pesquisa') }}"><i class="fa fa-search"></i> PESQUISAR</a></li>
    <li><a href="{{ route('servidor_cadastro') }}"><i class="fa fa-plus"></i> CADASTRAR</a></li>
    </ul>
    </li>
    <li>
    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-pie-chart"></i> RELATÓRIOS
    <i class="fa fa-fw fa-angle-down pull-right"></i></a>
    <ul id="submenu-2" class="collapse">
    <li><a href="#"><i class="fa fa-genderless"></i> ATESTADOS</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> AFASTAMENTOS</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> CONCESSÕES</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> FÉRIAS</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> LICENÇAS</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> PENALIDADES</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> REMOÇÕES</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> REDISTRIBUIÇÕES</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> SUBSTITUIÇÕES</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> VACÂNCIAS</a></li>
    <li><a href="#"><i class="fa fa-genderless"></i> VANTAGENS</a></li>

    </ul>
    </li>
    </ul>
    </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
    <div class="container-fluid">
<!-- Page Heading -->
@yield('content')
</div>
    <!-- /.container-fluid -->
</div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->
@stack('script')
</body>
</html>