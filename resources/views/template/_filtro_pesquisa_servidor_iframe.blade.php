<div class="m-b-20">
    <form  action="{{ route('servidor.pesquisaIframeResultado') }}" method="post">
        {!! csrf_field() !!}
        <h4><i class="fa fa-filter"></i> FILTROS <i class="fa fa-sort-down m-l-15" id="filtroIcon"></i></h4>
        <div id="divformFiltro">
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome">
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
                <div class="form-group col-sm-3">
                    <label for="sexo">Sexo</label>
                    <select id="sexo" name="sexo" class="form-control">
                        <option value="" selected>Selecione...</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                </div>
            </div>
            <button type="submit" id="btnPesquisar" class="btn btn-dark m-t-20 buscaAjax">PESQUISAR</button>
        </div>
    </form>
</div>