@extends('theme.theme')

@section('content')

    @include('template._links_menu_servidor')

    <h1 class="tituloSeccao">

        @if($foto != false)
            <img src="{{url($foto)}}" height="100" alt="">
        @else
            <i class="fas fa-user-circle"></i>
        @endif

        {{json_decode($dadosView)->nome}}

        <!-- Botão que chama o Modal Abaixo -->
        <a class="btn btn-primary float-right botaoRelatorio btn-sm mTop-3em" data-toggle="modal" data-target="#escolherFiltros"
           role="button" id="gerarRelatorio">
            <i id="iconGerarRelatorio" class="far fa-file-alt iconeRelatorio"></i> Gerar Relatório
        </a>

        <h6 class="blockquote-footer w-50 "> {{ json_decode($dadosView)->situacao }} </h6>

        <!-- Modal -->
        <div class="modal fade" id="escolherFiltros" tabindex="-1" role="dialog" aria-labelledby="escolherFiltrosTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="escolherFiltrosLongTitle">Escolher Filtros do Relatório</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('historico_print', json_decode($dadosView)->id)}}" method="POST">
                        {!! csrf_field() !!}
                        <div class="modal-body">
                            <div class="form-check-inline">
                                <ul>
                                    @foreach(json_decode($historicoFiltros) as $h)
                                        <li class="d-block">
                                            <input class="form-check-input" name="listaSelecionada[]" type="checkbox"
                                                   value={{$h->id}} id="defaultCheck{{$h->id}}">
                                            <label class="form-check-label fontSize1em"
                                                   for="listaSelecionada">{{$h->nome}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </h1>

    <hr/>

    <button type="button" id="addEventoHistorico" class="btn btn-primary btn-lg mt-4 mb-3 btn-block"><i
                class="fas fa-plus-circle"></i> <span id="textAddEventoHistorico">Inserir evento no histórico</span>
    </button>

    <form class="formAddArquivo" id="formAddArquivo"
          action="{{ route('servidor.historicoStore',json_decode($dadosView)->id) }}" method="post"
          enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="0" selected>Selecione uma categoria</option>
                    @foreach(json_decode($historicoFiltros) as $h)
                        <option value="{{$h->id}}">{{ $h->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-6">
                <div class="form-group col-sm-4 float-left">
                    <label for="data_inicio">Data do Evento</label>
                    <input type="text" class="form-control" name="data_inicio" id="data_inicio" placeholder="">
                </div>
                <div id="divData" class="form-group col-sm-4 float-left">
                    <label for="data_final">Data do Fim do Evento</label>
                    <input type="text" class="form-control" name="data_final" id="data_final" placeholder="">
                </div>
            </div>
            <div id="divConcessao" class="form-group col-sm-6">
                <div class="form-group float-left">
                    <label>Tipo de Concessão</label>
                    <select name="tipo_concessao" id="tipo_concessao" class="form-control">
                        <option value="">Selecione o tipo de concessão</option>
                        <option value="Doação de Sangue">Doação de Sangue</option>
                        <option value="Alistar-se como eleitor">Alistar-se como eleitor</option>
                        <option value="Casamento">Casamento</option>
                        <option value="Falecimento de familiar">Falecimento de familiar</option>
                    </select>
                </div>
            </div>
            <div id="divAfastamento" class="form-group col-sm-6">
                <div class="form-group float-left">
                    <label>Tipo de Afastamento</label>
                    <select name="tipo_afastamento" id="tipo_afastamento" class="form-control">
                        <option value="">Selecione o tipo de afastamento</option>
                        @foreach($afastamentos as $afastamento=>$a)
                            <option value="{{ $a }}">{{ $a }}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div id="divTitulo" class="form-group col-sm-6">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="título">
            </div>
            <div class="cf"></div>

            <div id="divMesAno" class="form-group col-sm-6">
                <div class="form-group float-left mr-3">
                    <label for="mes">Mês</label>
                    <select name="mes" id="mes" class="form-control">
                        <option value="" selected>Selecione um mês</option>
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
                <div class="form-group float-left">
                    <label for="ano">Ano</label>
                    <select name="ano" id="ano" class="form-control">
                        <option value="" selected>Selecione o ano</option>
                        @foreach($anos as $ano)
                            <option value="{{ $ano }}">{{  $ano }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="cf"></div>

            <div id="divTipoLicenca">
                <div class="form-group float-left">
                    <label for="tipoLicenca">Tipo da Licença</label>
                    <select name="tipoLicenca" id="tipoLicenca" class="form-control">
                        <option value="" selected>Selecione a licença</option>
                        @foreach($licencas as $licenca=>$l)
                            <option value="{{ $l }}">{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="cf"></div>

            <div id="divTipoPenalidade">
                <div class="form-group float-left">
                    <label for="tipoPenalidade">Tipo da Penalidade</label>
                    <select name="tipoPenalidade" id="tipoPenalidade" class="form-control">
                        <option value="" selected>Selecione a Penalidade</option>
                        @foreach($penalidades as $penalidade=>$p)
                            <option value="{{ $p }}">{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="cf"></div>
            <div id="divLotacao">
                <div class="form-group float-left">
                    <label for="lotacao">Lotação</label>
                    <select id="lotacao" name="lotacao" class="form-control">
                        <option value="0" selected>Selecione</option>
                        @foreach(json_decode($lotacao) as $l)
                            <option value="{{ $l->id }}">{{ $l->sigla }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="cf"></div>
            <div class="form-group col-sm-12">
                <label for="descricao">Descrição</label>
                <textarea required name="descricao" id="descricao" class="form-control"
                          aria-multiline="true"></textarea>
            </div>
            <div class="form-group col-sm-3">
                <label for="exampleFormControlFile1">Arquivos</label>
                <input type="file" class="form-control-file" name="inputFile[]" multiple="multiple" id="inputFile"
                       accept=".pdf" required>
            </div>

        </div>
        <button type="submit" class="btn btn-dark m-t-20">Cadastrar Evento</button>
    </form>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg) !!} <a href="#" class="close"
                                                                                           data-dismiss="alert"
                                                                                           aria-label="close">&times;</a>
                </p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->

    <form action="{{route('servidor.historico',json_decode($dadosView)->id)}}" id="formFiltro" method="post">
        {{csrf_field()}}
        <select name="selectFiltros" id="selectFiltros" class="custom-select mb-3">
            <option value="" selected>Selecione um filtro</option>
            <option value="0">Exibir todos os filtros</option>
            @foreach(json_decode($historicoFiltros) as $h)
                <option value="{{$h->id}}">{{ $h->nome }}</option>
            @endforeach
        </select>
    </form>

    <hr/>

    <div class="modal fade bd-example-modal-lg" id="modalIframe" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <iframe src="{{ route('servidor.historicoView',111) }}" id="iframeTest" data-parm="" width="100%"
                        height="100%" style="height: 40em" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="closebtn" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>

    @foreach(($dadosHistorico) as $dh)
        <div class="accordion">
            <div class="card mb-2" id="card">
                <div class="card-header" id="heading{{$loop->iteration}}" data-toggle="collapse"
                     data-target="#collapse{{$loop->iteration}}" aria-expanded="false"
                     aria-controls="collapse{{$loop->iteration}}">
                    <h5 class="mb-0" id="h5Button">
                        <div class="align-middle tituloHistorico" id="textHeadingOne">
                            <!-- titulo do evento -->
                            @if($dh['status'] == "R")
                                <div class="eventoRevogado">Data do Evento: {{$dh['data']}} {{$dh['tipo']}}</div>
                            @else
                                Data do Evento: {{$dh['data']}} {{$dh['tipo']}}
                            @endif
                        </div>
                        <a class="btn float-right" href="#" role="button" id="buttonHeadingOne"><i
                                    id="iButtonHeadingOne" class="fas fa-plus iconeTop"></i></a>
                    </h5>
                </div>
                <div id="collapse{{$loop->iteration}}" class="collapse" aria-labelledby="heading{{$loop->iteration}}"
                     data-parent="#accordionExample">
                    <div class="card-body">
                        {{$dh['descricao']}}
                    </div>
                    @foreach($dadosArquivo as $da)
                        @if($da['id_historico'] == $dh['id'])
                            <a href="#" id="{{$da['id']}}/{{ json_decode($dadosView)->id }}"
                               class="btn btn-primary ml-2 docModal"><i class="fas fa-file-alt"></i> </a>
                        @endif
                    @endforeach

                    @if($dh['id_tipo'] == 9)
                        <a class="btn btn-danger float-right mr-2"
                           onclick="return confirm('Deseja mesmo revogar este evento?');"
                           href="{{ route('servidor.historicoRevogar',['id' => $dh['id'],'id_servidor' => json_decode($dadosView)->id]) }}">Revogar</a>
                    @else
                        <a class="btn btn-warning float-right mr-2"
                           href="{{ route('servidor.historicoEdit',$dh['id']) }}">Alterar</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

@endsection
@push('css')
<link href="{{ asset('css/servidor_historico.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('script')
<script src="{{ asset('js/historico.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush