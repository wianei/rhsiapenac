$(document).ready(function(){


    jQuery(function($){
        $.datepicker.regional['pt-BR'] = {
            closeText: 'Fechar',
            prevText: '&#x3c;Anterior',
            nextText: 'Pr&oacute;ximo&#x3e;',
            currentText: 'Hoje',
            monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
                'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
                'Jul','Ago','Set','Out','Nov','Dez'],
            dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
            dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
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


    $('.card-header').click(function(){

        // procura a a primeira tag i que contenha a class
        if( $(this).find('i').hasClass('fas fa-plus')){

            $(this).find('i').removeClass('fas fa-plus')
            $(this).find('i').addClass('fas fa-minus')

            }

        else{
            $(this).find('i').removeClass('fas fa-minus')
            $(this).find('i').addClass('fas fa-plus')

            }

        });



    $('#addEventoHistorico').click(function(){
       $('#formAddArquivo').toggle('fast');
       $("#textAddEventoHistorico").text(($("#textAddEventoHistorico").text() == 'Inserir evento no histórico') ? 'Cancelar Inserção' : 'Inserir evento no histórico');

        // procura a a primeira tag i que contenha a class
        if( $(this).find('i').hasClass('fas fa-plus-circle')){
            $(this).find('i').removeClass('fas fa-plus-circle')
            $(this).find('i').addClass('fas fa-minus-circle')
        }
        else{
            $(this).find('i').removeClass('fas fa-minus-circle')
            $(this).find('i').addClass('fas fa-plus-circle')
        }

    });

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
        if(opcaoSelecionada == "Licenças")
        {
            $('#divTipoLicenca').show('fast');
        } else {
            $('#divTipoLicenca').hide('fast');
        }
        if (opcaoSelecionada == "Atestado" || opcaoSelecionada == "Afastamento" || opcaoSelecionada == "Concessões" || opcaoSelecionada == "Férias" || opcaoSelecionada == "Licenças" || opcaoSelecionada == "Outros" || opcaoSelecionada == "Penalidades") {
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

    $('#selectFiltros').change(function(){
        $('#formFiltro').submit();
    });


    $(".docModal").click(function () {

        var url = document.URL;
        var arr = url.split('/')[0];
        var newUrl = url.split('/')[0] + '/' + url.split('/')[1] + '/' + url.split('/')[2] + '/' + url.split('/')[3] + '/historico-view';

        $('#modalIframe').modal('toggle')

        var idDocumento = $(this).attr('id')

        $("#iframeTest").attr('src', newUrl + '/' + idDocumento);


    })


});
