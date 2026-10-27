<link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
<link rel="stylesheet" href="{{ asset("css/bootadmin.min.css") }}">

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.j') }}s"></script>
<script src="{{ asset('js/bootadmin.min.js') }}"></script>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Servidores</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <input type="hidden" value="123" id="matHidden">
    @foreach(json_decode($dados, true) as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item['nome'] }}</td>
            <td><a href="{{  route('servidor.dadosFuncionais', $item['id']) }}" target="_parent" class="btn btn-primary" title="Ver dados do Servidor"> Visualizar dados</a></td>
        </tr>
    @endforeach
    </tbody>
</table>