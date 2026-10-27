$(document).ready(function () {

    $('.displayDados').css('display','none');


    $(".aIframe").click(function(){

	var idLotacao = $(this).attr('id');
        var idParam = $("#iframeTest").attr('src').split('/')

	var url = ($(location).attr('href')).replace('home','');

        $("#iframeTest").attr('src',url+'/lotacao/pesquisa-servidor-iframe/'+idLotacao);
        

    });

    // fechar o modal
    $("#mymodal").on("hidden.bs.modal", function (e) {

    });

    $('.liMenuShow').click(function(){
        var idLiMenu = $(this).attr('id');
        var divDados = "";

        switch (idLiMenu){
            case "btnDerGa":
                divDados = "coordDerGa";
                break;
            case "btnDerLi":
                divDados = "coordDerLi";
                break
            case "btnDerRs":
                divDados = "coordDerRs";
                break
            case "btnDerSep":
                divDados = "coordDerSep";
                break
            case "btnGabinete":
                divDados = "coordGabinete";
                break
        }


        $('.liMenuShow').removeClass('alert-info');
        $(this).toggleClass('alert-info');
        $('.displayDados').css('display','none');
        $('#'+divDados).css('display','flex');
    });
})
