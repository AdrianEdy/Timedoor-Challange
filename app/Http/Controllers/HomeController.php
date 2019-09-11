<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $boards = Board::orderBy('created_at', 'desc')->paginate(10);
        return view('home')->with('boards', $boards);
    }
}
