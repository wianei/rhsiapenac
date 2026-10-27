@extends('theme.theme')

@section('content')
    <h2><i class="fas fa-users"></i> Servidores por lotação</h2>

    <hr>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->

    <ul class="ulMenuDados mt-5">
        <li class="liMenuShow" id="btnDerGa"><i class="fa fa-institution"></i>

            <div class="fontSize05em">
                DER-GA
                @if($qtdDerGa>1)
                    ({{ $qtdDerGa }} servidores)
                @else
                    ({{ $qtdDerGa }} servidor)
                @endif
            </div>
        </li>
        <li class="liMenuShow" id="btnDerLi"><i class="fa fa-institution"></i>

            <div class="fontSize05em">
                DER-LI
                @if($qtdDerLi>1)
                    ({{ $qtdDerLi }} servidores)
                @else
                    ({{ $qtdDerLi }} servidor)
                @endif
            </div>
        </li>
        <li class="liMenuShow" id="btnDerRs"><i class="fa fa-institution"></i>

            <div class="fontSize05em">
                DER-RS
                @if($qtdDerRs>1)
                    ({{ $qtdDerRs }} servidores)
                @else
                    ({{ $qtdDerRs }} servidor)
                @endif
            </div>
        </li>
        <li class="liMenuShow" id="btnDerSep"><i class="fa fa-institution"></i>

            <div class="fontSize05em">
                DER-SEP
                @if($qtdDerSep>1)
                    ({{ $qtdDerSep }} servidores)
                @else
                    ({{ $qtdDerSep }} servidor)
                @endif
            </div>
        </li>

        <li class="liMenuShow" id="btnGabinete"><i class="fa fa-institution"></i>

            <div class="fontSize05em">
                Gabinete
                @if($qtdGabinete>1)
                    ({{ $qtdGabinete }} servidores)
                @else
                    ({{ $qtdGabinete }} servidor)
                @endif
            </div>
        </li>
    </ul>

    <div class="ml-4em w-100">
        <div class="row displayDados" id="coordDerGa">
            @foreach($dados as $d)
                @if($d['coordenadoria'] == 2)
                    <div class="col-sm-2 p-0 m-0 mr-2 mt-2">
                        <div class="card">
                            <h5 class="card-header bg-primary colorFFF text-center">

                                @if($d['quantidade'] > 1)
                                    {{ $d['quantidade'] }} Servidores
                                @elseif($d['quantidade'] == 0)
                                    -
                                @elseif($d['quantidade'] == 1)
                                    {{ $d['quantidade'] }} Servidor
                                @endif

                                <a href="#" id="{{ $d['id'] }}" data-toggle="modal" data-target=".bd-example-modal-lg" title="Visualizar servidores" class="float-right colorFFF aIframe"><i class="fas fa-external-link-square-alt"></i></a>
                            </h5>
                            <div class="card-body">
                                <p class="card-text text-center">{{ $d['lotacao'] }}</p>
                            </div>
                        </div>

                    </div>
                @endif

            @endforeach
        </div>

        <div class="row displayDados" id="coordDerLi">
            @foreach($dados as $d)
                @if($d['coordenadoria'] == 3)
                    <div class="col-sm-2 p-0 m-0 mr-2 mt-2">
                        <div class="card">
                            <h5 class="card-header bg-primary colorFFF text-center">

                                @if($d['quantidade'] > 1)
                                    {{ $d['quantidade'] }} Servidores
                                @elseif($d['quantidade'] == 0)
                                    -
                                @elseif($d['quantidade'] == 1)
                                    {{ $d['quantidade'] }} Servidor
                                @endif

                                <a href="#" id="{{ $d['id'] }}" data-toggle="modal" data-target=".bd-example-modal-lg" title="Visualizar servidores" class="float-right colorFFF aIframe"><i class="fas fa-external-link-square-alt"></i></a>
                            </h5>
                            <div class="card-body">
                                <p class="card-text text-center">{{ $d['lotacao'] }}</p>
                            </div>
                        </div>

                    </div>
                @endif

            @endforeach
        </div>

        <div class="row displayDados" id="coordDerRs">
            @foreach($dados as $d)
                @if($d['coordenadoria'] == 4)
                    <div class="col-sm-2 p-0 m-0 mr-2 mt-2">
                        <div class="card">
                            <h5 class="card-header bg-primary colorFFF text-center">

                                @if($d['quantidade'] > 1)
                                    {{ $d['quantidade'] }} Servidores
                                @elseif($d['quantidade'] == 0)
                                    -
                                @elseif($d['quantidade'] == 1)
                                    {{ $d['quantidade'] }} Servidor
                                @endif

                                <a href="#" id="{{ $d['id'] }}" data-toggle="modal" data-target=".bd-example-modal-lg" title="Visualizar servidores" class="float-right colorFFF aIframe"><i class="fas fa-external-link-square-alt"></i></a>
                            </h5>
                            <div class="card-body">
                                <p class="card-text text-center">{{ $d['lotacao'] }}</p>
                            </div>
                        </div>

                    </div>
                @endif

            @endforeach
        </div>

        <div class="row displayDados" id="coordDerSep">
            @foreach($dados as $d)
                @if($d['coordenadoria'] == 5)
                    <div class="col-sm-2 p-0 m-0 mr-2 mt-2">
                        <div class="card">
                            <h5 class="card-header bg-primary colorFFF text-center">

                                @if($d['quantidade'] > 1)
                                    {{ $d['quantidade'] }} Servidores
                                @elseif($d['quantidade'] == 0)
                                    -
                                @elseif($d['quantidade'] == 1)
                                    {{ $d['quantidade'] }} Servidor
                                @endif

                                <a href="#" id="{{ $d['id'] }}" data-toggle="modal" data-target=".bd-example-modal-lg" title="Visualizar servidores" class="float-right colorFFF aIframe"><i class="fas fa-external-link-square-alt"></i></a>
                            </h5>
                            <div class="card-body">
                                <p class="card-text text-center">{{ $d['lotacao'] }}</p>
                            </div>
                        </div>

                    </div>
                @endif

            @endforeach
        </div>
        <div class="row displayDados" id="coordGabinete">
            @foreach($dados as $d)
                @if($d['coordenadoria'] == 1)
                    <div class="col-sm-2 p-0 m-0 mr-2 mt-2">
                        <div class="card">
                            <h5 class="card-header bg-primary colorFFF text-center">

                                @if($d['quantidade'] > 1)
                                    {{ $d['quantidade'] }} Servidores
                                @elseif($d['quantidade'] == 0)
                                    -
                                @elseif($d['quantidade'] == 1)
                                    {{ $d['quantidade'] }} Servidor
                                @endif

                                <a href="#" id="{{ $d['id'] }}" data-toggle="modal" data-target=".bd-example-modal-lg" title="Visualizar servidores" class="float-right colorFFF aIframe"><i class="fas fa-external-link-square-alt"></i></a>
                            </h5>
                            <div class="card-body">
                                <p class="card-text text-center">{{ $d['lotacao'] }}</p>
                            </div>
                        </div>

                    </div>
                @endif

            @endforeach
        </div>


    </div>

    <div class="modal fade bd-example-modal-lg" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <iframe src="{{ route('lotacao.pesquisaServidorIframe',1) }}" id="iframeTest" data-parm="" width="100%" height="100%" style="height: 40em" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="closebtn" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>

    <div class="w-100 mt-5">
        <h2><i class="fas fa-birthday-cake"></i> Aniversariantes do Mês {{ $mes }}</h2>
        <hr>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Data</th>
                <th scope="col">Lotação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($aniversariantes as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item['nome'] }}</td>
                <td>{{ $item['data'] }}</td>
                <td>{{ $item['lotacao'] }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('css')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('js/home.js') }}"></script>
@endpush
