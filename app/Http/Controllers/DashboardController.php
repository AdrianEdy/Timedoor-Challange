<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(Board $board)
    {
        $boards = $board->withTrashed()->latest()->paginate(20)->onEachSide(2);

        return view('content/dashboard')->with('boards', $boards);;
    }
}
