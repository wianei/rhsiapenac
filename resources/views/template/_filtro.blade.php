<div class="m-b-20" xmlns="http://www.w3.org/1999/html">
    <form action="{{ route('servidor.pesquisa') }}" method="GET">
        {!! csrf_field() !!}
        <h4 class="float-left"><i class="fa fa-filter"></i> FILTROS <i class="fa fa-sort-down m-l-15" id="filtroIcon"></i></h4>
        <button type="button" class="btn btn-info float-left ml-5" id="pesAvancada"><i class="	fa fa-search"></i> Pesquisa Avançada</button>
        <div class="cf"></div>
        <div id="divformFiltro">
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome">
                </div>
                <div class="form-group col-sm-3">
                    <label for="matricula">Matrícula</label>
                    <input type="text" class="form-control" name="matricula" id="matricula" placeholder="Matrícula">
                </div>
                <div class="form-group col-sm-3">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF">
                </div>
                <div class="form-group col-sm-3">
                    <label for="lotacao">Lotação</label>
                    <select id="lotacao" name="lotacao" class="form-control">
                        <option value="" selected>Selecione</option>
                        <optgroup label="DER-GA">
                                @foreach(json_decode($lotacaoDB) as $l)
                                    @if($l->coordenadoria == 2)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="DER-LI">
                                @foreach(json_decode($lotacaoDB) as $l)
                                    @if($l->coordenadoria == 3)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="DER-RS">
                                @foreach(json_decode($lotacaoDB) as $l)
                                    @if($l->coordenadoria == 4)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="DER-SEP">
                                @foreach(json_decode($lotacaoDB) as $l)
                                    @if($l->coordenadoria == 5)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="Gabinete">
                                @foreach(json_decode($lotacaoDB) as $l)
                                    @if($l->coordenadoria == 1)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                    </select>
                </div>

                <div id="divPesAvancada">
                    <div class="form-group col-sm-4">
                        <label for="cargo">Cargo Efetivo</label>
                        <select id="cargo" name="cargo" class="form-control">
                            <option value="">Selecione</option>
                            @foreach(json_decode($cargos) as $cargo)
                                <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-8">
                        <label for="funcao">Função ou Cargo em Comissão</label>
                        <select id="funcao" name="funcao" class="form-control">
                            <option value="">Selecione</option>
                            @foreach(json_decode($funcoes) as $funcao)
                                <option value="{{ $funcao->id }}">{{ $funcao->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class=
                    "form-group col-sm-3">
                        <label for="nivel">Nível</label>
                        <select id="nivel" name="nivel" class="form-control">
                        <option value="">Selecione o nível</option>
                        <option value="A1">A-1</option>
                        <option value="A2">A-2</option>
                        <option value="A3">A-3</option>
                        <option value="A4">A-4</option>
                        <option value="A5">A-5</option>
                        <option value="A6">A-6</option>
                        <option value="A7">A-7</option>
                        <option value="B1">B-1</option>
                        <option value="B2">B-2</option>
                        <option value="B3">B-3</option>
                        <option value="B4">B-4</option>
                        <option value="B5">B-5</option>
                        <option value="B6">B-6</option>
                        <option value="B7">B-7</option>
                        <option value="C1">C-1</option>
                        <option value="C2">C-2</option>
                        <option value="C3">C-3</option>
                        <option value="C4">C-4</option>
                        <option value="C5">C-5</option>
                        <option value="C6">C-6</option>
                        <option value="C7">C-7</option>
                        <option value="D1">D-1</option>
                        <option value="D2">D-2</option>
                        <option value="D3">D-3</option>
                        <option value="D4">D-4</option>
                        <option value="D5">D-5</option>
                        <option value="D6">D-6</option>
                        <option value="D7">D-7</option>
                        <option value="E1">E-1</option>
                        <option value="E2">E-2</option>
                        <option value="E3">E-3</option>
                        <option value="E4">E-4</option>
                        <option value="E5">E-5</option>
                        <option value="E6">E-6</option>
                        <option value="E7">E-7</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="grau_instucao">Grau de Instrução</label>
                        <select name="grau_instucao" id="grau_instucao" class="form-control">
                            <option value="">Selecione o grau</option>
                            <option value="Fundamental">Fundamental</option>
                            <option value="Médio">Médio</option>
                            <option value="Médio Incompleto">Médio Incompleto</option>
                            <option value="Superior">Superior</option>
                            <option value="Superior Incompleto">Superior Incompleto</option>
                            <option value="Pós Graduação">Pós Graduação</option>
                            <option value="Mestrado">Mestrado</option>
                            <option value="Doutorado">Doutorado</option>
                            <option value="Pós-Doutorado">Pós-Doutorado</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3 float-left">
                        <label for="sexo">Sexo</label>
                        <select id="sexo" name="sexo" class="form-control">
                            <option value="" selected>Selecione...</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>

                    <div id="grupoCursos" class="form-group col-sm-3">
                        <label for="cursos">Curso</label><br>
                        <select name="cursos[]" id="cursos" class="form-control" multiple>
                            <option value="">Selecione o curso</option>
                            @foreach($cursosDB as $curso=>$c)
                                <option value="{{$c}}">{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

            </div>
            <input type="hidden" name="skip" id="skip" value="">
            <input type="hidden" name="pagina" id="pagina" value="">
            <button type="submit" id="btnPesquisar" class="btn btn-dark m-t-20 buscaAjax">BUSCAR</button>
        </div>
    </form>

</div>