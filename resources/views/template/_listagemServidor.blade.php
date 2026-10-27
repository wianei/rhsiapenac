@if(!empty($dados))

    <div id="divListaServidores">
    <table class="table table-striped" id="tableListaServidores">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Lotação</th>
            <th scope="col">Matrícula</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>

        <tbody id="printDados">
        @foreach($dados as $d)
            <tr>
                <th class="w-50">{{ $d->nome }}</th>
                <td>{{ $d->lotacao }}</td>
                <td>{{ $d->matricula }}</td>
                <td>
                    <a href="#" class="bt-ver" title="Ver dados"><i class="fa fa-sign-in"></i></a>

                    <a href="#" class="bt-editar" title="Editar"><i class="fa fa-pencil"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>

@endif
