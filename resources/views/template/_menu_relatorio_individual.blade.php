<ul class="ulMenuDados mt-5" id="ulMenuDados">
    <a href="{{ route('servidor.relatorios.atestado',$id) }}">
        <li class="liMenuShow" id="menuRelAtestados">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">ATESTADOS</div>
        </li>
    </a>
    <a href="{{ route('servidor.relatorios.afastamento',$id) }}">
        <li class="liMenuShow" id="menuRelAfastamentos">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">AFASTAMENTOS</div>
        </li>
    </a>
    <a href="{{ route('servidor.relatorios.concessoes', $id) }}">
        <li class="liMenuShow" id="menuRelConcessoes">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">CONCESSÕES</div>
        </li>
    </a>

    <a href="{{ route('servidor.relatorios.elogios', $id) }}">
        <li class="liMenuShow" id="menuRelElogios">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">ELOGIOS</div>
        </li>
    </a>

    <a href="{{ route('servidor.relatorios.ferias', $id) }}">
        <li class="liMenuShow" id="menuRelFerias">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">FÉRIAS</div>
        </li>
    </a>

    <a href="{{ route('servidor.relatorios.licencas', $id) }}">
        <li class="liMenuShow" id="menuRelLicencas">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">LICENÇAS</div>
        </li>
    </a>

    <a href="{{ route('servidor.relatorios.penalidades', $id) }}">
        <li class="liMenuShow" id="menuRelPenalidades">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">PENALIDADES</div>
        </li>
    </a>

    <a href="{{ route('servidor.relatorios.remocoes', $id) }}">
        <li class="liMenuShow" id="menuRelRemocoes">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">REMOÇÕES</div>
        </li>
    </a>

    <a href="{{ route('servidor.relatorios.redistribuicoes', $id) }}">
        <li class="liMenuShow" id="menuRelRedistribuicoes">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">REDISTRIBUIÇÕES</div>
        </li>
    </a>

    <a href="{{ route('servidor.relatorios.substituicoes', $id) }}">
        <li class="liMenuShow" id="menuRelSubstituicoes">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">SUBSTITUIÇÕES</div>
        </li>
    </a>

    <a href="{{ route('servidor.relatorios.vacancias', $id) }}">
        <li class="liMenuShow" id="menuRelVacancias">
                <i class="fas fa-chart-area"></i> <div class="fontSize05em">VACÂNCIAS</div>
        </li>
    </a>
</ul>
