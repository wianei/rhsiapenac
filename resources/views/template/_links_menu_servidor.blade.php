<div class="divNavLinks">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" id="linkMenuDFuncionais" href="{{ route('servidor.dadosFuncionais', json_decode($dadosView)->id) }}"><i class="fa fa-institution"></i> Dados Funcionais</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="linkMenuDPessoais" href="{{ route('servidor.dadosPessoais', json_decode($dadosView)->id) }}"><i class="fa fa-user"></i> Dados Pessoais</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="linkMenuDFinanceiros" href="{{ route('servidor.dadosFinanceiros', json_decode($dadosView)->id) }}"><i class="fa fa-money"></i> Dados Financeiros</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="linkMenuDocumentos" href="{{  route('servidor.documentos', json_decode($dadosView)->id) }}"><i class="fas fa-file-alt"></i> Documentos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="linkMenuHistorico" href="{{  route('servidor.historico', json_decode($dadosView)->id) }}"><i class="fas fa-file-alt"></i> Histórico</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="linkMenuRelatorios" href="{{ route('servidor.relatorios.atestado', json_decode($dadosView)->id) }}"><i class="fas fa-chart-area"></i> Relatórios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="linkMenuLog" href="{{  route('servidor.logEdit', json_decode($dadosView)->id) }}"><i class="fas fa-chart-bar"></i> Log</a>
        </li>
    </ul>
</div>
