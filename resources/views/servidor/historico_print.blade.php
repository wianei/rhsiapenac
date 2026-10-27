@extends('theme.theme')

@section('content')
    <a href="#" id="btPrint" class="btn btn-dark float-left mb-2"><i class="fas fa-print"></i> Imprimir</a>
    <br/>
    <div class="w-100" id="dadosCabecalhoServidor">
        @include('template._cabecalho_relatorio')
        <div id="subcabecalho" class="row">
            <div class="col-sm-7">
                <strong>Servidor: </strong> {{ json_decode($servidor)->nome }}
            </div>

            <div class="col-sm-3">
                <strong>Lotação: </strong>{{ json_decode($servidor)->lotacao }}
            </div>

            <div class="col-sm-2">
                <strong>Matrícula: </strong>{{ json_decode($servidor)->matricula }}
            </div>

        </div>
    </div>
    <br/>
    @foreach(($dadosHistorico) as $dh)
        <div class="card mb-2">
            <div class="card-header">
                <!-- titulo do evento -->
                @if($dh['status'] == "R")
                    <div class="eventoRevogado">Data do Evento: {{$dh['data']}} {{$dh['tipo']}}</div>
                @else
                    Data do Evento: {{$dh['data']}} {{$dh['tipo']}}
                @endif
            </div>
            <div class="card-body">
                {{$dh['descricao']}}
            </div>
        </div>
    @endforeach
@endsection

@push('css')
<link href="{{ asset('css/historico_print.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('js/relatorio_servidor_individual.js') }}"></script>
@endpush