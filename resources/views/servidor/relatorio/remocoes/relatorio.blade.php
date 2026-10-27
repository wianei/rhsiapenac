@extends('theme.theme')

@section('content')

    @include('template._links_menu_servidor')

    <h1 class="tituloSeccao mt-3">
    @if($foto != false)
        <img src="{{url($foto)}}" height="100" alt="">
    @else
        <i class="fas fa-user-circle"></i>
    @endif
    {{json_decode($dadosView)->nome}} </h1>
    <h6 id="situacaoServidor" class="blockquote-footer w-50 "> {{ json_decode($dadosView)->situacao }} </h6>

    <hr>

    @include('template._menu_relatorio_individual')

    <div class="m-b-20 mt-5 mb-5">
        <form action="{{ route('servidor.relatorios.remocoes',$id) }}" method="post" id="formFiltro">
            {!! csrf_field() !!}
            <h4><i class="fa fa-filter"></i> FILTROS <i class="fa fa-sort-down m-l-15" id="filtroIcon"></i></h4>

            <div id="divformFiltro">

                <div class="form-row">

                    <div class="form-group col-sm-3 float-left">
                        <label for="data_inicio">Data inicial</label>
                        <input type="text" autocomplete="off" class="form-control" name="data_inicio" id="data_inicio" placeholder="">
                    </div>
                    <div class="form-group col-sm-3 float-left">
                        <label for="data_final">Data final</label>
                        <input type="text" autocomplete="off" class="form-control" name="data_final" id="data_final" placeholder="">
                    </div>
                </div>
                <button type="submit" id="btnPesquisar" class="btn btn-dark m-t-20 buscaAjax">Gerar Relatório</button>
            </div>
        </form>
    </div>

    @include('template._cabecalho_relatorio')

    @if(count($resultado) > 0)
    <div class="w-100" id="dadosCabecalhoServidor">
        <div class="row">
            <div class="col-sm-7">
                <strong>Servidor: </strong> {{ json_decode($dadosView)->nome }}
            </div>

            <div class="col-sm-3">
                <strong>Lotação: </strong>{{ $resultado[0]['lotacao'] }}
            </div>

            <div class="col-sm-2">
                <strong>Matrícula: </strong>{{ json_decode($dadosView)->matricula }}
            </div>

        </div>
    </div>

    <a href="#" id="btPrint" class="btn btn-dark float-right mb-2"><i class="fas fa-print"></i> Imprimir</a>
    <button class="btn btn-dark float-right mb-2 mr-2" id="btBack"><i class="fas fa-arrow-circle-left"></i> Voltar
    </button>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Data Início</th>
            <th scope="col">Lotação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($resultado as $result)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $result['data_inicio'] }}</td>
                <td>{{ $result['tipo'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif

@endsection
@push('css')
<link href="{{ asset('css/relatorio_servidor_individual.css') }}" rel="stylesheet">
<link href="{{ asset('css/relatorio_resultado.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('script')
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script src="{{ asset('js/relatorio_servidor_individual.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush