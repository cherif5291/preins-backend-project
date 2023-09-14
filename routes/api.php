<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\PostulationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    // Route::get('index','index'); // Ajoutez cette ligne

});
 Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout-other-devices', [UserController::class, 'logoutOtherDevices']);
    Route::get('index', [UserController::class, 'index']);
    Route::get('listeRole', [UserController::class, 'listeRole']);
    Route::get('getPostulation', [UserController::class, 'listerPostulation']);
    Route::get('classe', [ClasseController::class, 'listeClasse']);





  });

Route::middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::post('departementSave', [DepartementController::class, 'saveDepartement']);
    Route::post('filiereSave', [FiliereController::class, 'saveFiliere']);
    Route::post('classeSave', [ClasseController::class, 'saveClasse']);
    Route::post('addUser', [UserController::class, 'addUser']);
    Route::get('listeUser', [UserController::class, 'listeUser']);


    // Route::get('getPostulation', [UserController::class, 'listerPostulation']);
   



});
Route::middleware(['auth:sanctum','role:postulant'])->group(function () {
    Route::get('mesPostulations', [UserController::class, 'mesPostulations']);
    Route::get('filiere', [FiliereController::class, 'listeFiliere']);
    Route::get('getClasseByFiliere/{id}', [FiliereController::class, 'getClasseByFiliere']);



});

Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);


Route::middleware(['auth:sanctum','role:secretaire'])->group(function () {
    Route::post('departementSave', [DepartementController::class, 'saveDepartement']);
    Route::post('filiereSave', [FiliereController::class, 'saveFiliere']);
    Route::post('classeSave', [ClasseController::class, 'saveClasse']);
    Route::post('verifier/{id}', [UserController::class, 'verifier']);
    Route::post('incomplet/{id}', [UserController::class, 'incomplet']);
});
Route::middleware(['auth:sanctum','role:chefdep'])->group(function () {
    Route::post('validerC/{id}', [UserController::class, 'valider']);
    Route::post('refuserC/{id}', [UserController::class, 'refuser']);


});
Route::middleware(['auth:sanctum','role:postulant'])->group(function () {
    Route::post('postuler', [PostulationController::class, 'postuler']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
