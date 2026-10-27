$(document).ready(function () {

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    $("#btnFiliacao").click(function(){
        $("#divFiliacao").toggle('fast')
        $(this).toggleClass('alert-info')
    });

    $("#btnEndereco").click(function(){
        $("#divEndereco").toggle('fast')
        $(this).toggleClass('alert-info')
    });

    $("#btnDadosPessoais").click(function(){
        $("#divDadosPessoais").toggle('fast')
        $(this).toggleClass('alert-info')
    });

    $("#btnContatos").click(function(){
        $("#divContato").toggle('fast')
        $(this).toggleClass('alert-info')
    });

    $("#btnDadosLotacao").click(function(){
        $("#divDadosLotacao").toggle('fast')
        $(this).toggleClass('alert-info')
    });

    $("#btnInstrucao").click(function(){
        $("#divInstrucao").toggle('fast')
        $(this).toggleClass('alert-info')
    });

    $("#btnDadosFinanceiros").click(function(){
        $("#divDadosFinanceiros").toggle('fast')
        $(this).toggleClass('alert-info')
    });

    $("#btnDependentes").click(function(){
        $("#divDependentes").toggle('fast')
        $(this).toggleClass('alert-info')
    });

    $("#btnConjuge").click(function(){
        $("#divConjuge").toggle('fast')
        $(this).toggleClass('alert-info')
    });

});