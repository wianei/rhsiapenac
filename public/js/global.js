var url_iframePesquisa = "http://localhost:8000/servidor/pesquisa-iframe"
var url = window.location.href.split('/')

$(document).ready(function(){

    /**
     * config menu servidor active
     */
    var url = window.location.href.split('/')
    switch (url[4]){
        case "dados-funcionais":
            $("#linkMenuDFuncionais").addClass('active');
            break;
        case "dados-pessoais":
            $("#linkMenuDPessoais").addClass('active');
            break;
        case "dados-financeiros":
            $("#linkMenuDFinanceiros").addClass('active');
            break;
        case "documentos":
            $("#linkMenuDocumentos").addClass('active');
            break;
        case "historico":
            $("#linkMenuHistorico").addClass('active');
            break;
        case "relatorios":
            $("#linkMenuRelatorios").addClass('active');
            break;
        case "log":
            $("#linkMenuLog").addClass('active');
            break;
    }




})