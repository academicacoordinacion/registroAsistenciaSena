<?php

use App\Http\Controllers\AmbienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BloqueController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EntradaSalidaController;
use App\Http\Controllers\FichaCaracterizacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\http\Controllers\LoginController;
use App\http\Controllers\LogoutController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\SedeController;
use App\Models\Ambiente;
use App\Models\Bloque;
use App\Models\EntradaSalida;
use App\Models\FichaCaracterizacion;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\TemaController;
use App\Http\Middleware\CorsMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/apis', function () {
    return view('apis');
});
// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function () {

    Route::resource('home', HomeController::class);
    // Rutas para persona
    Route::resource('persona', PersonaController::class);
    route::middleware('can:EDITAR INSTRUCTOR')->group(function () {
        Route::put('/persona/{persona}/cambiarEstado', [PersonaController::class, 'cambiarEstadoUser'])->name('persona.cambiarEstadoUser');
    });

    //Rutas para instructores
    Route::resource('instructor', InstructorController::class);
    route::middleware('can:CREAR INSTRUCTOR')->group(function () {
        route::get('createImportarCSV', [InstructorController::class, 'createImportarCSV'])->name('instructor.createImportarCSV');
        route::post('storeImportarCSV', [InstructorController::class, 'storeImportarCSV'])->name('instructor.storeImportarCSV');
    });


    // Rutas oara fucha de caracterizacion
    Route::resource('fichaCaracterizacion', FichaCaracterizacionController::class);
    route::middleware('can:EDITAR FICHA DE CARACTERIZACION')->group(function () {
        Route::post('updateInstructoresFichaCaracterizacion', [FichaCaracterizacionController::class, 'updateinstructoresFichaCaracterizacion'])->name('fichaCaracterizacion.updateinstructoresFichaCaracterizacion');
        Route::put('cambiarEstadoFichaCaracterizacion/{fichaCaracterizacion}', [FichaCaracterizacionController::class, 'cambiarEstadoFichaCaracterizacion'])->name('fichaCaracterizacion.cambiarEstado');
    });
    // Ruta para sedes
    Route::resource('sede', SedeController::class);
    Route::get('/cargarSedesByMunicipio/{municipio_id}', [SedeController::class, 'cargarSedesByMunicipio'])->name('sede.cargarSedesByMunicipio');
    Route::get('/cargarSedesByRegional/{regional_id}', [SedeController::class, 'cargarSedesByRegional'])->name('sede.cargarSedesByRegional');
    route::middleware('can:EDITAR SEDE')->group(function () {
        Route::put('sedeUpdateStatus/{sede}', [SedeController::class, 'cambiarEstadoSede'])->name('sede.cambiarEstado');
    });

    // Ruta para bloques
    Route::resource('bloque', BloqueController::class);
    route::middleware('can:EDITAR BLOQUE')->group(function () {
        route::put('/bloque/cambiarEstado/{bloque}', [BloqueController::class, 'cambiarEstado'])->name('bloque.cambiarEstado');
    });

    Route::get('/cargarBloques/{sede_id}', [BloqueController::class, 'cargarBloques'])->name('bloque.cargarBloques');

    // Ruta para los pisos
    Route::resource('piso', PisoController::class);
    route::middleware('can:EDITAR PISO')->group(function () {
        route::put('/piso/cambiarEstado/{piso}', [PisoController::class, 'cambiarEstado'])->name('piso.cambiarEstado');
    });
    Route::get('/cargarPisos/{bloque_id}', [PisoController::class, 'cargarPisos'])->name('piso.cargarPisos');

    // Ruta para ambientes
    Route::resource('ambiente', AmbienteController::class);
    route::middleware('can:EDITAR AMBIENTE')->group(function () {
        Route::put('/ambiente/cambiarEstado/{ambiente}', [AmbienteController::class, 'cambiarEstado'])->name('ambiente.cambiarEstado');
    });
    Route::get('/cargarAmbientes/{piso_id}', [AmbienteController::class, 'cargarAmbientes'])->name('ambiente.cargarAmbientes');



    // rutas para parametros
    Route::resource('parametro', ParametroController::class);
    route::middleware('can:EDITAR PARAMETRO')->group(function () {

        Route::put('/parametro/{parametro}/cambiar-estado', [ParametroController::class, 'cambiarEstado'])->name('parametro.cambiarEstado');
    });


    // rutas para temas
    Route::resource('tema', TemaController::class);
    route::middleware('can:EDITAR TEMA')->group(function () {

        Route::put('/tema/{tema}/cambiar-estado', [TemaController::class, 'cambiarEstado'])->name('tema.cambiarEstado');
        Route::put('/tema/{parametro}/cambiar-estado-parametro', [TemaController::class, 'cambiarEstadoParametro'])->name('tema.cambiarEstadoParametro');
        Route::post('/temas/updatePatametrosTemas', [TemaController::class, 'updateParametrosTemas'])->name('tema.updateParametrosTemas');
    });
    // rutas para las regionales
    Route::resource('regional', RegionalController::class);
    route::middleware('can:EDITAR REGIONAL')->group(function () {
        Route::put('regionalUpdateStatus/{regional}', [RegionalController::class, 'cambiarEstadoRegional'])->name('regional.cambiarEstado');
    });
    // rutas para los permisos
    route::middleware('can:ASIGNAR PERMISOS')->group(function () {

        route::resource('permiso', PermisoController::class);
        route::get('/showpermiso/{user}', [PermisoController::class, 'showUserPermiso'])->name('permiso.showUserPermiso');
    });

    Route::get('/logout', [LogoutController::class, 'cerrarSesion'])->name('logout');

    // rutas para departamentos

    Route::get('/cargardepartamentos', [DepartamentoController::class, 'cargardepartamentos'])->name('departamento.cargardepartamentos');
    Route::get('/cargarMunicipios/{departamento_id}', [MunicipioController::class, 'cargarMunicipios'])->name('municipio.cargarMunicipios');
    route::middleware('can:TOMAR ASISTENCIA')->group(function () {
        route::get('/entradaSalida/preIndex', [EntradaSalidaController::class, 'preIndex'])->name('entradaSalida.preIndex');
        // Rutas para entrada y salida
        Route::resource('entradaSalida', EntradaSalidaController::class);
        Route::get('cargarDatos', [EntradaSalidaController::class, 'cargarDatos'])->name('entradaSalida.cargarDatos')->middleware('cros');
        Route::get('crearEntradaSalida/{fichaCaracterizacionId}/{aprendiz}/{ambienteId}', [EntradaSalidaController::class, 'storeEntradaSalida'])->name('entradaSalida.crearEntradaSalida');
        Route::get('editarEntradaSalida/{fichaCaracterizacionId}/{aprendiz}/{ambienteId}', [EntradaSalidaController::class, 'updateEntradaSalida'])->name('entradaSalida.editarEntradaSalida');
        Route::get('listarAsistencia/{fichaCaracterizacionId}/{ambienteId}', [EntradaSalidaController::class, 'listarAsistencia'])->name('entradaSalida.listarAsistencia');
        Route::get('/registros', [EntradaSalidaController::class, 'registros'])->name('entradaSalida.registros');
        Route::post('updateSalida', [EntradaSalidaController::class, 'updateSalida'])->name('entradaSalida.updateSalida');
        Route::get('generarCSV/{ficha}', [EntradaSalidaController::class, 'generarCSV'])->name('entradaSalida.generarCSV');
    });
    route::get('/equipoDesarrollo', [HomeController::class, 'equipoDesarrollo'])->name('home.equipoDesarrollo');
});

// rutas del controlador register
Route::controller(RegisterController::class)->group(function () {
    Route::get('/registro', 'mostrarFormulario')->name('registro');
    Route::post('/registrarme', 'create')->name('registrarme');
});
// rutas del controlador login
Route::resource('login', LoginController::class);
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'verificarLogin')->name('verificarLogin');
    // Route::get('/login','mostrarLogin')->name('login');
    Route::post('/iniciarSesion', 'iniciarSesion')->name('iniciarSesion');
});
