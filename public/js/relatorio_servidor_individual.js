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

    $('#btPrint').click(function(){
        window.print();
    });


    $('#filtroIcon').click(function(){
        $("#divformFiltro").toggle("fast");
        if( $(this).hasClass('fa-sort-down') ){

            $(this).removeClass('fa-sort-down');
            $(this).addClass('fa-sort-asc')

        }else{
            $(this).removeClass('fa-sort-asc');
            $(this).addClass('fa-sort-down')
        }
    })

    $('#data_inicio, #data_final').mask('00/00/0000');

    switch (url[5]){
        case "atestado":
            $("#menuRelAtestados").addClass('alert-info');
            break;
        case "afastamento":
            $("#menuRelAfastamentos").addClass('alert-info');
            break;
        case "concessoes":
            $("#menuRelConcessoes").addClass('alert-info');
            break;
        case "elogios":
            $("#menuRelElogios").addClass('alert-info');
            break;
        case "ferias":
            $("#menuRelFerias").addClass('alert-info');
            break;
        case "licencas":
            $("#menuRelLicencas").addClass('alert-info');
            break;
        case "penalidades":
            $("#menuRelPenalidades").addClass('alert-info');
            break;
        case "remocoes":
            $("#menuRelRemocoes").addClass('alert-info');
            break;
        case "redistribuicoes":
            $("#menuRelRedistribuicoes").addClass('alert-info');
            break;
        case "substituicoes":
            $("#menuRelSubstituicoes").addClass('alert-info');
            break;
        case "vacancias":
            $("#menuRelVacancias").addClass('alert-info');
            break;
    }

    $('#btBack').on('click', function (e) {
        e.preventDefault();
        window.history.back();
    });


});