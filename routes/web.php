<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Alertas\AlertasForm;
use App\Http\Livewire\Alertas\AlertasTma;
use App\Http\Livewire\Aprobaciones\Procesar;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Ayudantes\AyudantesForm;
use App\Http\Livewire\Ayudantes\AyudantesList;
use App\Http\Livewire\Causas\CausasForm;
use App\Http\Livewire\Causas\CausasList;
use App\Http\Livewire\Causas\CausasRaizForm;
use App\Http\Livewire\Choferes\ChoferesForm;
use App\Http\Livewire\Choferes\ChoferesList;
use App\Http\Livewire\Dashboards\AlertasTMA as DashboardsAlertasTMA;
use App\Http\Livewire\Dashboards\ControlPuntos;
use App\Http\Livewire\Dashboards\Inicio;
use App\Http\Livewire\Dashboards\Jornada;
use App\Http\Livewire\Dashboards\MetricaAlertas;
use App\Http\Livewire\Dashboards\Metricas;
use App\Http\Livewire\Dashboards\Status;
use App\Http\Livewire\Moviles\MovilesForm;
use App\Http\Livewire\Moviles\MovilesList;
use App\Http\Livewire\Operadoras\OperadorasForm;
use App\Http\Livewire\Operadoras\OperadorasList;
use App\Http\Livewire\Perfiles\PerfilesForm;
use App\Http\Livewire\Perfiles\PerfilesList;
use App\Http\Livewire\Planes\PlanesForm;
use App\Http\Livewire\Planes\PlanesList;
use App\Http\Livewire\Problemas\ProblemasForm;
use App\Http\Livewire\Problemas\ProblemasList;
use App\Http\Livewire\Puntos\PuntosForm;
use App\Http\Livewire\Puntos\PuntosList;
use App\Http\Livewire\Recorridos\Cambios;
use App\Http\Livewire\Sensores\SensoresForm;
use App\Http\Livewire\Sensores\SensoresList;
use App\Http\Livewire\Soluciones\SolucionesForm;
use App\Http\Livewire\Soluciones\SolucionesList;
use App\Http\Livewire\Tiers\TiersForm;
use App\Http\Livewire\Tiers\TiersList;
use App\Http\Livewire\Usuarios\UsuariosForm;
use App\Http\Livewire\Usuarios\UsuariosList;
use App\Http\Livewire\Usuarios\UsuariosMiCuenta;
use App\Http\Livewire\Dashboards\ControlPuntosT1;
use App\Http\Livewire\Limites\LimitesList;
use App\Http\Livewire\Tiers\ViajeForm;

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

Route::get('/', function(){ return redirect()->route('inicio'); });
Route::get('sign-in', Login::class)->middleware('guest')->name('login');

Route::middleware('auth','web')->group(function(){

    Route::get('controlPuntosT1', ControlPuntosT1::class)->name('controlPuntosT1');
    
    Route::get('inicio', Inicio::class)->name('inicio')->can('inicio');
    Route::get('metricas', Metricas::class)->name('metricas')->can('metricas');
    Route::get('controlMoviles', Status::class)->name('controlMoviles')->can('controlMoviles');
    Route::get('metricaAlertas', MetricaAlertas::class)->name('metricaAlertas')->can('metricaAlertas');
    Route::get('jornada', Jornada::class)->name('jornada')->can('jornada');
    Route::get('jornada-oviedo', Jornada::class)->name('jornada-oviedo');
    Route::get('jornadaT1', Jornada::class)->name('jornadaT1')->can('jornadaT1');
    Route::get('controlPuntos', ControlPuntos::class)->name('controlPuntos')->can('controlPuntos');
    Route::get('alertasTMA', DashboardsAlertasTMA::class)->name('alertasTMA')->can('alertasTMA');

    Route::get('cambioRecorrido', Cambios::class)->name('cambiosRecorridos')->can('cambiosRecorridos');
    Route::get('ProcesarAprobacion/{id}', Procesar::class)->name('ProcesarAprobacion');

    Route::get('usuarios', UsuariosList::class)->name('usuariosList')->can('viewAny', \App\Models\User::class);
    Route::get('usuarios/{id}', UsuariosForm::class)->name('usuariosForm');
    Route::get('MiCuenta', UsuariosMiCuenta::class)->name('usuariosMiCuenta');

    Route::get('perfiles', PerfilesList::class)->name('perfilesList')->can('viewAny', \App\Models\Perfiles::class);
    Route::get('perfiles/{id}', PerfilesForm::class)->name('perfilesForm');

    Route::get('operadora', OperadorasList::class)->name('operadorasList')->can('viewAny', \App\Models\Operadoras::class);
    Route::get('operadora/{id}', OperadorasForm::class)->name('operadorasForm');

    Route::get('choferes', ChoferesList::class)->name('choferesList')->can('viewAny', \App\Models\Choferes::class);
    Route::get('choferes/{id}', ChoferesForm::class)->name('choferesForm');

    Route::get('moviles', MovilesList::class)->name('movilesList')->can('viewAny', \App\Models\Moviles::class);
    Route::get('moviles/{id}', MovilesForm::class)->name('movilesForm');

    Route::get('problemas', ProblemasList::class)->name('problemasList')->can('viewAny', \App\Models\Problemas::class);
    Route::get('problemas/{id}', ProblemasForm::class)->name('problemasForm');

    Route::get('soluciones', SolucionesList::class)->name('solucionesList')->can('viewAny', \App\Models\Soluciones::class);
    Route::get('soluciones/{id}', SolucionesForm::class)->name('solucionesForm');

    Route::get('causas', CausasList::class)->name('causasList')->can('viewAny', \App\Models\Causas::class);
    Route::get('causas/{id}', CausasForm::class)->name('causasForm');
    Route::get('causasRaiz/{id}', CausasRaizForm::class)->name('causasRaizForm');

    Route::get('sensores', SensoresList::class)->name('sensoresList')->can('viewAny', \App\Models\Sensores::class);
    Route::get('sensores/{id}', SensoresForm::class)->name('sensoresForm');

    Route::get('puntos', PuntosList::class)->name('puntosList')->can('viewAny', \App\Models\Puntos::class);
    Route::get('puntos/{id}', PuntosForm::class)->name('puntosForm');

    Route::get('ayudantes', AyudantesList::class)->name('ayudantesList')->can('viewAny', \App\Models\Ayudantes::class);
    Route::get('ayudantes/{id}', AyudantesForm::class)->name('ayudantesForm');

    Route::get('planes', PlanesList::class)->name('planesList')->can('viewAny', \App\Models\Planes::class);
    Route::get('planes/{id}', PlanesForm::class)->name('planesForm');

    Route::get('tiers', TiersList::class)->name('tiersList')->can('viewAny', \App\Models\Tiers::class);
    Route::get('tiers/{id}', TiersForm::class)->name('tiersForm');
    Route::get('tiers/{tier}/viaje', ViajeForm::class)->name('viajeForm');

    Route::get('alertas/{id}', AlertasForm::class)->name('alertasForm');
    Route::get('alertas/{alerta}/tma', AlertasTma::class)->name('alertasTma');

    Route::get('limites', LimitesList::class)->name('limitesList')->can('viewAny', \App\Models\Limites::class);
});