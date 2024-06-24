<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AltasController;

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

Route::get('/', function () {
    return view('index');
})->name('index');


Route::get('/login', function(){
    return view('login');
})->name('login');

Route::get('/solicitudRegistro', function(){
    return view('solicitudRegistro');
})->name('solicitud_registro');

//FUNCIONES ADMINISTRADOR
Route::get('/administrador', function(){
    return view('administrador');
})->name('administrador');

//AÑADIR ENTRENADOR
Route::get('/altaEntrenador', function(){
    return view('añadirEntrenador');
})->name('altaEntrenador');


Route::get('/gestionEntrenadores', function(){
    return view('gestionEntrenadores');
})->name('gestionEntrenadores');

Route::get('/verEliminarEntrenadores', function(){
    return view('verEliminarEntrenadores');
})->name('verEliminarEntrenadores');

Route::get('/altaNoticia', function(){
    return view('altaNoticia');
})->name('altaNoticia');

Route::get('/eliminarNoticias', function(){
    return view('eliminarNoticias');
})->name('eliminarNoticias');

Route::get('/editarNoticias', function(){
    return view('editarNoticias');
})->name('editarNoticias');

//MATERIAL
Route::get('/altaMaterial', function(){
    return view('altaMaterial');
})->name('altaMaterial');

//VER MATERIALES
Route::get('/materiales', function(){
    return view('materiales');
})->name('materiales');

//ELIMINAR MATERIALES:
Route::get('/eliminarMateriales', function(){
    return view('eliminarMateriales');
})->name('eliminarMateriales');

//EDITAR MATERIALES
Route::get('/editarMateriales', function(){
    return view('editarMateriales');
})->name('editarMateriales');

//ENTRENADOEWS
Route::get('/entrenador', function(){
    return view('entrenador');
})->name('entrenador');

//ALTA ENTRENAMIENOT
Route::get('/altaEntrenamiento', function(){
    return view('altaEntrenamiento');
})->name('altaEntrenamiento');

Route::get('/entrenamientos', function(){
    return view('entrenamientos');
})->name('entrenamientos');


//ALTA HORARIO
Route::get('/altaHorario', function(){
    return view('altaHorario');
})->name('altaHorario');

Route::get('/editarHorarios', function(){
    return view('editarHorarios');
})->name('editarHorarios');

//COMPETICIONES
Route::get('/altaCompeticion', function(){
    return view('altaCompeticion');
})->name('altaCompeticion');


//INFORMACION
Route::get('/informacion', function(){
    return view('informacion');
})->name('informacion');

//TIEMPOS INDIVIDUALES
Route::get('/altaTiempo', function(){
    return view('altaTiempo');
})->name('altaTiempo');

Route::get('/verEliminarTiempos', function(){
    return view('verEliminarTiempos');
})->name('verEliminarTiempos');
/*Route::get('/verEliminarTiemposRelevos', function(){
    return view('verEliminarTiemposRelevos');
})->name('verEliminarTiemposRelevos');*/

Route::get('/tiempos', function(){
    return view('tiempos');
})->name('tiempos');

//TIEMPOS RELEVOS
Route::get('/altaTiempoRelevo', function(){
    return view('altaTiempoRelevo');
})->name('altaTiempoRelevo');

//MINIMAS INDIVIDUALES
Route::get('/altaMinima', function(){
    return view('altaMinima');
})->name('altaMinima');

Route::get('/verEliminarMinimas', function(){
    return view('verEliminarMinimas');
})->name('verEliminarMinimas');

Route::get('/minimas', function(){
    return view('minimas');
})->name('minimas');

//RANKING
Route::get('/ranking', function(){
    return view('ranking');
})->name('ranking');

//CÓDIGOS QR
Route::get('/codigosQR', function(){
    return view('codigosQR');
})->name('codigosQR');




//INICIAR SESION
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::view('/privada', 'privada')->name('privada');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//registrar entrenador
Route::post('/register_entrenador', [LoginController::class, 'register_entrenador'])->name('register_entrenador');

Route::get('/gestionEntrenadores', [LoginController::class, 'mostrarEntrenadoresYCategorias'])->name('gestionEntrenadores');
Route::get('/verEliminarEntrenadores',[LoginController::class,'index'])->name('verEliminarEntrenadores');

// Definir la ruta para eliminar un entrenador
Route::delete('/gestionEntrenadores/{id}', [LoginController::class, 'destroy'])->name('eliminar-entrenador');
Route::delete('/verEliminarEntrenadores/{id}', [LoginController::class, 'destroy'])->name('eliminar-entrenador');
//Guardar la categoria del entrenador
Route::post('/guardar-categoria', [LoginController::class, 'guardarCategoria'])->name('guardar-categoria');

//Eliminar categoria de un entrenador:
Route::delete('gestionEntrenadores/{entrenador_id}/{categoria_id}', [LoginController::class,'eliminarRelacion'])->name('eliminarRelacion');


//GUARDAR UNA NOTICIA
Route::post('/altaNoticia',[AltasController::class,'altaNoticia'])->name('altaNoticia');
Route::get('/',[AltasController::class, 'mostrarNoticias'])->name('index');
Route::get('/eliminarNoticias',[AltasController::class, 'mostrarNoticiasEliminar'])->name('eliminarNoticias');
Route::delete('/eliminarNoticia/{id}',[AltasController::class,'eliminarNoticia'])->name('eliminarNoticia');

//EditarNoticia
Route::get('/editarNoticia/{id}', [AltasController::class, 'datosNoticias'])->name('editarNoticias');
Route::post('/editarNoticia/{id}', [AltasController::class, 'actualizarNoticia'])->name('editarNoticia');


//GURARDAR UN MATERIAL
Route::post('/altaMaterial',[AltasController::class,'altaMaterial'])->name('altaMaterial');
Route::get('/materiales',[AltasController::class,'mostrarMateriales'])->name('materiales');

Route::get('/verEliminarMateriales',[AltasController::class, 'mostrarMaterialesEliminar'])->name('verEliminarMateriales');
Route::delete('/eliminar-material/{id}',[AltasController::class, 'eliminar'])->name('eliminarMaterial');

//editar materiales
Route::get('/editarMaterial/{id}', [AltasController::class, 'datosMateriales'])->name('editarMateriales');
Route::post('/editarMaterial/{id}', [AltasController::class, 'actualizarMaterial'])->name('editarMateriales');

//EDITAR PERFIL
Route::get('/editarPerfil/{id}', [AltasController::class, 'datosUsuario'])->name('editarPerfil');
Route::post('/editarPerfilE/{id}', [AltasController::class, 'actualizarPerfilEntrenador'])->name('editarPerfilE');
Route::post('/editarPerfilN/{id}', [AltasController::class, 'actualizarPerfilNadador'])->name('editarPerfilN');

//SOLICITUDES
Route::get('/verSolicitudes', [LoginController::class, 'mostrarSolicitudes'])->name('verSolicitudes');
Route::delete('/verSolicitudes/{id}', [LoginController::class, 'eliminar_solicitud'])->name('eliminar_solicitud');
Route::post('/verSolicitudes/{id}', [LoginController::class, 'aceptarSolicitud'])->name('aceptar_solicitud');

//VER NADADORES
Route::get('/verNadadores', [LoginController::class, 'mostrarNadadores'])->name('verNadadores');
Route::delete('/verNadadores/{id}', [LoginController::class, 'eliminar_nadadores'])->name('eliminar_nadadores');

//ENTRENAMIENTOS
Route::post('/altaEntrenamiento',[AltasController::class,'altaEntrenamiento'])->name('altaEntrenamiento');
Route::get('/entrenamientos',[AltasController::class,'mostrarEntrenamientos'])->name('entrenamientos');
Route::get('/altaEntrenamiento', [AltasController::class, 'mostrarCategoriasEntrenamientos'])->name('altaEntrenamiento');
Route::get('/verEliminarEntrenamiento', [AltasController::class, 'mostrarEntrenamientoEntrenador'])->name('verEliminarEntrenamiento');
Route::delete('/eliminarEntrenamiento/{id}',[AltasController::class, 'eliminarEntrenamiento'])->name('eliminarEntrenamiento');
Route::get('/editarEntrenamiento/{id}', [AltasController::class, 'datosEntrenamiento'])->name('editarEntrenamiento');
Route::post('/editarEntrenamiento/{id}', [AltasController::class, 'actualizarEntrenamiento'])->name('editarEntrenamiento');


//HORARIOS
Route::get('/horarios',[AltasController::class,'mostrarHorarios'])->name('horarios');
Route::post('/altaHorario',[AltasController::class,'altaHorario'])->name('altaHorario');
Route::get('/altaHorario', [AltasController::class, 'mostrarCategoriasHorarios'])->name('altaHorario');
Route::get('/verEliminarHorarios', [AltasController::class, 'mostrarHorariosEntrenador'])->name('verEliminarHorarios');
Route::get('/editarHorarios/{id}', [AltasController::class, 'datosHorarios'])->name('editarHorarios');
Route::post('/editarHorarios/{id}', [AltasController::class, 'actualizarHorario'])->name('editarHorarios');
Route::delete('/eliminarHorario/{id}',[AltasController::class, 'eliminarHorario'])->name('eliminarHorario');


//COMPETICIONES
Route::get('/altaCompeticion', [AltasController::class, 'mostrarCategoriasCompeticiones'])->name('altaCompeticion');
Route::post('/altaCompeticion',[AltasController::class,'altaCompeticion'])->name('altaCompeticion');
Route::get('/competiciones',[AltasController::class,'mostrarCompeticiones'])->name('competiciones');
Route::get('/competicionesCualquiera',[AltasController::class,'mostrarCompeticionesCualquiera'])->name('competicionesCualquiera');
Route::get('/eliminarCompeticiones', [AltasController::class, 'mostrarCompeticionesEliminar'])->name('eliminarCompeticiones');
Route::get('/editarCompeticion/{id}', [AltasController::class, 'datosCompeticion'])->name('editarCompeticion');
Route::post('/editarCompeticion/{id}', [AltasController::class, 'actualizarCompeticion'])->name('editarCompeticion');
Route::delete('/eliminarCompeticion/{id}',[AltasController::class, 'eliminarCompeticion'])->name('eliminarCompeticion');


//TIEMPO
Route::get('/altaTiempo', [AltasController::class, 'mostrarNadadoresTiempos'])->name('altaTiempo');
Route::post('/altaTiempo',[AltasController::class,'altaTiempo'])->name('altaTiempo');
Route::get('/editarTiempo/{id}', [AltasController::class, 'datosTiempo'])->name('editarTiempo');
Route::post('/editarTiempo/{id}', [AltasController::class, 'actualizarTiempo'])->name('editarTiempo');
Route::delete('/verEliminarTiempos/{id}',[AltasController::class, 'eliminarTiempo'])->name('verEliminarTiempo');
Route::post('/tiempos', [AltasController::class, 'buscarTiemposMenu'])->name('tiempos');
Route::post('/tiemposN', [AltasController::class, 'buscarTiemposMenuNadadores'])->name('tiemposN');


//TIEMPO RELEVO
Route::get('/altaTiempoRelevo', [AltasController::class, 'mostrarNadadoresTiemposRelevos'])->name('altaTiempoRelevo');
Route::post('/altaTiempoRelevo',[AltasController::class,'altaTiempoRelevo'])->name('altaTiempoRelevo');
Route::post('/verEliminarTiemposR', [AltasController::class, 'buscarTiemposRelevos'])->name('verEliminarTiemposRelevos');
Route::post('/verEliminarTiemposI', [AltasController::class, 'buscarTiempos'])->name('verEliminarTiemposIndividuales');
Route::post('/tiemposR', [AltasController::class, 'buscarTiemposRelevosMenu'])->name('tiemposR');
Route::post('/tiemposRN', [AltasController::class, 'buscarTiemposRelevosMenuNadadores'])->name('tiemposRN');
Route::get('/editarTiempoRelevo/{id}', [AltasController::class, 'datosTiempoRelevo'])->name('editarTiempoRelevo');
Route::post('/editarTiempoRelevo/{id}', [AltasController::class, 'actualizarTiempoRelevo'])->name('editarTiempoRelevo');


//MINIMAS
Route::get('/altaMinima', [AltasController::class, 'mostrarNadadoresMinimas'])->name('altaMinima');
Route::post('/altaMinima',[AltasController::class,'altaMinima'])->name('altaMinima');
Route::get('/altaMinimaRelevo', [AltasController::class, 'mostrarNadadoresMinimasRelevos'])->name('altaMinimaRelevo');
Route::post('/altaMinimaRelevo',[AltasController::class,'altaMinimaRelevo'])->name('altaMinimaRelevo');
Route::post('/verEliminarMinimasI', [AltasController::class, 'buscarMinimas'])->name('verEliminarMinimasIndividuales');
Route::post('/verEliminarMinimasR', [AltasController::class, 'buscarMinimasRelevos'])->name('verEliminarMinimasRelevos');
Route::delete('/verEliminarMinimas/{id}',[AltasController::class, 'eliminarMinima'])->name('verEliminarMinima');
Route::post('/minimasR', [AltasController::class, 'buscarMinimasRelevosMenu'])->name('MinimasR');
Route::post('/minimas', [AltasController::class, 'buscarMinimasMenu'])->name('minimas');
Route::post('/minimasRN', [AltasController::class, 'buscarMinimasRelevosMenuNadadores'])->name('MinimasRN');
Route::post('/minimasn', [AltasController::class, 'buscarMinimasMenuNadadores'])->name('minimasN');

Route::get('/editarMinima/{id}', [AltasController::class, 'datosMinimas'])->name('editarMinima');
Route::get('/editarMinimaRelevo/{id}', [AltasController::class, 'datosMinimaRelevo'])->name('editarMinimaRelevo');
Route::post('/editarMinimaRelevo/{id}', [AltasController::class, 'actualizarMinimaRelevo'])->name('editarMinimaRelevo');
Route::post('/editarMinima/{id}', [AltasController::class, 'actualizarMinima'])->name('editarMinima');

//RANKING
Route::post('/ranking', [AltasController::class, 'buscarTiemposRanking'])->name('ranking');


















