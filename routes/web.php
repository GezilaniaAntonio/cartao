<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;
use App\Models\Card;
use App\Models\Upload;

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
// routes/web.php
/* Route::get('/debug-card-full/{id}', function($id) {
    $card = Card::findOrFail($id);
    $uploads = Upload::where('card_id', $card->id)->get();
    
    $imagePath = $uploads->where('type', 'image')->first()->path ?? null;
    $signPath = $uploads->where('type', 'signature')->first()->path ?? null;
    $fingerPath = $uploads->where('type', 'fingerprint')->first()->path ?? null;
    
    return view('debug-card-full', compact('card', 'uploads', 'imagePath', 'signPath', 'fingerPath'));
}); */