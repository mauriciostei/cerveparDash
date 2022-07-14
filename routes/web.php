<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Alertas\AlertasForm;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Choferes\ChoferesForm;
use App\Http\Livewire\Choferes\ChoferesList;
use App\Http\Livewire\Dashboards\ControlMoviles;
use App\Http\Livewire\Dashboards\Inicio;
use App\Http\Livewire\Dashboards\Metricas;
use App\Http\Livewire\Moviles\MovilesForm;
use App\Http\Livewire\Moviles\MovilesList;
use App\Http\Livewire\Perfiles\PerfilesForm;
use App\Http\Livewire\Perfiles\PerfilesList;
use App\Http\Livewire\Planes\PlanesForm;
use App\Http\Livewire\Planes\PlanesList;
use App\Http\Livewire\Problemas\ProblemasForm;
use App\Http\Livewire\Problemas\ProblemasList;
use App\Http\Livewire\Puntos\PuntosForm;
use App\Http\Livewire\Puntos\PuntosList;
use App\Http\Livewire\Sensores\SensoresForm;
use App\Http\Livewire\Sensores\SensoresList;
use App\Http\Livewire\Soluciones\SolucionesForm;
use App\Http\Livewire\Soluciones\SolucionesList;
use App\Http\Livewire\Tiers\TiersForm;
use App\Http\Livewire\Tiers\TiersList;
use App\Http\Livewire\Tiers\TierViajeForm;
use App\Http\Livewire\Usuarios\UsuariosForm;
use App\Http\Livewire\Usuarios\UsuariosList;
use App\Http\Livewire\Usuarios\UsuariosMiCuenta;

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

Route::get('/', function(){
    return redirect('sign-in');
});

Route::get('sign-in', Login::class)->middleware('guest')->name('login');

Route::group(['middleware' => 'auth'], function () {

    Route::get('inicio', Inicio::class)->name('inicio');
    Route::get('metricas', Metricas::class)->name('metricas');
    Route::get('controlMoviles', ControlMoviles::class)->name('controlMoviles');

    Route::get('usuarios', UsuariosList::class)->name('usuariosList');
    Route::get('usuarios/{id}', UsuariosForm::class)->name('usuariosForm');
    Route::get('MiCuenta', UsuariosMiCuenta::class)->name('usuariosMiCuenta');

    Route::get('perfiles', PerfilesList::class)->name('perfilesList');
    Route::get('perfiles/{id}', PerfilesForm::class)->name('perfilesForm');

    Route::get('choferes', ChoferesList::class)->name('choferesList');
    Route::get('choferes/{id}', ChoferesForm::class)->name('choferesForm');

    Route::get('moviles', MovilesList::class)->name('movilesList');
    Route::get('moviles/{id}', MovilesForm::class)->name('movilesForm');

    Route::get('problemas', ProblemasList::class)->name('problemasList');
    Route::get('problemas/{id}', ProblemasForm::class)->name('problemasForm');

    Route::get('soluciones', SolucionesList::class)->name('solucionesList');
    Route::get('soluciones/{id}', SolucionesForm::class)->name('solucionesForm');

    Route::get('sensores', SensoresList::class)->name('sensoresList');
    Route::get('sensores/{id}', SensoresForm::class)->name('sensoresForm');

    Route::get('puntos', PuntosList::class)->name('puntosList');
    Route::get('puntos/{id}', PuntosForm::class)->name('puntosForm');

    Route::get('planes', PlanesList::class)->name('planesList');
    Route::get('planes/{id}', PlanesForm::class)->name('planesForm');

    Route::get('tiers', TiersList::class)->name('tiersList');
    Route::get('tiers/{id}', TiersForm::class)->name('tiersForm');
    Route::get('tiers/{id}/{viaje}', TierViajeForm::class)->name('tiersViajeForm');

    Route::get('alertas/{id}', AlertasForm::class)->name('alertasForm');
});