<?php
use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashController extends Controller
{
    public function index()
    {
        $cards = Card::orderBy('id','desc')->get();

        return view('admin.dash.index', compact('cards'));
    }
}