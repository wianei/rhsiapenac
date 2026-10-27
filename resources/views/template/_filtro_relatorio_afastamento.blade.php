<div class="m-b-20">
    <form action="{{ route('relatorio.afastamento.pesquisar',$id) }}" method="post">
        {!! csrf_field() !!}
        <h4><i class="fa fa-filter"></i> FILTROS <i class="fa fa-sort-down m-l-15" id="filtroIcon"></i></h4>

        <div id="divformFiltro">
            <div class="form-row">
                {{--<div class="form-group col-sm-3">--}}
                    {{--<label for="matricula">Matrícula</label>--}}
                    {{--<input type="text" name="matricula" id="matricula" class="form-control">--}}
                    {{--<button type="button" class="btn btn-secondary pesquisaServidorRelatorio" title="Pesquisar servidor" data-toggle="modal" data-target=".bd-example-modal-lg">--}}
                        {{--<i class="fa fa-search"></i>--}}
                    {{--</button>--}}
                {{--</div>--}}

                <div class="form-group col-sm-6">
                        <label>Tipo de Afastamento</label>
                        <select name="tipo_afastamento" id="tipo_afastamento" class="form-control">
                            <option value="">Selecione o tipo de afastamento</option>
                            @foreach($afastamentos as $afastamento=>$a)
                                <option value="{{ $a }}">{{ $a }}</option>
                            @endforeach
                        </select>
                    </div>

                <div class="form-group col-sm-3">
                    <label for="lotacao">Lotação</label>
                    <select id="lotacao" name="lotacao" class="form-control">
                        <option value="0" selected>Selecione</option>
                        @foreach(json_decode($lotacao) as $l)
                            <option value="{{ $l->id }}">{{ $l->sigla }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-3 float-left">
                    <label for="data_inicio">Data inicial</label>
                    <input type="text" autocomplete="off" class="form-control" name="data_inicio" id="data_inicio" placeholder="">
                </div>
                <div class="form-group col-sm-3 float-left">
                    <label for="data_final">Data final</label>
                    <input type="text" autocomplete="off" class="form-control" name="data_final" id="data_final" placeholder="">
                </div>
            </div>
            <div class="cf"></div>
            <button type="submit" id="btnPesquisar" class="btn btn-dark m-t-20 buscaAjax">PESQUISAR</button>
        </div>
    </form>
</div>