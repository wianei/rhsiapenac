<?php
use App\Http\Controllers\PermissaoController;
?>
@extends('theme.theme')

@section('content')

    @include('template._links_menu_servidor')

    <h1 class="tituloSeccao mt-3">
        @if($foto != false)
            <img src="{{url($foto)}}" height="100" alt="">
        @else
            <i class="fas fa-user-circle"></i>
        @endif {{json_decode($dadosView)->nome}} </h1>
    <h6 class="blockquote-footer w-50 "> {{ json_decode($dadosView)->situacao }} </h6>
    <hr/>

    <button type="button" id="btAddArquivo" class="btn btn-primary btn-lg btn-block mb-3 mt-3"><i class="fas fa-plus-circle"></i> Inserir documentos</button>
    <hr/>
    <form class="formAddArquivo" id="formAddArquivo" action="{{ route('servidor.documentosStore',json_decode($dadosView)->id) }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="titulo">Título do documento</label>
                <select name="titulo" placeholder="Título do Documento" id="titulo" class="form-control" required>
                    <option value="" selected>Selecione uma categoria</option>
                    <option value="RG">RG</option>
                    <option value="CPF">CPF</option>
                    <option value="Comprovante de Residência">Comprovante de Residência</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Certificado de Alistamento/Reservista Militar">Certificado de Alistamento/Reservista Militar</option>
                    <option value="Título de Eleitor">Título de Eleitor</option>
                    <option value="Carteira de Trabalho">Carteira de Trabalho</option>
                    <option value="Frequência">Frequência</option>
                    <option value="Outros Documentos">Outros Documentos</option>
                </select>
            </div>
            <div class="form-group col-sm-6">
                <label for="exampleFormControlFile1">Arquivo</label>
                <input type="file" multiple class="form-control-file" name="inputFile[]" id="inputFile" accept=".pdf" required>
            </div>
        </div>
        <button type="submit"  class="btn btn-dark m-t-20">Incluir arquivo</button><br/>
    </form>

    <div id="divProgresso">
        <h6>Progresso do envio</h6>
        <div id="barraProgresso" class="progress">
            <div class="bar"></div>
            <div class="percent">0%</div>
        </div>
    </div>

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


    @if(isset($semDocumentos))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {!! $semDocumentos !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(isset($aviso))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {!! $aviso !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="modal fade bd-example-modal-lg" id="modalIframe" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <iframe src="{{ route('servidor.documentosView',111) }}" id="iframeTest" data-parm="" width="100%"
                        height="100%" style="height: 40em" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="closebtn" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>

    @if(isset($documentos))

        <div class="mt-2" id="allDocs">
            <div class="cf espacamentoDocs">
                <h2>RG</h2>
                @php
                    $control = 0;
                @endphp
                @foreach($documentos as $doc)
                    @if($doc['titulo'] == "RG")
                        @php
                            $control = 1;
                        @endphp
                        <div class="card float-left mr-2 width25em height8em mt-2">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-file-pdf"></i> {{ $doc['arquivo'] }}</h5>
                                <div>
                                    <i class="">{{$doc['data']}}</i>
                                    <a href="{{ route('servidor.documentosDelete', $doc['id']) }}" onclick="return confirm('Deseja apagar o documento?');" title="apagar arquivo" class="btn btn-danger ml-1 btn-sm float-right"><i class="fas fa-trash"></i></a>
                                    <a href="#" id="{{ $doc['id'] }}" title="visualizar arquivo"
                                       class="btn btn-secondary btn-sm float-right docModal"><i
                                                class="fas fa-file-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($control == 0)
                    Nenhum documento anexado.
                @endif
            </div>
            <hr/>
            <div class="cf espacamentoDocs">
                <h2>CPF</h2>
                @php
                    $control = 0;
                @endphp
                @foreach($documentos as $doc)
                    @if($doc['titulo'] == "CPF")
                        @php
                            $control = 1;
                        @endphp
                        <div class="card float-left mr-2 width25em height8em mt-2">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-file-pdf"></i> {{ $doc['arquivo'] }}</h5>
                                <div>
                                    <i class="">{{$doc['data']}}</i>
                                    <a href="{{ route('servidor.documentosDelete', $doc['id']) }}" onclick="return confirm('Deseja apagar o documento?');" title="apagar arquivo" class="btn btn-danger ml-1 btn-sm float-right"><i class="fas fa-trash"></i></a>
                                    <a href="#" id="{{ $doc['id'] }}" title="visualizar arquivo"
                                       class="btn btn-secondary btn-sm float-right docModal"><i
                                                class="fas fa-file-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($control == 0)
                    Nenhum documento anexado.
                @endif
            </div>
            <hr/>
            @if(PermissaoController::temPermissaoSetorPessoal())
                <div class="cf espacamentoDocs">
                    <h2>Comprovante de Residência</h2>
                    @php
                        $control = 0;
                    @endphp
                    @foreach($documentos as $doc)
                        @if($doc['titulo'] == "Comprovante de Residência")
                            @php
                                $control = 1;
                            @endphp
                            <div class="card float-left mr-2 width25em height8em mt-2">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-file-pdf"></i> {{ $doc['arquivo'] }}</h5>
                                    <div>
                                        <i class="">{{$doc['data']}}</i>
                                        <a href="{{ route('servidor.documentosDelete', $doc['id']) }}" onclick="return confirm('Deseja apagar o documento?');" title="apagar arquivo" class="btn btn-danger ml-1 btn-sm float-right"><i class="fas fa-trash"></i></a>

                                        <a href="#" id="{{ $doc['id'] }}" title="visualizar arquivo"
                                           class="btn btn-secondary btn-sm float-right docModal"><i
                                                    class="fas fa-file-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if($control == 0)
                        Nenhum documento anexado.
                    @endif
                </div>
                <hr/>
            @endif
            <div class="cf espacamentoDocs">
                <h2>Diploma</h2>
                @php
                    $control = 0;
                @endphp
                @foreach($documentos as $doc)
                    @if($doc['titulo'] == "Diploma")
                        @php
                            $control = 1;
                        @endphp
                        <div class="card float-left mr-2 width25em height8em mt-2">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-file-pdf"></i> {{ $doc['arquivo'] }}</h5>
                                <div>
                                    <i class="">{{$doc['data']}}</i>
                                    <a href="{{ route('servidor.documentosDelete', $doc['id']) }}" onclick="return confirm('Deseja apagar o documento?');" title="apagar arquivo" class="btn btn-danger ml-1 btn-sm float-right"><i class="fas fa-trash"></i></a>
                                    <a href="#" id="{{ $doc['id'] }}" title="visualizar arquivo"
                                       class="btn btn-secondary btn-sm float-right docModal"><i
                                                class="fas fa-file-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($control == 0)
                    Nenhum documento anexado.
                @endif
            </div>
            <hr/>
            <div class="cf espacamentoDocs">
                <h2>Certificado de Alistamento/Reservista Militar</h2>
                @php
                    $control = 0;
                @endphp
                @foreach($documentos as $doc)
                    @if($doc['titulo'] == "Certificado de Alistamento/Reservista Militar")
                        @php
                            $control = 1;
                        @endphp
                        <div class="card float-left mr-2 width25em height8em mt-2">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-file-pdf"></i> {{ $doc['arquivo'] }}</h5>
                                <div>
                                    <i class="">{{$doc['data']}}</i>
                                    <a href="{{ route('servidor.documentosDelete', $doc['id']) }}" onclick="return confirm('Deseja apagar o documento?');" title="apagar arquivo" class="btn btn-danger ml-1 btn-sm float-right"><i class="fas fa-trash"></i></a>
                                    <a href="#" id="{{ $doc['id'] }}" title="visualizar arquivo"
                                       class="btn btn-secondary btn-sm float-right docModal"><i
                                                class="fas fa-file-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($control == 0)
                    Nenhum documento anexado.
                @endif
            </div>
            <hr/>
            <div class="cf espacamentoDocs">
                <h2>Título de Eleitor</h2>
                @php
                    $control = 0;
                @endphp
                @foreach($documentos as $doc)
                    @if($doc['titulo'] == "Título de Eleitor")
                        @php
                            $control = 1;
                        @endphp
                        <div class="card float-left mr-2 width25em height8em mt-2">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-file-pdf"></i> {{ $doc['arquivo'] }}</h5>
                                <div>
                                    <i class="">{{$doc['data']}}</i>
                                    <a href="{{ route('servidor.documentosDelete', $doc['id']) }}" onclick="return confirm('Deseja apagar o documento?');" title="apagar arquivo" class="btn btn-danger ml-1 btn-sm float-right"><i class="fas fa-trash"></i></a>
                                    <a href="#" id="{{ $doc['id'] }}" title="visualizar arquivo"
                                       class="btn btn-secondary btn-sm float-right docModal"><i
                                                class="fas fa-file-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($control == 0)
                    Nenhum documento anexado.
                @endif
            </div>
            <hr/>
            <div class="cf espacamentoDocs">
                <h2>Carteira de Trabalho</h2>
                @php
                    $control = 0;
                @endphp
                @foreach($documentos as $doc)
                    @if($doc['titulo'] == "Carteira de Trabalho")
                        @php
                            $control = 1;
                        @endphp
                        <div class="card float-left mr-2 width25em height8em mt-2">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-file-pdf"></i> {{ $doc['arquivo'] }}</h5>
                                <div>
                                    <i class="">{{$doc['data']}}</i>
                                    <a href="{{ route('servidor.documentosDelete', $doc['id']) }}" onclick="return confirm('Deseja apagar o documento?');" title="apagar arquivo" class="btn btn-danger ml-1 btn-sm float-right"><i class="fas fa-trash"></i></a>
                                    <a href="#" id="{{ $doc['id'] }}" title="visualizar arquivo"
                                       class="btn btn-secondary btn-sm float-right docModal"><i
                                                class="fas fa-file-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($control == 0)
                    Nenhum documento anexado.
                @endif
            </div>
            <hr/>
            <div class="cf espacamentoDocs">
                <h2>Frequência</h2>
                @php
                $control = 0;
                @endphp
                @foreach($documentos as $doc)
                    @if($doc['titulo'] == "Frequência")
                        @php
                        $control = 1;
                        @endphp
                        <div class="card float-left mr-2 width25em height8em mt-2">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-file-pdf"></i> {{ $doc['arquivo'] }}</h5>
                                <div>
                                    <i class="">{{$doc['data']}}</i>
                                    <a href="{{ route('servidor.documentosDelete', $doc['id']) }}" onclick="return confirm('Deseja apagar o documento?');" title="apagar arquivo" class="btn btn-danger ml-1 btn-sm float-right"><i class="fas fa-trash"></i></a>
                                    <a href="#" id="{{ $doc['id'] }}" title="visualizar arquivo"
                                       class="btn btn-secondary btn-sm float-right docModal"><i
                                                class="fas fa-file-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($control == 0)
                    Nenhum documento anexado.
                @endif
            </div>
            <hr/>
            <div class="cf espacamentoDocs">
                <h2>Outros Documentos</h2>
                @php
                    $control = 0;
                @endphp
                @foreach($documentos as $doc)
                    @if($doc['titulo'] == "Outros Documentos")
                        @php
                            $control = 1;
                        @endphp
                        <div class="card float-left mr-2 width25em height8em mt-2">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-file-pdf"></i> {{ $doc['arquivo'] }}</h5>
                                <div>
                                    <i class="">{{$doc['data']}}</i>
                                    <a href="{{ route('servidor.documentosDelete', $doc['id']) }}" onclick="return confirm('Deseja apagar o documento?');" title="Apagar Arquivo" class="btn btn-danger ml-1 btn-sm float-right"><i class="fas fa-trash"></i></a>
                                    <a href="#" id="{{ $doc['id'] }}" title="Visualizar Arquivo"
                                       class="btn btn-secondary btn-sm float-right docModal"><i
                                                class="fas fa-file-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($control == 0)
                    Nenhum documento anexado.
                @endif
            </div>
        </div>

    @endif

@endsection
@push('script')
<script src="{{ asset('js/servidor_documentos.js') }}"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
@endpush
@push('css')
<link href="{{ asset('css/servidor_documentos.css') }}" rel="stylesheet">
@endpush