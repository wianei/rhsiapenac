$(document).ready(function () {

    function loadFoto(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgServidor').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        loadFoto(this)
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    var max_fields = 4;
    var wrapper = $("#grupoContato");
    var add_button = $("#addFone");

    var x = 1; //initlal text box count
    $(add_button).click(function (e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div><input type="text" class="form-control" name="fone[]" id="fone" placeholder="Telefone 0' + x + '"><i class="fas fa-minus-circle cursorPointer remove_field"></i></div><br>');
        }
    });

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });

    // apaga o dependente
    $("#dependentes_dados").on("click", ".remove_dependente", function (e) {
        e.preventDefault();
        $(this).closest('.depententes').remove();
        x--;

        // muda o opition value selecionado do select dep_qtd
        var optionValue = $('input[name="dep_nome[]"]').length;
        $("#dep_qtd").val(optionValue)
            .find("option[value=" + optionValue + "]").attr('selected', true);
    });

    /**
     * configura os dados dos dependentes
     */

        // seta a mascara para o campo dep_nascimento criado dinamicamente
    $(document).on('focus', '#dep_nascimento', function () {
        $(this).mask('00/00/0000');
    });

    $("#dep_qtd").change(function () {

        // pega a quantidade de inputs que estão visiveis
        var inputcreate = $('input[name="dep_nome[]"]').length;

        // apaga os dados que estao na div
        var qtdDependente = $('#dep_qtd').val();

        // subtrai de campos
        if (qtdDependente < inputcreate) {
            $("#dependentes_dados").html("");

            for (i = qtdDependente; i < inputcreate; i++) {
                $("#dependentes_dados").append(
                    '<div class="form-row depententes">' +
                    '<div class="form-group col-sm-6">' +
                    '<label for="dep_nome">Nome do dependente</label>' +
                    '<input type="text" class="form-control" name="dep_nome[]" id="dep_nome' + i + '" placeholder="Nome do dependente" required>' +
                    '<i class="fas fa-minus-circle cursorPointer remove_dependente" data-toggle="tooltip" data-placement="top" title="Apagar campo"></i>' +
                    '</div>' +
                    '<div class="form-group col-sm-3">' +
                    '<label for="dep_parentesco' + i + '">Parentesco</label>' +
                    '<select id="dep_parentesco' + i + '" name="dep_parentesco[]" class="form-control" required>' +
                    '<option value="">Selecione</option>' +
                    '<option value="Cônjuge">Cônjuge</option>' +
                    '<option value="Companheiro(a)">Companheiro(a)</option>' +
                    '<option value="Filho(a)">Filho(a)</option>' +
                    '<option value="Enteado(a)">Enteado(a)</option>' +
                    '<option value="Irmãos">Irmãos</option>' +
                    '<option value="Pais">Pais</option>' +
                    '<option value="Avós">Avós</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group col-sm-3">' +
                    '<label for="dep_nascimento' + i + '">Data de nascimento</label>' +
                    '<input type="text" class="form-control maskData" name="dep_nascimento[]" id="dep_nascimento" placeholder="Data de nascimento do dependente" data-mask="00/00/0000" required>' +
                    '</div>' +
                    '</div>');

            }

        }

        var i;

        // acrescenta campos
        for (i = inputcreate; i < qtdDependente; i++) {
            $("#dependentes_dados").append(
                '<div class="form-row depententes">' +
                '<div class="form-group col-sm-6">' +
                '<label for="dep_nome">Nome do dependente</label>' +
                '<input type="text" class="form-control" name="dep_nome[]" id="dep_nome' + i + '" placeholder="Nome do dependente" required>' +
                '<i class="fas fa-minus-circle cursorPointer remove_dependente" data-toggle="tooltip" data-placement="top" title="Apagar campo"></i>' +
                '</div>' +
                '<div class="form-group col-sm-3">' +
                '<label for="dep_parentesco' + i + '">Parentesco</label>' +
                '<select id="dep_parentesco' + i + '" name="dep_parentesco[]" class="form-control" required>' +
                '<option value="">Selecione</option>' +
                '<option value="Cônjuge">Cônjuge</option>' +
                '<option value="Companheiro(a)">Companheiro(a)</option>' +
                '<option value="Filho(a)">Filho(a)</option>' +
                '<option value="Enteado(a)">Enteado(a)</option>' +
                '<option value="Irmãos">Irmãos</option>' +
                '<option value="Pais">Pais</option>' +
                '<option value="Avós">Avós</option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group col-sm-3">' +
                '<label for="dep_nascimento' + i + '">Data de nascimento</label>' +
                '<input type="text" class="form-control maskData" name="dep_nascimento[]" id="dep_nascimento" placeholder="Data de nascimento do dependente" data-mask="00/00/0000" required>' +
                '</div>' +
                '</div>');

        }

    });


    $('#data_nascimento, #rg_data_expedicao, #data_admissao_estado, #data_nomeacao, #data_posse, #data_exercicio').mask('00/00/0000');

    $('#matricula, #residencia_numero, #carga_horaria, #cpf, #fone').mask('0#');

    $('#dep_salario_familia, #dp_irrf').mask('0');

    $('#cursos').multiselect({
        maxHeight: 250,
        buttonWidth: '250px'
    });

    /**
     * pega os cursos do servidor e marca no selec
     * @type {Array|*|jQuery}
     */
    if($("#cursosHidden").length)
    {
        var valArr = $("#cursosHidden").val().split(',');
        i = 0, size = valArr.length;
        for (i; i < size; i++) {
            $(":checkbox[value='" + valArr[i] + "']").attr("checked", "checked");
            $("#cursos option[value='" + valArr[i] + "']").attr("selected", 1);
            $("#cursos").multiselect("refresh");
        }

    }

    $("#residencia_logradouro, #residencia_bairro, #residencia_cidade").attr('disabled', true);

    /**
     * consulta endereco pelo cep
     */
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#residencia_logradouro").val("");
        $("#residencia_bairro").val("");
        $("#residencia_cidade").val("");
    }
    $("#residencia_cep").blur(function () {

        var cep = $(this).val().replace(/\D/g, '');

        if (cep != "") {

            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {

                $("#residencia_logradouro, #residencia_bairro, #residencia_cidade").attr('disabled', true);

                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#residencia_logradouro").val(dados.logradouro);
                        $("#residencia_bairro").val(dados.bairro);
                        $("#residencia_cidade").val(dados.localidade);
                        $("#residencia_logradouro, #residencia_bairro, #residencia_cidade").attr('disabled', false);

                        var returnUf = dados.uf;

                        $("#residencia_estado option[value='" + returnUf + "']").attr("selected", 1);

                    }
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        $("#residencia_logradouro, #residencia_bairro, #residencia_cidade").attr('disabled', false);
                    }
                });
            }
            else {
                //cep é inválido.
                limpa_formulário_cep();
                $("#residencia_logradouro, #residencia_bairro, #residencia_cidade").attr('disabled', false);
            }
        }
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
            $("#residencia_logradouro, #residencia_bairro, #residencia_cidade").attr('disabled', false);
        }
    });

    $( document ).on( "change", ".selectEstados", function() {

        var idSelect = $(this).attr('id');

        switch (idSelect){
            case "naturalidade_uf":
                var selectCidade = "naturalidade_cidade";
                break;
        }

        $('#'+selectCidade).html("");

        var ufPost        = $("#naturalidade_uf").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/../municipios/pesquisa-ajax",
            data: {uf: ufPost},
            beforeSend: function() {

            },
            success: function (dados) {

                var objt = jQuery.parseJSON(dados);

                $.each(objt,function(key, value)
                {
                    $('#'+selectCidade).append('<option value=' + value + '>' + value + '</option>');
                });

            }
        });

    });


    if($('#orgao_vinculacao option:selected').text() == "Outros"){

        $('.div_vinc_org_outros').removeClass('d-none');
    }

    $('#orgao_vinculacao').change(function() {
        var orgaoVinculacao = $('#orgao_vinculacao option:selected').text();
         if(orgaoVinculacao == "Outros")
         {
             $('.div_vinc_org_outros').removeClass('d-none');
         }else{
             $('.div_vinc_org_outros').addClass('d-none');
         }
    });

    /**
     * faz a validação do cpf
     */
    function validaCpf(strCPF) {
        var Soma;
        var Resto;
        Soma = 0;
        if (strCPF == "00000000000") return false;

        for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
        return true;
    }

    $("#cpf").blur(function(){
       var cpf = $("#cpf").val();
        var validacaoCpf = validaCpf(cpf);
        if(validacaoCpf == false)
        {
            $(this).focus();
            $("#retornoErroCpf").html(" - Dado inválido, corrija-o!").css("color", "#CC0000")
            $("#cpf").css("border", "1px solid #CC0000")
        } else {

            $("#retornoErroCpf").html(" Ok!").css("color", "#0d47a1")
            $("#cpf").css("border", "1px solid #0d47a1")

        }
    });
});
