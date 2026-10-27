@extends('theme.theme')

@section('content')
    <h2 class="tituloSeccao"><i class="fas fa-chart-area"></i></i> Relatório de {{$menuNome}}
        <div id="dataRelatorio">
            <h6 class="float-right">impresso por {{Auth::user()->matricula}} em {{ $dataRelatorio }}</h6>
        </div>
    </h2>

    @include('template._cabecalho_relatorio')

    <button class="btn btn-dark float-left mb-2 mr-2" id="btBack"><i class="fas fa-arrow-circle-left"></i> Voltar
    </button>
    <a href="#" id="btPrint" class="btn btn-dark float-left mb-2"><i class="fas fa-print"></i> Imprimir</a>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome do Servidor</th>
            <th scope="col">Matrícula</th>
            <th scope="col">Lotação</th>
            <th scope="col">Data Início</th>
            <th scope="col">Data Fim</th>
            <th scope="col">Tipo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($resultado as $result)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$result['nome']}}</td>
                <td>{{$result['matricula']}}</td>
                <td>{{ $result['lotacao'] }}</td>
                <td>{{ $result['data_inicio'] }}</td>
                <td>{{ $result['data_fim'] }}</td>
                <td>{{ $result['tipo'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
@push('css')
<link href="{{ asset('css/utilities/utilities.css') }}" rel="stylesheet">
<link href="{{ asset('css/relatorio_resultado.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('js/relatorio_resultado.js') }}"></script>
@endpush