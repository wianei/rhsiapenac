@extends('theme.theme')

@section('content')
    <h1 class="tituloSeccao"><i class="	fa fa-search"></i> Pesquisar Servidor</h1>

    @include('template._filtro')


    @if($dados != false)

        <div id="links">
            {{ $dados->links() }}
        </div>

        @if($dados->total() > 0)
            <h5 class="mt-5"><i>Sua busca retornou
                    {{ $dados->total() }} resultados
                </i>
            </h5>

        @else

            <h5 class="mt-5"><i>Sua busca não obteve resultados! </i>
            </h5>

        @endif




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
                        <td>{{ $d->sigla }}</td>
                        <td>{{ $d->matricula }}</td>
                        <td>
                            <a href="{{ route('servidor.dadosFuncionais',$d->id) }}" class="bt-ver" title="Ver dados"><i class="fa fa-search"></i></a>

                            <a href="{{ route('servidor.editar',$d->id) }}" class="bt-editar" title="Editar"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <div id="links">
            {{ $dados->links() }}
        </div>


        @else

    @endif


    <nav aria-label="Page navigation example">
        <ul class="pagination" id="ulPaginate">

        </ul>
    </nav>
@endsection
@push('css')
<link href="{{ asset('css/utilities/utilities.css') }}" rel="stylesheet">
<link href="{{ asset('css/pesquisar.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('js/pesquisar.js') }}"></script>
<script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
@endpush