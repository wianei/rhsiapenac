@extends('theme.theme')

@section('content')

    <h2>Alteração de evento do histórico</h2>
    <hr>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->
    <form class="formAddArquivo" id="formAddArquivo" action="{{ route('servidor.historicoUpdate',json_decode($dadosView)->id) }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-sm-12" id="divTipo">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="0" selected>Selecione uma categoria</option>
                    @foreach(json_decode($historicoFiltros) as $h)
                        <option value="{{$h->id}}" @if( isset( $historicoFiltros ) && $h->id == json_decode($dadosView)->tipo ) selected @endif>{{ $h->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div id="divTitulo" class="form-group col-sm-6">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" value="{{ json_decode($dadosView)->titulo }}" name="titulo" id="titulo" placeholder="título">
            </div>

            <div class="cf"></div>
            <div class="form-group col-sm-6">
                <div class="form-group col-sm-4 float-left">
                    <label for="data_inicio">Data inicial</label>
                    <input type="text" class="form-control" name="data_inicio" id="data_inicio"
                           value="{{ json_decode($dadosView)->data_inicio }}">
                </div>
                <div id="divData" class="form-group col-sm-4 float-left">
                    <label for="data_final">Data final</label>
                    <input type="text" class="form-control" name="data_final" id="data_final"
                           value="{{ json_decode($dadosView)->data_final }}">
                </div>
            </div>
            <div class="cf"></div>
            <div id="divTipoLicenca">
                <div class="form-group float-left">
                    <label for="tipoLicenca">Tipo da Licença</label>
                    <select name="tipoLicenca" id="tipoLicenca" class="form-control">
                        <option value="" selected>Selecione a licença</option>
                        @foreach($licencas as $licenca=>$l)
                            <option value="{{ $l }}"
                                    @if( $l == json_decode($dadosView)->titulo ) selected @endif>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="cf"></div>
            <div id="divConcessao" class="form-group col-sm-6">
                <div class="form-group float-left">
                    <label>Tipo de Concessão</label>
                    <select name="tipo_concessao" id="tipo_concessao" class="form-control">
                        <option value="">Selecione o tipo de concessão</option>
                        <option value="Doação de Sangue"
                                @if( json_decode($dadosView)->titulo == "Doação de Sangue" ) selected @endif>Doação de
                            Sangue
                        </option>
                        <option value="Alistar-se como eleitor"
                                @if( json_decode($dadosView)->titulo == "Alistar-se como eleitor" ) selected @endif>
                            Alistar-se como eleitor
                        </option>
                        <option value="Casamento" @if( json_decode($dadosView)->titulo == "Casamento" ) selected @endif>
                            Casamento
                        </option>
                        <option value="Falecimento de familiar"
                                @if( json_decode($dadosView)->titulo == "Falecimento de familiar" ) selected @endif>
                            Falecimento de familiar
                        </option>
                    </select>
                </div>
            </div>
            <div class="cf"></div>
            <div id="divAfastamento" class="form-group col-sm-6">
                <div class="form-group float-left">
                    <label>Tipo de Afastamento</label>
                    <select name="tipo_afastamento" id="tipo_afastamento" class="form-control">
                        <option value="">Selecione o tipo de afastamento</option>
                        @foreach($afastamentos as $afastamento=>$a)
                            <option value="{{ $a }}"
                                    @if( $a == json_decode($dadosView)->titulo ) selected @endif>{{ $a }}</option>
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
                            <option value="{{ $p }}"
                                    @if( $p == json_decode($dadosView)->titulo ) selected @endif>{{ $p }}</option>
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
                            <option value="{{ $l->id }}"
                                    @if( $l->id == json_decode($dadosView)->titulo ) selected @endif>{{ $l->sigla }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="cf"></div>

            <div class="form-group col-sm-12">
                <label for="descricao">Descrição</label>
                <textarea required name="descricao" id="descricao" class="form-control"
                          aria-multiline="true">{{ json_decode($dadosView)->descricao }}</textarea>
            </div>
            <div class="col-sm-6">
                <h6>Arquivos cadastrados</h6>
                @if(count(json_decode($arquivos)) == 1)
                <div class="alert alert-danger" role="alert">
                    O evento possui um único arquivo cadastrado, ao deletar o arquivo o evento será apagado.<br>
                    Para mudar o arquivo já cadastrado, envie um novo e em seguida apague o antigo.
                </div>
                @endif
                <ul class="list-group col-sm-12">
                    @foreach(json_decode($arquivos) as $doc)
                        <li class="list-group-item">

                            <a href="{{ route('servidor.historicoView',['id'=>$doc->id, 'id_servidor'=>json_decode($dadosView)->id_servidor]) }}" onclick="return confirm('Deseja apagar o arquivo?');" class="btn btn-primary ml-2"><i class="fas fa-file-alt"></i> {{$doc->arquivo}}</a>

                            <a class="btn btn-danger mr-2 float-right" title="Apagar arquivo" href="{{ route('servidor.historicoDeleteFile', ['id'=>$doc->id, 'id_historico'=>$doc->id_historico, 'id_servidor'=>json_decode($dadosView)->id_servidor]) }}"><i class="fas fa-trash"></i></a>
                        </li>

                    @endforeach

                </ul>
            </div>
            <div class="cf"></div>
            <div class="form-group col-sm-6">
                <label for="exampleFormControlFile1">Arquivos</label>
                <input type="file" class="form-control-file" name="inputFile[]" multiple="multiple" id="inputFile"
                       accept=".pdf">
            </div>

        </div>
        <br>
        <button type="submit"  class="btn btn-dark m-t-20">Salvar alterações</button>
    </form>

    <hr/>

@endsection
@push('css')
<link href="{{ asset('css/servidor_historico_alterar.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('script')
<script src="{{ asset('js/historico_alterar.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush