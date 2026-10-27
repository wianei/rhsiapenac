<div class="m-b-20">
    <form action="{{ route('relatorio.servidor.pesquisar',0) }}" method="post">
        {!! csrf_field() !!}
        <h4><i class="fa fa-filter"></i> FILTROS <i class="fa fa-sort-down m-l-15" id="filtroIcon"></i></h4>

        <div id="divformFiltro">
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="lotacao">Lotação</label>
                    <select id="lotacao" name="lotacao" class="form-control">
                        <option value="0" selected>Selecione</option>
                        @foreach(json_decode($lotacao) as $l)
                            <option value="{{ $l->id }}">{{ $l->sigla }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" id="btnPesquisar" class="btn btn-dark m-t-20 buscaAjax">PESQUISAR</button>
            </div>
    </form>
</div>