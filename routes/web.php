
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\{SeriesController ,TemporadasController , EpisodiosController, RegistroController,EntrarController};
use App\Mail\NovaSerie;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/series',[SeriesController::class, 'index'])
    ->name('listar_series');

Route::get('/series/criar',[SeriesController::class, 'create'])
    ->name('form_criar_serie')
    ->middleware('autenticador');

Route::post('/series/criar',[SeriesController::class, 'store'])
    ->middleware('autenticador');

Route::delete('/series/{id}',[SeriesController::class, 'destroy'])
    ->middleware('autenticador');

Route::post('/series/{id}/editaNome',[SeriesController::class, 'editaNome'])
    ->middleware('autenticador');


Route::get('/series/{seriesId}/temporadas',[TemporadasController::class, 'index']);

Route::get('/temporadas/{temporada}/episodios',[EpisodiosController::class, 'index']);
Route::post('/temporadas/{temporada}/episodios/assistir',[EpisodiosController::class, 'assistir'])
    ->middleware('autenticador');


Route::get('/entrar',[EntrarController::class, 'index']);
Route::post('/entrar',[EntrarController::class, 'entrar']);

Route::get('/registrar',[RegistroController::class, 'create']);
Route::post('/registrar',[RegistroController::class, 'store']);

Route::get('/sair',function(){
    Auth::logout();
    return redirect('/entrar');
});


Route::get('/email', function(){
    return new NovaSerie(
        'Arrow',
        5,
        10
    );
});

Route::get('/enviando-email', function(){

    $email = new NovaSerie(
        'Arrow',
        5,
        10
    );

    $email->subject = 'Nova Série Adicionada';

    $user = (object)[
        'email' => 'victor@teste.com',
        'name' => 'Victor Fonseca'
    ];

    Mail::to($user)->send($email);
    return 'E-mail enviado!';
});


