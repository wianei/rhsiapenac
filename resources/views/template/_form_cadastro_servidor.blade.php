<?php
use App\Http\Controllers\PermissaoController;
?>
@if(isset($servidor))
    <form method="post" action="{{ route('servidor_cadastro.update') }}" enctype="multipart/form-data">
        <input type="hidden" name="idServidor" id="idServidor" value="{{$servidor->id}}">
        @else
            <form method="post" action="{{ route('servidor_cadastro.store') }}" enctype="multipart/form-data">
                @endif
                {!! csrf_field() !!}
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" value="{{ $servidor->nome or old('nome') }}" class="form-control"
                               id="nome"
                               placeholder="Nome" required>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="matricula">Matrícula</label>
                        <input type="text" class="form-control" name="matricula" id="matricula"
                               value="{{ $servidor->matricula or old('matricula') }}" placeholder="Matrícula" required>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="sexo">Sexo</label>
                        <select id="sexo" name="sexo" class="form-control">
                            <option value="0" @if( isset( $servidor ) && $servidor->sexo == "0" ) selected @endif>
                                Selecione
                            </option>
                            <option value="Masculino"
                                    @if( isset( $servidor ) && $servidor->sexo == "Masculino" ) selected @endif>
                                Masculino
                            </option>
                            <option value="Feminino"
                                    @if( isset( $servidor ) && $servidor->sexo == "Feminino" ) selected @endif>
                                Feminino
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="data_nascimento">Data de nascimento</label>
                        <input type="text" class="form-control" name="data_nascimento" id="data_nascimento"
                               value="{{ $servidor->data_nascimento or old('data_nascimento') }}"
                               placeholder="Data de Nascimento"
                               >
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="nivel">Nível</label>
                        <select id="nivel" name="nivel" class="form-control">
                            <option value="" selected>Selecione o nível</option>
                            <option value="A1" @if( isset( $servidor ) && $servidor->nivel == "1A" ) selected @endif>A-1</option>
                            <option value="A2" @if( isset( $servidor ) && $servidor->nivel == "A2" ) selected @endif>A-2</option>
                            <option value="A3" @if( isset( $servidor ) && $servidor->nivel == "A3" ) selected @endif>A-3</option>
                            <option value="A4" @if( isset( $servidor ) && $servidor->nivel == "A4" ) selected @endif>A-4</option>
                            <option value="A5" @if( isset( $servidor ) && $servidor->nivel == "A5" ) selected @endif>A-5</option>
                            <option value="A6" @if( isset( $servidor ) && $servidor->nivel == "A6" ) selected @endif>A-6</option>
                            <option value="A7" @if( isset( $servidor ) && $servidor->nivel == "A7" ) selected @endif>A-7</option>
                            <option value="B1" @if( isset( $servidor ) && $servidor->nivel == "B1" ) selected @endif>B-1</option>
                            <option value="B2" @if( isset( $servidor ) && $servidor->nivel == "B2" ) selected @endif>B-2</option>
                            <option value="B3" @if( isset( $servidor ) && $servidor->nivel == "B3" ) selected @endif>B-3</option>
                            <option value="B4" @if( isset( $servidor ) && $servidor->nivel == "B4" ) selected @endif>B-4</option>
                            <option value="B5" @if( isset( $servidor ) && $servidor->nivel == "B5" ) selected @endif>B-5</option>
                            <option value="B6" @if( isset( $servidor ) && $servidor->nivel == "B6" ) selected @endif>B-6</option>
                            <option value="B7" @if( isset( $servidor ) && $servidor->nivel == "B7" ) selected @endif>B-7</option>
                            <option value="C1" @if( isset( $servidor ) && $servidor->nivel == "C1" ) selected @endif>C-1</option>
                            <option value="C2" @if( isset( $servidor ) && $servidor->nivel == "C2" ) selected @endif>C-2</option>
                            <option value="C3" @if( isset( $servidor ) && $servidor->nivel == "C3" ) selected @endif>C-3</option>
                            <option value="C4" @if( isset( $servidor ) && $servidor->nivel == "C4" ) selected @endif>C-4</option>
                            <option value="C5" @if( isset( $servidor ) && $servidor->nivel == "C5" ) selected @endif>C-5</option>
                            <option value="C6" @if( isset( $servidor ) && $servidor->nivel == "C6" ) selected @endif>C-6</option>
                            <option value="C7" @if( isset( $servidor ) && $servidor->nivel == "C7" ) selected @endif>C-7</option>
                            <option value="D1" @if( isset( $servidor ) && $servidor->nivel == "D1" ) selected @endif>D-1</option>
                            <option value="D2" @if( isset( $servidor ) && $servidor->nivel == "D2" ) selected @endif>D-2</option>
                            <option value="D3" @if( isset( $servidor ) && $servidor->nivel == "D3" ) selected @endif>D-3</option>
                            <option value="D4" @if( isset( $servidor ) && $servidor->nivel == "D4" ) selected @endif>D-4</option>
                            <option value="D5" @if( isset( $servidor ) && $servidor->nivel == "D5" ) selected @endif>D-5</option>
                            <option value="D6" @if( isset( $servidor ) && $servidor->nivel == "D6" ) selected @endif>D-6</option>
                            <option value="D7" @if( isset( $servidor ) && $servidor->nivel == "D7" ) selected @endif>D-7</option>
                            <option value="E1" @if( isset( $servidor ) && $servidor->nivel == "E1" ) selected @endif>E-1</option>
                            <option value="E2" @if( isset( $servidor ) && $servidor->nivel == "E2" ) selected @endif>E-2</option>
                            <option value="E3" @if( isset( $servidor ) && $servidor->nivel == "E3" ) selected @endif>E-3</option>
                            <option value="E4" @if( isset( $servidor ) && $servidor->nivel == "E4" ) selected @endif>E-4</option>
                            <option value="E5" @if( isset( $servidor ) && $servidor->nivel == "E5" ) selected @endif>E-5</option>
                            <option value="E6" @if( isset( $servidor ) && $servidor->nivel == "E6" ) selected @endif>E-6</option>
                            <option value="E7" @if( isset( $servidor ) && $servidor->nivel == "E7" ) selected @endif>E-7</option>
                        </select>
                    </div>
                </div>

                <h4><i class="fa fa-group"></i> FILIAÇÃO</h4>

                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="pai">Pai</label>
                        <input type="text" class="form-control" name="pai" id="pai"
                               value="{{ $servidor->pai or old('pai') }}" placeholder="Nome do Pai">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="mae">Mãe</label>
                        <input type="text" class="form-control" name="mae" id="mae"
                               value="{{ $servidor->mae or old('mae') }}" placeholder="Nome da Mãe">
                    </div>
                </div>

                @if(PermissaoController::temPermissaoSetorPessoal())
                <h4><i class="fa fa-map-marker"></i> ENDEREÇO</h4>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="residencia_cep">CEP</label>
                        <input type="text" class="form-control" name="residencia_cep" id="residencia_cep"
                               value="{{ $servidor->residencia_cep or old('residencia_cep') }}" placeholder="CEP">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="residencia_logradouro">Logradouro</label>
                        <input type="text" class="form-control" name="residencia_logradouro" id="residencia_logradouro"
                               value="{{ $servidor->residencia_logradouro or old('residencia_logradouro') }}"
                               placeholder="Rua, avenida...">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="residencia_numero">Número</label>
                        <input type="text" class="form-control" name="residencia_numero" id="residencia_numero"
                               value="{{ $servidor->residencia_numero or old('residencia_numero') }}" placeholder="N°"
                               >
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="residencia_complemento">Complemento</label>
                        <input type="text" class="form-control" name="residencia_complemento"
                               id="residencia_complemento"
                               value="{{ $servidor->residencia_complemento or old('residencia_complemento') }}"
                               placeholder="Complemento">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="residencia_bairro">Bairro</label>
                        <input type="text" class="form-control" name="residencia_bairro" id="residencia_bairro"
                               value="{{ $servidor->residencia_bairro or old('residencia_bairro') }}"
                               placeholder="Bairro" >
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="residencia_cidade">Cidade</label>
                        <input type="text" class="form-control" name="residencia_cidade" id="residencia_cidade"
                               value="{{ $servidor->residencia_cidade or old('residencia_cidade') }}"
                               placeholder="Cidade">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="residencia_estado">Estado</label>
                        <select id="residencia_estado" name="residencia_estado" class="form-control" >
                            <option value="0"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "0" ) selected @endif>
                                Selecione
                            </option>
                            <option value="AC"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "AC" ) selected @endif>
                                Acre
                            </option>
                            <option value="AL"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "AL" ) selected @endif>
                                Alagoas
                            </option>
                            <option value="AP"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "AP" ) selected @endif>
                                Amapá
                            </option>
                            <option value="AM"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "AM" ) selected @endif>
                                Amazonas
                            </option>
                            <option value="BA"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "BA" ) selected @endif>
                                Bahia
                            </option>
                            <option value="CE"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "CE" ) selected @endif>
                                Ceará
                            </option>
                            <option value="DF"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "DF" ) selected @endif>
                                Distrito Federal
                            </option>
                            <option value="ES"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "ES" ) selected @endif>
                                Espírito Santo
                            </option>
                            <option value="GO"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "GO" ) selected @endif>
                                Goiás
                            </option>
                            <option value="MA"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "MA" ) selected @endif>
                                Maranhão
                            </option>
                            <option value="MT"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "MT" ) selected @endif>
                                Mato Grosso
                            </option>
                            <option value="MS"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "MS" ) selected @endif>
                                Mato Grosso do Sul
                            </option>
                            <option value="MG"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "MG" ) selected @endif>
                                Minas Gerais
                            </option>
                            <option value="PA"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "PA" ) selected @endif>
                                Pará
                            </option>
                            <option value="PB"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "PB" ) selected @endif>
                                Paraíba
                            </option>
                            <option value="PR"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "PR" ) selected @endif>
                                Paraná
                            </option>
                            <option value="PE"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "PE" ) selected @endif>
                                Pernambuco
                            </option>
                            <option value="PI"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "PI" ) selected @endif>
                                Piauí
                            </option>
                            <option value="RJ"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "RJ" ) selected @endif>
                                Rio de Janeiro
                            </option>
                            <option value="PB"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "PB" ) selected @endif>
                                Paraíba
                            </option>
                            <option value="RS"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "RS" ) selected @endif>
                                Rio Grande do Sul
                            </option>
                            <option value="RO"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "RO" ) selected @endif>
                                Rondônia
                            </option>
                            <option value="RR"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "RR" ) selected @endif>
                                Roraima
                            </option>
                            <option value="SC"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "SC" ) selected @endif>
                                Santa Catarina
                            </option>
                            <option value="SP"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "SP" ) selected @endif>
                                São Paulo
                            </option>
                            <option value="SE"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "SE" ) selected @endif>
                                Sergipe
                            </option>
                            <option value="TO"
                                    @if( isset( $servidor ) && $servidor->residencia_estado == "TO" ) selected @endif>
                                Tocantins
                            </option>
                        </select>
                    </div>
                </div>
                @endif
                <div class="cf"></div>

                <h4><i class="fa fa-user"></i> Dados Pessoais</h4>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="estado_civil">Estado Civil</label>
                        <select id="estado_civil" name="estado_civil" class="form-control">
                            <option value=""
                                    @if( isset( $servidor ) && $servidor->estado_civil == "" ) selected @endif>
                                Selecione
                            </option>
                            <option value="Solteiro"
                                    @if( isset( $servidor ) && $servidor->estado_civil == "Solteiro" ) selected @endif>
                                Solteiro(a)
                            </option>
                            <option value="Casado"
                                    @if( isset( $servidor ) && $servidor->estado_civil == "Casado" ) selected @endif>
                                Casado(a)
                            </option>
                            <option value="União Estável"
                                    @if( isset( $servidor ) && $servidor->estado_civil == "União Estável" ) selected @endif>
                                União Estável
                            </option>
                            <option value="Separado"
                                    @if( isset( $servidor ) && $servidor->estado_civil == "Separado" ) selected @endif>
                                Separado(a)
                            </option>
                            <option value="Divorciado"
                                    @if( isset( $servidor ) && $servidor->estado_civil == "Divorciado" ) selected @endif>
                                Divorciado(a)
                            </option>
                            <option value="Viúvo"
                                    @if( isset( $servidor ) && $servidor->estado_civil == "Viúvo" ) selected @endif>
                                Viúvo(a)
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="nacionalidade">Nacionalidade</label>
                        <select id="nacionalidade" name="nacionalidade" class="form-control">
                            <option value="Brasileiro"
                                    @if( isset( $servidor ) && $servidor->nacionalidade == "Brasileiro" ) selected @endif>Brasileiro
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="naturalidade_uf">Naturalidade Estado</label>
                        <select id="naturalidade_uf" name="naturalidade_uf" class="form-control selectEstados">
                            <option value=""
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "" ) selected @endif>
                                Selecione
                            </option>
                            <option value="AC"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "AC" ) selected @endif>Acre
                            </option>
                            <option value="AL"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "AL" ) selected @endif>
                                Alagoas
                            </option>
                            <option value="AP"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "AP" ) selected @endif>
                                Amapá
                            </option>
                            <option value="AM"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "AM" ) selected @endif>
                                Amazonas
                            </option>
                            <option value="BA"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "BA" ) selected @endif>
                                Bahia
                            </option>
                            <option value="CE"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "CE" ) selected @endif>
                                Ceará
                            </option>
                            <option value="DF"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "DF" ) selected @endif>
                                Distrito Federal
                            </option>
                            <option value="ES"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "ES" ) selected @endif>
                                Espírito Santo
                            </option>
                            <option value="GO"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "GO" ) selected @endif>
                                Goiás
                            </option>
                            <option value="MA"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "MA" ) selected @endif>
                                Maranhão
                            </option>
                            <option value="MT"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "MT" ) selected @endif>Mato
                                Grosso
                            </option>
                            <option value="MS"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "MS" ) selected @endif>Mato
                                Grosso do Sul
                            </option>
                            <option value="MG"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "MG" ) selected @endif>
                                Minas Gerais
                            </option>
                            <option value="PA"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "PA" ) selected @endif>Pará
                            </option>
                            <option value="PB"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "PB" ) selected @endif>
                                Paraíba
                            </option>
                            <option value="PR"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "PR" ) selected @endif>
                                Paraná
                            </option>
                            <option value="PE"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "PE" ) selected @endif>
                                Pernambuco
                            </option>
                            <option value="PI"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "PI" ) selected @endif>
                                Piauí
                            </option>
                            <option value="RJ"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "RJ" ) selected @endif>Rio
                                de Janeiro
                            </option>
                            <option value="RN"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "RN" ) selected @endif>Rio
                                Grande do Norte
                            </option>
                            <option value="RS"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "RS" ) selected @endif>Rio
                                Grande do Sul
                            </option>
                            <option value="RO"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "RO" ) selected @endif>
                                Rondônia
                            </option>
                            <option value="RR"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "RR" ) selected @endif>
                                Roraima
                            </option>
                            <option value="SC"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "SC" ) selected @endif>
                                Santa Catarina
                            </option>
                            <option value="SP"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "SP" ) selected @endif>São
                                Paulo
                            </option>
                            <option value="SE"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "SE" ) selected @endif>
                                Sergipe
                            </option>
                            <option value="TO"
                                    @if( isset( $servidor ) && $servidor->naturalidade_uf == "TO" ) selected @endif>
                                Tocantins
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="naturalidade_cidade">Naturalidade Cidade</label>
                        <select id="naturalidade_cidade" name="naturalidade_cidade" class="form-control">
                            @if(isset($servidor))
                                <!-- dados retornados da consulta -->
                                <option value="{{$servidor->naturalidade_cidade}}" selected>
                                    {{$servidor->naturalidade_cidade}}
                                </option>
                            @endif

                        </select>
                    </div>
                </div>
                <div class="cf"></div>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="cpf">CPF <span id="retornoErroCpf"></span></label>
                        <input type="text" class="form-control" name="cpf" id="cpf"
                               value="{{ $servidor->cpf or old('cpf') }}"
                               placeholder="CPF">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="rg_numero">RG</label>
                        <input type="text" class="form-control" name="rg_numero" id="rg_numero"
                               value="{{ $servidor->rg_numero or old('rg_numero') }}" placeholder="Número">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="rg_orgao">Órgão Expedidor</label>
                        <input type="text" class="form-control" name="rg_orgao" id="rg_orgao"
                               value="{{ $servidor->rg_orgao or old('rg_orgao') }}" placeholder="SSP, SDS...">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="rg_data_expedicao">Data de Expedição</label>
                        <input type="text" class="form-control" name="rg_data_expedicao" id="rg_data_expedicao"
                               value="{{ $servidor->rg_data_expedicao or old('rg_data_expedicao') }}"
                               placeholder="Data de Expedição">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="rg_uf">UF de Expedição</label>
                        <select id="rg_uf" name="rg_uf" class="form-control">
                            <option value="0"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "0" ) selected @endif>
                                Selecione
                            </option>
                            <option value="AC" @if( isset( $servidor ) && $servidor->rg_uf == "AC" ) selected @endif>
                                Acre
                            </option>
                            <option value="AL" @if( isset( $servidor ) && $servidor->rg_uf == "AL" ) selected @endif>
                                Alagoas
                            </option>
                            <option value="AP" @if( isset( $servidor ) && $servidor->rg_uf == "AP" ) selected @endif>
                                Amapá
                            </option>
                            <option value="AM" @if( isset( $servidor ) && $servidor->rg_uf == "AM" ) selected @endif>
                                Amazonas
                            </option>
                            <option value="BA" @if( isset( $servidor ) && $servidor->rg_uf == "BA" ) selected @endif>
                                Bahia
                            </option>
                            <option value="CE" @if( isset( $servidor ) && $servidor->rg_uf == "CE" ) selected @endif>
                                Ceará
                            </option>
                            <option value="DF" @if( isset( $servidor ) && $servidor->rg_uf == "DF" ) selected @endif>
                                Distrito Federal
                            </option>
                            <option value="ES" @if( isset( $servidor ) && $servidor->rg_uf == "ES" ) selected @endif>
                                Espírito Santo
                            </option>
                            <option value="GO" @if( isset( $servidor ) && $servidor->rg_uf == "GO" ) selected @endif>
                                Goiás
                            </option>
                            <option value="MA" @if( isset( $servidor ) && $servidor->rg_uf == "MA" ) selected @endif>
                                Maranhão
                            </option>
                            <option value="MT" @if( isset( $servidor ) && $servidor->rg_uf == "MT" ) selected @endif>
                                Mato Grosso
                            </option>
                            <option value="MS" @if( isset( $servidor ) && $servidor->rg_uf == "MS" ) selected @endif>
                                Mato Grosso do Sul
                            </option>
                            <option value="MG" @if( isset( $servidor ) && $servidor->rg_uf == "MG" ) selected @endif>
                                Minas Gerais
                            </option>
                            <option value="PA" @if( isset( $servidor ) && $servidor->rg_uf == "PA" ) selected @endif>
                                Pará
                            </option>
                            <option value="PB" @if( isset( $servidor ) && $servidor->rg_uf == "PB" ) selected @endif>
                                Paraíba
                            </option>
                            <option value="PR" @if( isset( $servidor ) && $servidor->rg_uf == "PR" ) selected @endif>
                                Paraná
                            </option>
                            <option value="PE" @if( isset( $servidor ) && $servidor->rg_uf == "PE" ) selected @endif>
                                Pernambuco
                            </option>
                            <option value="PI" @if( isset( $servidor ) && $servidor->rg_uf == "PI" ) selected @endif>
                                Piauí
                            </option>
                            <option value="RJ" @if( isset( $servidor ) && $servidor->rg_uf == "RJ" ) selected @endif>Rio
                                de Janeiro
                            </option>
                            <option value="RN" @if( isset( $servidor ) && $servidor->rg_uf == "RN" ) selected @endif>Rio
                                Grande do Norte
                            </option>
                            <option value="RS" @if( isset( $servidor ) && $servidor->rg_uf == "RS" ) selected @endif>Rio
                                Grande do Sul
                            </option>
                            <option value="RO" @if( isset( $servidor ) && $servidor->rg_uf == "RO" ) selected @endif>
                                Rondônia
                            </option>
                            <option value="RR" @if( isset( $servidor ) && $servidor->rg_uf == "RR" ) selected @endif>
                                Roraima
                            </option>
                            <option value="SC" @if( isset( $servidor ) && $servidor->rg_uf == "SC" ) selected @endif>
                                Santa Catarina
                            </option>
                            <option value="SP" @if( isset( $servidor ) && $servidor->rg_uf == "SP" ) selected @endif>São
                                Paulo
                            </option>
                            <option value="SE" @if( isset( $servidor ) && $servidor->rg_uf == "SE" ) selected @endif>
                                Sergipe
                            </option>
                            <option value="TO" @if( isset( $servidor ) && $servidor->rg_uf == "TO" ) selected @endif>
                                Tocantins
                            </option>
                        </select>
                    </div>
                </div>
                <div class="cf"></div>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="carteira_trabalho_numero">CTPS Número</label>
                        <input type="text" class="form-control" name="carteira_trabalho_numero"
                               id="carteira_trabalho_numero"
                               value="{{ $servidor->carteira_trabalho_numero or old('carteira_trabalho_numero') }}"
                               placeholder="Número">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="carteira_trabalho_serie">Série</label>
                        <input type="text" class="form-control" name="carteira_trabalho_serie"
                               id="carteira_trabalho_serie"
                               value="{{ $servidor->carteira_trabalho_serie or old('carteira_trabalho_serie') }}"
                               placeholder="CTPS Série">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="carteira_trabalho_uf">UF</label>
                        <select id="carteira_trabalho_uf" name="carteira_trabalho_uf" class="form-control">
                            <option value="0"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "0" ) selected @endif>
                                Selecione
                            </option>
                            <option value="AC"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "AC" ) selected @endif>
                                Acre
                            </option>
                            <option value="AL"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "AL" ) selected @endif>
                                Alagoas
                            </option>
                            <option value="AP"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "AP" ) selected @endif>
                                Amapá
                            </option>
                            <option value="AM"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "AM" ) selected @endif>
                                Amazonas
                            </option>
                            <option value="BA"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "BA" ) selected @endif>
                                Bahia
                            </option>
                            <option value="CE"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "CE" ) selected @endif>
                                Ceará
                            </option>
                            <option value="DF"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "DF" ) selected @endif>
                                Distrito Federal
                            </option>
                            <option value="ES"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "ES" ) selected @endif>
                                Espírito Santo
                            </option>
                            <option value="GO"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "GO" ) selected @endif>
                                Goiás
                            </option>
                            <option value="MA"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "MA" ) selected @endif>
                                Maranhão
                            </option>
                            <option value="MT"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "MT" ) selected @endif>
                                Mato Grosso
                            </option>
                            <option value="MS"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "MS" ) selected @endif>
                                Mato Grosso do Sul
                            </option>
                            <option value="MG"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "MG" ) selected @endif>
                                Minas Gerais
                            </option>
                            <option value="PA"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "PA" ) selected @endif>
                                Pará
                            </option>
                            <option value="PB"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "PB" ) selected @endif>
                                Paraíba
                            </option>
                            <option value="PR"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "PR" ) selected @endif>
                                Paraná
                            </option>
                            <option value="PE"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "PE" ) selected @endif>
                                Pernambuco
                            </option>
                            <option value="PI"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "PI" ) selected @endif>
                                Piauí
                            </option>
                            <option value="RJ"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "RJ" ) selected @endif>
                                Rio de Janeiro
                            </option>
                            <option value="PB"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "PB" ) selected @endif>
                                Paraíba
                            </option>
                            <option value="RS"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "RS" ) selected @endif>
                                Rio Grande do Sul
                            </option>
                            <option value="RO"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "RO" ) selected @endif>
                                Rondônia
                            </option>
                            <option value="RR"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "RR" ) selected @endif>
                                Roraima
                            </option>
                            <option value="SC"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "SC" ) selected @endif>
                                Santa Catarina
                            </option>
                            <option value="SP"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "SP" ) selected @endif>
                                São Paulo
                            </option>
                            <option value="SE"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "SE" ) selected @endif>
                                Sergipe
                            </option>
                            <option value="TO"
                                    @if( isset( $servidor ) && $servidor->carteira_trabalho_uf == "TO" ) selected @endif>
                                Tocantins
                            </option>
                        </select>
                    </div>
                    <div class="cf"></div>
                    <div class="form-group col-sm-3">
                        <label for="titulo_eleitor_numero">Título de Eleitor</label>
                        <input type="text" class="form-control" name="titulo_eleitor_numero" id="titulo_eleitor_numero"
                               value="{{ $servidor->titulo_eleitor_numero or old('titulo_eleitor_numero') }}"
                               placeholder="Número">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="titulo_eleitor_zona">Zona</label>
                        <input type="text" class="form-control" name="titulo_eleitor_zona" id="titulo_eleitor_zona"
                               value="{{ $servidor->titulo_eleitor_zona or old('titulo_eleitor_zona') }}"
                               placeholder="Título Zona">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="titulo_eleitor_seccao">Seção</label>
                        <input type="text" class="form-control" name="titulo_eleitor_seccao" id="titulo_eleitor_seccao"
                               value="{{ $servidor->titulo_eleitor_seccao or old('titulo_eleitor_seccao') }}"
                               placeholder="Título Seção">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="titulo_eleitor_uf">UF do Título</label>
                        <select id="titulo_eleitor_uf" name="titulo_eleitor_uf" class="form-control">
                            <option value="0"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "0" ) selected @endif>
                                Selecione
                            </option>
                            <option value="AC"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "AC" ) selected @endif>
                                Acre
                            </option>
                            <option value="AL"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "AL" ) selected @endif>
                                Alagoas
                            </option>
                            <option value="AP"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "AP" ) selected @endif>
                                Amapá
                            </option>
                            <option value="AM"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "AM" ) selected @endif>
                                Amazonas
                            </option>
                            <option value="BA"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "BA" ) selected @endif>
                                Bahia
                            </option>
                            <option value="CE"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "CE" ) selected @endif>
                                Ceará
                            </option>
                            <option value="DF"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "DF" ) selected @endif>
                                Distrito Federal
                            </option>
                            <option value="ES"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "ES" ) selected @endif>
                                Espírito Santo
                            </option>
                            <option value="GO"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "GO" ) selected @endif>
                                Goiás
                            </option>
                            <option value="MA"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "MA" ) selected @endif>
                                Maranhão
                            </option>
                            <option value="MT"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "MT" ) selected @endif>
                                Mato Grosso
                            </option>
                            <option value="MS"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "MS" ) selected @endif>
                                Mato Grosso do Sul
                            </option>
                            <option value="MG"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "MG" ) selected @endif>
                                Minas Gerais
                            </option>
                            <option value="PA"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "PA" ) selected @endif>
                                Pará
                            </option>
                            <option value="PB"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "PB" ) selected @endif>
                                Paraíba
                            </option>
                            <option value="PR"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "PR" ) selected @endif>
                                Paraná
                            </option>
                            <option value="PE"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "PE" ) selected @endif>
                                Pernambuco
                            </option>
                            <option value="PI"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "PI" ) selected @endif>
                                Piauí
                            </option>
                            <option value="RJ"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "RJ" ) selected @endif>
                                Rio de Janeiro
                            </option>
                            <option value="RN"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "RN" ) selected @endif>
                                Rio Grande do Norte
                            </option>
                            <option value="RS"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "RS" ) selected @endif>
                                Rio Grande do Sul
                            </option>
                            <option value="RO"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "RO" ) selected @endif>
                                Rondônia
                            </option>
                            <option value="RR"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "RR" ) selected @endif>
                                Roraima
                            </option>
                            <option value="SC"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "SC" ) selected @endif>
                                Santa Catarina
                            </option>
                            <option value="SP"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "SP" ) selected @endif>
                                São Paulo
                            </option>
                            <option value="SE"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "SE" ) selected @endif>
                                Sergipe
                            </option>
                            <option value="TO"
                                    @if( isset( $servidor ) && $servidor->titulo_eleitor_uf == "TO" ) selected @endif>
                                Tocantins
                            </option>
                        </select>
                    </div>
                    <div class="cf"></div>
                    <div class="form-group col-sm-3">
                        <label for="certificado_militar">Certificado Militar</label>
                        <input type="text" class="form-control" name="certificado_militar" id="certificado_militar"
                               value="{{ $servidor->certificado_militar or old('certificado_militar') }}"
                               placeholder="Certificado Militar">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="pis">PIS / NIS</label>
                        <input type="text" class="form-control" name="pis" id="pis"
                               value="{{ $servidor->pis or old('pis') }}" placeholder="PIS">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="pasep">PASEP</label>
                        <input type="text" class="form-control" name="pasep" id="pasep"
                               value="{{ $servidor->pasep or old('pasep') }}" placeholder="PASEP">
                    </div>
                </div>
                <div class="cf"></div>

                <h4><i class="fas fa-phone-square"></i> Contatos</h4>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="contato">Telefones</label>

                        <div id="grupoContato">
                            @if( !empty($dadosContato) && isset($dadosContato) )
                                <i class="fas fa-plus-square m-l-05 cursorPointer" id="addFone"></i>
                                @foreach(json_decode($dadosContato) as $contato)
                                    <div>
                                        <input type="text" class="form-control" name="fone[]"
                                               value="{{$contato->numero}}" id="fone" placeholder="Telefone 01">
                                        <i class="fas fa-minus-circle cursorPointer remove_field" data-toggle="tooltip"
                                           data-placement="top" title="Adicionar contato"></i><br>
                                    </div>
                                @endforeach
                            @else
                                <input type="text" class="form-control" name="fone[]" id="fone"
                                       placeholder="Telefone 01">
                                <i class="fas fa-plus-square m-l-05 cursorPointer" data-toggle="tooltip"
                                   data-placement="top" title="Adicionar contato" id="addFone"></i>
                            @endif

                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email"
                               value="{{ $servidor->email or old('email') }}" placeholder="E-mail">
                    </div>
                </div>
                <div class="cf"></div>
                <h4><i class="fa fa-institution"></i> Dados de Lotação</h4>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="orgao_vinculacao">Órgão de Vinculação</label>
                        <select name="orgao_vinculacao" id="orgao_vinculacao" class="form-control">
                            <option value=""
                                    @if( isset( $servidor ) && $servidor->orgao_vinculacao == "" ) selected @endif>
                                Selecione
                            </option>
                            @foreach(($secretarias) as $sec)
                                <option value="{{ $sec }}"
                                        @if( isset( $servidor ) && $servidor->orgao_vinculacao == $sec ) selected @endif>{{ $sec }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6 d-none div_vinc_org_outros">
                        <label for="orgao_vinculacao_outros">Informe o Órgão</label>
                        <input type="text" class="form-control" name="orgao_vinculacao_outros"
                               id="orgao_vinculacao_outros"
                               value="{{ $servidor->orgao_vinculacao_outros or old('orgao_vinculacao_outros') }}"
                               placeholder="informe o Órgão">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="lotacao">Lotação</label>
                        <select id="lotacao" name="lotacao" class="form-control" required>
                            <option value="" @if( isset( $servidor ) && $servidor->lotacao == '') selected @endif>Selecione</option>
                            <optgroup label="DER-GA">
                                @foreach(json_decode($lotacao) as $l)
                                    @if($l->coordenadoria == 2)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="DER-LI">
                                @foreach(json_decode($lotacao) as $l)
                                    @if($l->coordenadoria == 3)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="DER-RS">
                                @foreach(json_decode($lotacao) as $l)
                                    @if($l->coordenadoria == 4)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="DER-SEP">
                                @foreach(json_decode($lotacao) as $l)
                                    @if($l->coordenadoria == 5)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="Gabinete">
                                @foreach(json_decode($lotacao) as $l)
                                    @if($l->coordenadoria == 1)
                                        <option value="{{ $l->id }}"
                                                @if( isset( $servidor ) && $servidor->lotacao == $l->id ) selected @endif>{{ $l->sigla }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="cargo">Cargo</label>
                        <select id="cargo" name="cargo" class="form-control" required>
                            @foreach(json_decode($cargos) as $cargo)
                                <option value="{{ $cargo->id }}"
                                        @if( isset( $servidor ) && $servidor->cargo == $cargo->id ) selected @endif>{{ $cargo->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="funcao">Função</label>
                        <select id="funcao" name="funcao" class="form-control">
                            <option value=""
                                    @if( isset( $servidor ) && $servidor->funcao == "" ) selected @endif>
                                Selecione
                            </option>
                            @foreach(json_decode($funcoes) as $funcao)
                                <option value="{{ $funcao->id }}"
                                        @if( isset( $servidor ) && $servidor->funcao == $funcao->id ) selected
                                        @endif @if($funcao->nome == "Servidor") selected @endif>{{ $funcao->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--<div class="form-group col-sm-3">--}}
                    {{--<label for="unidade">Unidade</label>--}}
                    {{--<input type="text" class="form-control" name="unidade" id="unidade" value="{{ $servidor->unidade or old('unidade') }}" placeholder="Unidade">--}}
                    {{--</div>--}}
                    <div class="form-group col-sm-3">
                        <label for="qtd_vinculo">Quantidade de Vínculos</label>
                        <input type="text" class="form-control" name="qtd_vinculo" id="qtd_vinculo"
                               value="{{ $servidor->qtd_vinculo or old('qtd_vinculo') }}"
                               placeholder="Quantidade de Vínculos">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="carga_horaria">Carga Horária</label>
                        <input type="text" class="form-control" name="carga_horaria" id="carga_horaria"
                               value="{{ $servidor->carga_horaria or old('carga_horaria') }}"
                               placeholder="Carga Horária">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="data_admissao_estado">Data de Admissão no Estado</label>
                        <input type="text" class="form-control" name="data_admissao_estado" id="data_admissao_estado"
                               value="{{ $servidor->data_admissao_estado or old('data_admissao_estado') }}"
                               placeholder="Data de Admissão no Estado">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="data_nomeacao">Data de nomeção</label>
                        <input type="text" class="form-control" name="data_nomeacao" id="data_nomeacao"
                               value="{{ $servidor->data_nomeacao or old('data_nomeacao') }}"
                               placeholder="Data de Nomeação">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="data_posse">Data da posse</label>
                        <input type="text" class="form-control" name="data_posse" id="data_posse"
                               value="{{ $servidor->data_posse or old('data_posse') }}" placeholder="Data da Posse">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="data_exercicio">Data da entrada em exercício</label>
                        <input type="text" class="form-control" name="data_exercicio" id="data_exercicio"
                               value="{{ $servidor->data_exercicio or old('data_exercicio') }}" placeholder="Data da Entrada em Exercício">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="situacao">Situação</label>
                        <select id="situacao" name="situacao" class="form-control">
                            <option value=""
                                    @if( isset( $servidor ) && $servidor->situacao == "" ) selected @endif>
                                Selecione
                            </option>
                            <option value="Em Exercicio"
                                    @if( isset( $servidor ) && $servidor->situacao == "Em Exercicio" ) selected @endif>
                                Em exercício
                            </option>
                            <option value="Cedido"
                                    @if( isset( $servidor ) && $servidor->situacao == "Cedido" ) selected @endif>Cedido
                            </option>
                            <option value="Aposentado"
                                    @if( isset( $servidor ) && $servidor->situacao == "Aposentado" ) selected @endif>
                                Aposentado
                            </option>
                            <option value="Demitido"
                                    @if( isset( $servidor ) && $servidor->situacao == "Demitido" ) selected @endif>
                                Demitido
                            </option>
                            <option value="Exonerado"
                                    @if( isset( $servidor ) && $servidor->situacao == "Exonerado" ) selected @endif>
                                Exonerado
                            </option>
                            <option value="Redistribuido"
                                    @if( isset( $servidor ) && $servidor->situacao == "Redistribuido" ) selected @endif>
                                Redistribuído
                            </option>
                        </select>
                    </div>

                </div>
                <div class="cf"></div>
                <h4><i class="fa fa-graduation-cap"></i> Instrução</h4>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="grau_instucao">Grau de Instrução</label>
                        <select name="grau_instucao" id="grau_instucao" class="form-control">
                            <option value="">Selecione o grau</option>
                            <option value="Fundamental"
                                    @if( isset( $servidor ) && $servidor->grau_instucao == "Fundamental" ) selected @endif>
                                Fundamental
                            </option>
                            <option value="Médio"
                                    @if( isset( $servidor ) && $servidor->grau_instucao == "Médio" ) selected @endif>
                                Médio
                            </option>
                            <option value="Médio Incompleto"
                                    @if( isset( $servidor ) && $servidor->grau_instucao == "Médio Incompleto" ) selected @endif>
                                Médio Incompleto
                            </option>
                            <option value="Superior"
                                    @if( isset( $servidor ) && $servidor->grau_instucao == "Superior" ) selected @endif>
                                Superior
                            </option>
                            <option value="Superior Incompleto"
                                    @if( isset( $servidor ) && $servidor->grau_instucao == "Superior Incompleto" ) selected @endif>
                                Superior Incompleto
                            </option>
                            <option value="Pós Graduação"
                                    @if( isset( $servidor ) && $servidor->grau_instucao == "Pós Graduação" ) selected @endif>
                                Pós Graduação
                            </option>
                            <option value="Mestrado"
                                    @if( isset( $servidor ) && $servidor->grau_instucao == "Mestrado" ) selected @endif>
                                Mestrado
                            </option>
                            <option value="Doutorado"
                                    @if( isset( $servidor ) && $servidor->grau_instucao == "Doutorado" ) selected @endif>
                                Doutorado
                            </option>
                            <option value="Pós-Doutorado"
                                    @if( isset( $servidor ) && $servidor->grau_instucao == "Pós-Doutorado" ) selected @endif>
                                Pós-Doutorado
                            </option>
                        </select>
                    </div>

                    @if(isset($cursosHidden))
                        <input type="hidden" value="{{$cursosHidden}}" id="cursosHidden">
                    @endif
                    <div id="grupoCursos" class="form-group col-sm-6">
                        <label for="cursos">Curso</label><br>
                        <select name="cursos[]" id="cursos" class="form-control selectMultiple" multiple="multiple">
                            @foreach($cursos as $curso=>$c)
                                <option value="{{$c}}">{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="cf"></div>

                <h4><i class="fa fa-money"></i> Dados Financeiros</h4>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="banco">Banco</label>
                        <input type="text" class="form-control" name="banco" id="banco"
                               value="{{ $servidor->banco or old('banco') }}" placeholder="Banco">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="conta_corrente">Conta Corrente</label>
                        <input type="text" class="form-control" name="conta_corrente" id="conta_corrente"
                               value="{{ $servidor->conta_corrente or old('conta_corrente') }}"
                               placeholder="Conta Corrente">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="agencia_bancaria">Agência Bancária</label>
                        <input type="text" class="form-control" name="agencia_bancaria" id="agencia_bancaria"
                               value="{{ $servidor->agencia_bancaria or old('agencia_bancaria') }}"
                               placeholder="Agência Bancária">
                    </div>

                </div>
                <div class="cf"></div>

                @if(PermissaoController::temPermissaoSetorPessoal())
                <h4><i class="fa fa-sitemap"></i> Dependentes</h4>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="dep_qtd">Quantidade de dependentes</label>
                        <select id="dep_qtd" name="dep_qtd" class="form-control">
                            <option value="">Selecione</option>
                            <option value="0" @if(isset($dependentes) && count($dependentes) == 0) selected @endif>
                                Nenhum
                            </option>
                            <option value="1" @if(isset($dependentes) && count($dependentes) == 1) selected @endif>01
                                Dependente
                            </option>
                            <option value="2" @if(isset($dependentes) && count($dependentes) == 2) selected @endif>02
                                Dependentes
                            </option>
                            <option value="3" @if(isset($dependentes) && count($dependentes) == 3) selected @endif>03
                                Dependentes
                            </option>
                            <option value="4" @if(isset($dependentes) && count($dependentes) == 4) selected @endif>04
                                Dependentes
                            </option>
                            <option value="5" @if(isset($dependentes) && count($dependentes) == 5) selected @endif>05
                                Dependentes
                            </option>
                            <option value="6" @if(isset($dependentes) && count($dependentes) == 6) selected @endif>06
                                Dependentes
                            </option>
                            <option value="7" @if(isset($dependentes) && count($dependentes) == 7) selected @endif>07
                                Dependentes
                            </option>
                            <option value="8" @if(isset($dependentes) && count($dependentes) == 8) selected @endif>08
                                Dependentes
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="dep_salario_familia">Quantidade dependentes Salário Família</label>
                        <input type="text" class="form-control" name="dep_salario_familia" id="dep_salario_familia"
                               value="{{ $servidor->dep_salario_familia or old('dep_salario_familia') }}"
                               placeholder="Dep. Sal. Família">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="dp_irrf">Quantidade dependentes IRRF</label>
                        <input type="text" class="form-control" name="dp_irrf" id="dp_irrf"
                               value="{{ $servidor->dp_irrf or old('dp_irrf') }}" placeholder="Dep. IRRF">
                    </div>

                </div>
                <div id="dependentes_dados">

                    @if(isset($dependentes) && count($dependentes) != 0)
                        @foreach(json_decode($dependentes) as $dependente)
                            <div class="form-row depententes">
                                <div class="form-group col-sm-6">
                                    <label for="dep_nome">Nome do dependente</label>
                                    <input type="text" class="form-control" name="dep_nome[]" id="dep_nome"
                                           value="{{ $dependente->nome }}" placeholder="Nome do dependente">
                                    <i class="fas fa-minus-circle cursorPointer remove_dependente" data-toggle="tooltip"
                                       data-placement="top" title="Apagar o dependente {{ $dependente->nome }}"></i>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="dep_parentesco">Parentesco</label>
                                    <select id="dep_parentesco" name="dep_parentesco[]" class="form-control">
                                        <option value="">Selecione</option>
                                        <option value="Cônjuge"
                                                @if($dependente->parentesco == "Cônjuge") selected @endif>Cônjuge
                                        </option>
                                        <option value="Companheiro(a)"
                                                @if($dependente->parentesco == "Companheiro(a)") selected @endif>
                                            Companheiro(a)
                                        </option>
                                        <option value="Filho(a)"
                                                @if($dependente->parentesco == "Filho(a)") selected @endif>Filho(a)
                                        </option>
                                        <option value="Enteado(a)"
                                                @if($dependente->parentesco == "Enteado(a)") selected @endif>Enteado(a)
                                        </option>
                                        <option value="Irmãos"
                                                @if($dependente->parentesco == "Irmãos(a)") selected @endif>Irmãos
                                        </option>
                                        <option value="Pais" @if($dependente->parentesco == "Pais") selected @endif>
                                            Pais
                                        </option>
                                        <option value="Avós" @if($dependente->parentesco == "Avós") selected @endif>
                                            Avós
                                        </option>
                                    </select>

                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="dep_nascimento">Data de nascimento</label>
                                    <input type="text" class="form-control" name="dep_nascimento[]" id="dep_nascimento"
                                           value="{{ $dependente->nascimento }}" placeholder="Nome do dependente">
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
                <div class="cf"></div>

                <h4><i class="fa fa-user"></i> Cônjuge</h4>

                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="conjuge_nome">Nome</label>
                        <input type="text" class="form-control" name="conjuge_nome" id="conjuge_nome"
                               value="{{ $servidor->conjuge_nome or old('conjuge_nome') }}"
                               placeholder="Nome do Conjuge">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="conjuge_matricula">Matrícula</label>
                        <input type="text" class="form-control" name="conjuge_matricula" id="conjuge_matricula"
                               value="{{ $servidor->conjuge_matricula or old('conjuge_matricula') }}"
                               placeholder="Matrícula Conjuge">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="conjuge_orgao"> Órgão</label>
                        <input type="text" class="form-control" name="conjuge_orgao" id="conjuge_orgao"
                               value="{{ $servidor->conjuge_orgao or old('conjuge_orgao') }}"
                               placeholder="Órgão Cônjuge">
                    </div>

                </div>
                @endif
                <div class="cf"></div>

                <div class="form-row">
                    <label for="exampleFormControlFile1"></label>
                    <input type="file" accept="image/*" class="form-control-file d-none" name="inputFile"
                           id="inputFile">
                </div>
                @if(isset($servidor))
                    <a href="{{ URL::previous() }}" class="btn btn-danger plr1_4em btnFixed"><i
                                class="fas fa-times"></i> CANCELAR
                        EDIÇÃO</a>

                    <button type="submit" class="btn btn-primary m-t-20 mb-5 btnFixed"><i class="fas fa-check"></i>
                        SALVAR
                        ALTERAÇÕES
                    </button>
                @else
                    <button type="submit" class="btn btn-primary mb-5 btnFixed"><i class="fas fa-check"></i> CADASTRAR
                        SERVIDOR
                    </button>
                    <a href="{{ URL::previous() }}" class="btn btn-danger plr1em btnFixed"><i class="fas fa-times"></i>
                        CANCELAR CADASTRO</a>
                @endif

            </form>
