<link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
<link rel="stylesheet" href="{{ asset("css/bootadmin.min.css") }}">

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.j') }}s"></script>
<script src="{{ asset('js/bootadmin.min.js') }}"></script>

<script type="text/javascript">


    function sayHello() {

        return $("#matHidden").val();
    }


$(document).ready(function(){

    $(document).on('click', '#buttonMat', function(){

        // pega o data-content do botao
        $("#matHidden").val($(this).attr('data-content'));

        // depois que selecionar o servidor, fecha o modal | funcao inserida no parent que chama o iframe
        window.parent.closeModal();
    })


})

</script>


<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Lotação</th>
        <th scope="col">Selecionar</th>
    </tr>
    </thead>
    <tbody>
    <input type="hidden" value="" id="matHidden">
        @foreach(($dados) as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item['nome'] }}</td>
            <td>{{ $item['matricula'] }} </td>
            <td id="matricula{{ $loop->iteration }}">
                <button class="btn btn-primary" id="buttonMat" data-content="{{ $item['matricula'] }}" onclick="sayHello()" title="">
                    Selecionar
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>