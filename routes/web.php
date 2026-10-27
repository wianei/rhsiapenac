<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::any('passwordreset', 'Auth\ResetPasswordController@alterarSenha')->name('alterar.senha');
Route::any('alterarSenha/store', 'Auth\LoginController@alterarSenhaStore')->name('alterarSenha.store');

// home do sistema
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

// Sair do sistema
Route::get('/logout','Auth\LoginController@logout')->name('logout');

// formulario de cadastro
Route::get('/servidor/cadastro', 'ServidorController@create')->name('servidor_cadastro');

// faz o cadastro do servidor no BD
Route::post('/servidor/cadastro/store', 'ServidorController@store')->name('servidor_cadastro.store');

/**
 * rotas iframe
 */
Route::any('/lotacao/pesquisa-servidor-iframe/{id?}', 'LotacaoController@iframeServidoresLotacao')->name('lotacao.pesquisaServidorIframe');

/**
 * dados do servidor | financeiro | lotacao | pessoais
 */
Route::any('/servidor/dados-funcionais/{id}', 'ServidorController@dadosFuncionais')->name('servidor.dadosFuncionais');
Route::any('/servidor/dados-pessoais/{id}', 'ServidorController@dadosPessoais')->name('servidor.dadosPessoais');
Route::any('/servidor/dados-financeiros/{id}', 'ServidorController@dadosFinanceiros')->name('servidor.dadosFinanceiros');

/**
 * relatorio de servidor | atestado | afastamento | concessoes...
 */
Route::any('/servidor/historico-print/{id}', 'ServidorController@historicoPrint')->name('historico_print');
Route::any('/servidor/relatorios/atestado/{id}', 'ServidorController@relAtestado')->name('servidor.relatorios.atestado');
Route::any('/servidor/relatorios/afastamento/{id}', 'ServidorController@relAfastamento')->name('servidor.relatorios.afastamento');
Route::any('/servidor/relatorios/concessoes/{id}', 'ServidorController@relConcessoes')->name('servidor.relatorios.concessoes');
Route::any('/servidor/relatorios/elogios/{id}', 'ServidorController@relElogios')->name('servidor.relatorios.elogios');
Route::any('/servidor/relatorios/ferias/{id}', 'ServidorController@relFerias')->name('servidor.relatorios.ferias');
Route::any('/servidor/relatorios/licencas/{id}', 'ServidorController@relLicencas')->name('servidor.relatorios.licencas');
Route::any('/servidor/relatorios/penalidades/{id}', 'ServidorController@relPenalidades')->name('servidor.relatorios.penalidades');
Route::any('/servidor/relatorios/remocoes/{id}', 'ServidorController@relRemocoes')->name('servidor.relatorios.remocoes');
Route::any('/servidor/relatorios/redistribuicoes/{id}', 'ServidorController@relRedistribuicoes')->name('servidor.relatorios.redistribuicoes');
Route::any('/servidor/relatorios/substituicoes/{id}', 'ServidorController@relSubstituicoes')->name('servidor.relatorios.substituicoes');
Route::any('/servidor/relatorios/vacancias/{id}', 'ServidorController@relVacancias')->name('servidor.relatorios.vacancias');


// view de pesquisa
Route::any('/servidor/pesquisa', 'ServidorController@pesquisa')->name('servidor.pesquisa');

Route::get('/servidor/pesquisa-iframe', 'ServidorController@pesquisaIframe')->name('servidor.pesquisaIframe');

Route::post('/servidor/pesquisa-iframe-resultado', 'ServidorController@pesquisaIframeResultado')->name('servidor.pesquisaIframeResultado');

// detalhes do servidor
Route::get('/servidor/show/{id}', 'ServidorController@show')->name('servidor.show');

// imprime a funcional
Route::get('/servidor/funcional/{id}', 'ServidorController@funcional')->name('servidor.funcional');

// mostra o historico
Route::any('/servidor/historico/{id}', 'ServidorController@historico')->name('servidor.historico');

// posta o historico
Route::any('/servidor/historico-store/{id}', 'ServidorController@historicoStore')->name('servidor.historicoStore');

// visualiza o arquivo do historico
Route::get('/servidor/historico-view/{id?}/{id_servidor?}', 'ServidorController@historicoView')->name('servidor.historicoView');

// edita o evento do historico
Route::any('/servidor/historico-update/{id?}', 'ServidorController@historicoUpdate')->name('servidor.historicoUpdate');

// edita o evento do historico
Route::get('/servidor/historico-edit/{id?}', 'ServidorController@historicoEdit')->name('servidor.historicoEdit');

// revoga um evento
Route::get('/servidor/historico-revogar/{id?}/{id_servidor?}', 'ServidorController@historicoRevogar')->name('servidor.historicoRevogar');

// apaga o arquivo
Route::get('/servidor/historico-delete-file/{id?}/{id_historico?}/{id_servidor?}', 'ServidorController@historicoDeleteFile')->name('servidor.historicoDeleteFile');

// log
Route::get('/servidor/log/{id}', 'ServidorController@logEdit')->name('servidor.logEdit');

Route::get('/servidor/documentos/{id}', 'ServidorController@documentos')->name('servidor.documentos');

Route::any('/servidor/documentos-store/{id?}', 'ServidorController@documentosStore')->name('servidor.documentosStore');

Route::any('/servidor/documento-view/{id?}', 'ServidorController@documentosView')->name('servidor.documentosView');

Route::get('/servidor/documento-delete/{id?}', 'ServidorController@documentosDelete')->name('servidor.documentosDelete');

Route::get('/servidor/editar/{id}', 'ServidorController@edit')->name('servidor.editar');

// faz a atualização dos dados no BD
Route::post('/servidor/update', 'ServidorController@update')->name('servidor_cadastro.update');

/**
 * Rotas para ajax
 */
// define a rota para pesquisa dos servidores
Route::any('servidor/servidor-pesquisa-ajax', 'ServidorController@search')->name('servidor_pesquisa_ajax');
// rota para pesquisa dos municipios
Route::post('municipios/pesquisa-ajax', 'MunicipiosController@getMunicipio')->name('municipio_pesquisa_ajax');

// -----------------------------------------

/**
 * rota dos relatorios
 */

Route::any('/relatorio/atestado/{id?}', 'RelatorioController@relatorio')->name('relatorio.relatorio');

Route::any('/relatorio/pesquisa/{id?}', 'RelatorioController@pesquisar')->name('relatorio.pesquisar');

Route::any('/relatorio/afastamento/{id?}', 'RelatorioController@afastamento')->name('relatorio.afastamento');
Route::any('/relatorio/afastamento/pesquisar/{id?}', 'RelatorioController@afastamentoPesquisar')->name('relatorio.afastamento.pesquisar');

Route::any('/relatorio/concessoes/{id?}', 'RelatorioController@concessoes')->name('relatorio.concessoes');
Route::any('/relatorio/concessoes/pesquisar/{id?}', 'RelatorioController@concessoesPesquisar')->name('relatorio.concessoes.pesquisar');

Route::any('/relatorio/ferias/{id?}', 'RelatorioController@ferias')->name('relatorio.ferias');
Route::any('/relatorio/ferias/pesquisar/{id?}', 'RelatorioController@feriasPesquisar')->name('relatorio.ferias.pesquisar');

Route::any('/relatorio/licencas/{id?}', 'RelatorioController@licencas')->name('relatorio.licencas');
Route::any('/relatorio/licencas/pesquisar/{id?}', 'RelatorioController@licencasPesquisar')->name('relatorio.licencas.pesquisar');

Route::any('/relatorio/penalidades/{id?}', 'RelatorioController@penalidades')->name('relatorio.penalidades');
Route::any('/relatorio/penalidades/pesquisar/{id?}', 'RelatorioController@penalidadesPesquisar')->name('relatorio.penalidades.pesquisar');

Route::any('/relatorio/remocoes/{id?}', 'RelatorioController@remocoes')->name('relatorio.remocoes');
Route::any('/relatorio/remocoes/pesquisar/{id?}', 'RelatorioController@remocoesPesquisar')->name('relatorio.remocoes.pesquisar');

Route::any('/relatorio/redistribuicoes/{id?}', 'RelatorioController@redistribuicoes')->name('relatorio.redistribuicoes');
Route::any('/relatorio/redistribuicoes/pesquisar/{id?}', 'RelatorioController@redistribuicoesPesquisar')->name('relatorio.redistribuicoes.pesquisar');

Route::any('/relatorio/servidor/{id?}', 'RelatorioController@servidor')->name('relatorio.servidor');
Route::any('/relatorio/servidor/pesquisar/{id?}', 'RelatorioController@servidorPesquisar')->name('relatorio.servidor.pesquisar');

Route::any('/relatorio/substituicoes/{id?}', 'RelatorioController@substituicoes')->name('relatorio.substituicoes');
Route::any('/relatorio/substituicoes/pesquisar/{id?}', 'RelatorioController@substituicoesPesquisar')->name('relatorio.substituicoes.pesquisar');

Route::any('/relatorio/vacancias/{id?}', 'RelatorioController@vacancias')->name('relatorio.vacancias');
Route::any('/relatorio/vacancias/pesquisar/{id?}', 'RelatorioController@vacanciasPesquisar')->name('relatorio.vacancias.pesquisar');

Route::any('/relatorio/elogio/{id?}', 'RelatorioController@elogio')->name('relatorio.elogio');
Route::any('/relatorio/elogio/pesquisar/{id?}', 'RelatorioController@elogioPesquisar')->name('relatorio.elogio.pesquisar');


Route::any('/relatorio/comissionados', 'RelatorioController@comissionados')->name('relatorio.comissionados');

/**
 * rota para pegar as imagens do servidor
 */
Route::get('storage/app/arquivos/servidores/{id}/foto/{filename}', function ($id, $filename)
{
    $path = storage_path('app/arquivos/servidores/' . $id . '/foto/' . $filename);

    if (!File::exists($path)) {
        $path = storage_path('app/arquivos/servidores/avatarInterno.png');
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;

})->middleware('auth');

Route::any('/webservice/fotos-servidores/{key}/{cpfUser}', 'ServidorController@webServiceFotosServidor')->name('servidor.webServiceFotosServidor');