<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Models\Upload;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

Route::middleware('auth')->group( function () {
    
    Route::redirect('/', '/dash');
    Route::get('/pagina-principal', ['as' => 'dash', 'uses' => 'HomeController@index']);
    Route::get('/cartao/salvar', ['as' => 'admin.dash.store', 'uses' => 'CardController@store']);
    Route::get('/utilizadores', ['as' => 'admin.users.list', 'uses' => 'UserController@index']);
    Route::delete('/admin/dash/{card}', [CardController::class, 'destroy'])->name('admin.dash.destroy');
    Route::get('/admin/cards/generate/{id}', [CardController::class, 'cardgenerate'])->name('admin.generate');
    Route::get('/test-chinese', function () {
        $html = '<html><body style="font-family: SimSun;">和 名称 出生日期</body></html>';
        $pdf = PDF::loadHTML($html);
        return $pdf->stream('teste.pdf');
    });
    
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');