@extends('theme.theme')

@section('content')
    <h2 class="tituloSeccao"><i class="fas fa-chart-area"></i> Relatório dos Servidores</h2>
    @include('template._filtro_relatorio_servidor')

@endsection
@push('css')
<link href="{{ asset('css/utilities/utilities.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('js/relatorio_atestado.js') }}"></script>
@endpush