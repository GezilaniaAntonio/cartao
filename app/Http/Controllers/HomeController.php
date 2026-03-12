<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cards = Card::orderBy('id','desc')->get();

        return view('admin.dash.index', compact('cards'));
      
    }
}
