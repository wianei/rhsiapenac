$(document).ready(function(){

    $('#btAddArquivo').click(function(){

        $("#formAddArquivo").toggle("fast")
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

   // $(document).on("click", ".docModal", function () {
    $(".docModal").click(function () {

        var url = document.URL;
        var arr = url.split('/')[0];
        var newUrl = url.split('/')[0] + '/' + url.split('/')[1] + '/' + url.split('/')[2] + '/' + url.split('/')[3] + '/documento-view';

        $('#modalIframe').modal('toggle');

        var idDocumento = $(this).attr('id');
        $("#iframeTest").attr('src', newUrl + '/' + idDocumento);

    });



});