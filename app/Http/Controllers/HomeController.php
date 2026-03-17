<?php

namespace App\Http\Controllers;

use App\Models\Card;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->Middleware('role:admin');
    }

    public function index()
    {
        $cards = Card::orderBy('id','desc')->get();

        return view('admin.dash.index', compact('cards'));
    }
}
