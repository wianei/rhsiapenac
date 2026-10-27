$(document).ready(function() {

    $('#btPrint').click(function(){
        window.print();
    });

    $('#btBack').on('click', function (e) {
        e.preventDefault();
        window.history.back();
    });
    
});