$(document).ready(function(){

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

    $('#cursos').multiselect({
        maxHeight: 250,
        buttonWidth: '250px'
    });

    $("#pesAvancada").click(function () {
        $("#divPesAvancada").toggleClass('dContents')
    })

    //$( document ).on( "click", ".buscaAjax", function() {
    //
    //
    //    var nomePost        = $("#nome").val();
    //    var matriculaPost   = $("#matricula").val();
    //    var lotacaoPost     = $("#lotacao").val();
    //    var sexoPost         = $("#sexo").val();
    //    var skipPost        = $("#skip").val();
    //
    //
    //    $.ajaxSetup({
    //        headers: {
    //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //        }
    //    });
    //
    //    $.ajax({
    //        type: "POST",
    //        url: "servidor-pesquisa-ajax",
    //        data: {nome: nomePost, matricula: matriculaPost, lotacao: lotacaoPost, skip: skipPost, sexo: sexoPost, pagina: $(this).attr('id')},
    //        beforeSend: function() {
    //            $("#aro").html("<option selected='selected'>Carregando dados...</option>");
    //        },
    //        success: function (dados) {
    //
    //            // apaga os dados da tabela
    //            $("#ulPaginate").html('');
    //            $("#printDados").html('');
    //            $("#divListaServidores").show('fast');
    //
    //            var objt = jQuery.parseJSON(dados);
    //
    //            // armazena os dados dos servidores
    //            var servidores = (objt.dadosServidores);
    //
    //            // dados que vão ser pulados
    //            var skip = (objt.retornoSkip);
    //            $("#skip").val(skip);
    //
    //            // quantidade de dados retornados
    //            var qtdServidores = servidores.length;
    //
    //            // quantidade de paginas
    //            var qtdPaginas = (objt.paginas)
    //
    //            // percorre os dados retornados
    //            for(var x=0;x<qtdServidores;x++) {
    //
    //                $("#printDados").append("<tr>"+
    //                    "<th class='w-50'>"+servidores[x].nome+"</th>"+
    //                    "<td>"+servidores[x].lotacao+"</td><td>"+servidores[x].matricula+"</td>"+
    //                        "<td>"+
    //                            "<a href='dados-funcionais/"+servidores[x].id+"' class='bt-ver' title='Ver dados'><i class='fa fa-search'></i></a> "+
    //                            "<a href='editar/"+servidores[x].id+"' class='bt-editar' title='Editar'><i class='fa fa-pencil'></i></a> "+
    //                            "<a href='funcional/"+servidores[x].id+"' class='bt-funcional' title='Imprimir Funcional'><i class='fas fa-address-card'></i></a>"+
    //                        "</td>"+
    //                    "</tr>")
    //
    //            };
    //
    //            for(var x=0;x<qtdPaginas;x++) {
    //
    //                var pagina = parseInt(x)+ parseInt(1);
    //
    //                $("#ulPaginate").append("<li class='page-item'><span class='page-link link buscaAjax' id='pagina_"+pagina+"'>"+ pagina +"</span></li>")
    //
    //            };
    //
    //        }
    //    });
    //
    //});

});
