<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;
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

Route::get('/dash', [HomeController::class, 'index'])->name('dash');


/* Route::get('/admin/dash', [CardController::class, 'index'])->name('admin.dash.index'); */
Route::post('/admin/dash/store', [CardController::class, 'store'])->name('admin.dash.store');
Route::delete('/admin/dash/{card}', [CardController::class, 'destroy'])->name('admin.dash.destroy');

Route::get('/admin/cards/generate/{id}', [CardController::class, 'cardgenerate'])->name('admin.generate');
Route::get('/test-chinese', function () {
    $html = '<html><body style="font-family: SimSun;">和 名称 出生日期</body></html>';
    $pdf = PDF::loadHTML($html);
    return $pdf->stream('teste.pdf');
});
