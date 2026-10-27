@extends('theme.theme')

@section('content')
    <h2 class="tituloSeccao"><i class="fas fa-chart-area"></i></i> Relatório de {{$menuNome}}</h2>
    @include('template._filtro_relatorio_afastamento')

    <div class="modal fade bd-example-modal-lg" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <iframe src="{{ route('servidor.pesquisaIframe') }}" id="iframeTest" data-parm="" width="100%" height="100%" style="height: 40em" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="closebtn" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>


@endsection
@push('css')
<link href="{{ asset('css/utilities/utilities.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('script')
<script src="{{ asset('js/relatorio_atestado.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush