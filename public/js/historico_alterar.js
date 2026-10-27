$(document).ready(function(){
    jQuery(function ($) {
        $.datepicker.regional['pt-BR'] = {
            closeText: 'Fechar',
            prevText: '&#x3c;Anterior',
            nextText: 'Pr&oacute;ximo&#x3e;',
            currentText: 'Hoje',
            monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
                'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
    });

    $(function () {
        var dateFormat = "dd/mm/yy",
            from = $("#data_inicio")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1
                })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));
                }),
            to = $("#data_final").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1
                })
                .on("change", function () {
                    from.datepicker("option", "maxDate", getDate(this));
                });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });

    if($('#tipo option:selected').text() == "Outros"){

        $('#divTitulo').css('display','block');
    }

    if($('#tipo option:selected').text() == "Licenças"){

        $('#divTipoLicenca').show('fast');
    }

    if ($('#tipo option:selected').text() == "Atestado") {

        $('#divData').show('fast');
    }
    if ($('#tipo option:selected').text() == "Afastamento") {

        $('#divAfastamento').show('fast');
    }
    if ($('#tipo option:selected').text() == "Concessões") {

        $('#divConcessao').show('fast');
    }
    if ($('#tipo option:selected').text() == "Penalidades") {

        $('#divTipoPenalidade').show('fast');
    }
    if ($('#tipo option:selected').text() == "Remoções") {

        $('#divLotacao').show('fast');
    }

    $('#tipo').change(function(){
        var opcaoSelecionada = $('#tipo option:selected').text();

        if(opcaoSelecionada == "Outros")
        {
            $('#divTitulo').show('fast');
        } else {
            $('#divTitulo').hide('fast');
        }
        if(opcaoSelecionada == "Afastamento")
        {
            $('#divAfastamento').show('fast');
        } else {
            $('#divAfastamento').hide('fast');
        }
        if(opcaoSelecionada == "Concessões")
        {
            $('#divConcessao').show('fast');
        } else {
            $('#divConcessao').hide('fast');
        }
        if(opcaoSelecionada == "Férias")
        {
            $('#divMesAno').show('fast');
        } else {
            $('#divMesAno').hide('fast');
        }
        if(opcaoSelecionada == "Licenças")
        {
            $('#divTipoLicenca').show('fast');
        } else {
            $('#divTipoLicenca').hide('fast');
        }
        if (opcaoSelecionada == "Atestado") {
            $('#divData').show('fast');
        } else {
            $('#divData').hide('fast');
        }
        if (opcaoSelecionada == "Penalidades") {
            $('#divTipoPenalidade').show('fast');
        } else {
            $('#divTipoPenalidade').hide('fast');
        }
        if (opcaoSelecionada == "Remoções") {
            $('#divLotacao').show('fast');
        } else {
            $('#divLotacao').hide('fast');
        }

    });

});