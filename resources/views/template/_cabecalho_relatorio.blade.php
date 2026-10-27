<div class="w-100 mb-4" id="cabecalhoRelatorio">
    <div class="row">
        <div class="col-sm-2 text-right">
            <img src="{{ asset("images/logo_estado.png") }}" height="70" alt="Logo estado AC">
        </div>
        <div class="col-sm-8 text-center">
            <h4>GOVERNO DO ESTADO DO ACRE</h4>
            <h5>Instituto de Administração Penitenciária do Estado do Acre - IAPEN</h5>
            <h6>Relatório de {{$menuNome}} - {{ $dataRelatorio }}</h6>
        </div>
        <div class="col-sm-2 align-text-bottom">
            <div class="float-left mt-5">Impresso por {{Auth::user()->matricula}}</div>
        </div>
    </div>
</div>
